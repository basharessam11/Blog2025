<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Mail\NewBlogNotification;
use App\Models\Post;
use App\Models\BlogCategory;
use App\Models\BlogDescription;
use App\Models\Setting;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class BlogController extends Controller
{

     use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('blog');
    }
    public function index(Request $request)
    {
     $blogs = Post::with(['articleType:id,name'])
    ->when($request->search, function ($query) use ($request) {
        $query->where(function ($q) use ($request) {
            $q->where('title', 'like', '%' . $request->search . '%');
        });
    })
    ->when($request->from_date && $request->to_date, function ($query) use ($request) {
        $query->whereBetween('created_at', [
            $request->from_date . ' 00:00:00',
            $request->to_date . ' 23:59:59'
        ]);
    })
    ->orderBy('created_at', 'desc')
    ->paginate(100)
    ->appends($request->query());

        return view('admin.blog.index',get_defined_vars());
    }





public function get()
{
    $settings = Setting::find(1);
    $feeds = [
        'أخبار عامة' => 'https://www.btolat.com/rss/newsfeed',
        'فيديوهات' => 'https://www.btolat.com/rss/videosfeed',
        'المحترفين' => 'https://www.btolat.com/rss/Professionalsfeed',
        'الدوري المصري' => 'https://www.btolat.com/rss/newsfeed?leagueid=1193',
        'الدوري الاسباني' => 'https://www.btolat.com/rss/newsfeed?leagueid=1399',
        'الدوري الإنجليزي' => 'https://www.btolat.com/rss/newsfeed?leagueid=1204',
        'الأهلي' => 'https://www.btolat.com/rss/newsfeed?teamid=8883',
        'الزمالك' => 'https://www.btolat.com/rss/newsfeed?teamid=8959',
        'برشلونة' => 'https://www.btolat.com/rss/newsfeed?teamid=15702',
        'فيديوهات الدوري المصري' => 'https://www.btolat.com/rss/videosfeed?leagueid=1193',
        'فيديوهات الدوري الاسباني' => 'https://www.btolat.com/rss/videosfeed?leagueid=1399',
        'فيديوهات الدوري الإنجليزي' => 'https://www.btolat.com/rss/videosfeed?leagueid=1204',
        'الكرة السعودية' => 'https://www.btolat.com/rss/sectionnewsxml?id=41',
    ];

    $news = [];

    foreach ($feeds as $typeName => $feedUrl) {
        $typeSlug = \Illuminate\Support\Str::slug($typeName);
        $type = \App\Models\ArticleType::firstOrCreate(
            ['slug' => $typeSlug],
            ['name' => $typeName]
        );

        $response = Http::get($feedUrl);
        if (!$response->ok()) {
            Log::warning('Btolat: فشل في جلب RSS', ['url' => $feedUrl]);
            continue;
        }

        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($response->body());
        if ($xml === false) {
            $errors = libxml_get_errors();
            Log::error('Btolat: خطأ في تحليل RSS', ['errors' => $errors, 'url' => $feedUrl]);
            continue;
        }

        foreach ($xml->channel->item as $item) {
            $title = (string) $item->title;
            $link = (string) $item->link;
            $desc = (string) $item->description;
            $img = null;

            if (preg_match('/<img.*?src=[\'\"](.*?)[\'\"]/i', $desc, $matches)) {
                $img = $matches[1];
            }

            // استخراج slug رقمي من نهاية الرابط
            preg_match_all('#/(?P<num>\d+)(?=[/?]|$)#', $link, $allNumbersMatches);
            $allNumbers = $allNumbersMatches['num'] ?? [];
            $slug = !empty($allNumbers) ? $allNumbers[0] : md5($link);

            if (!Post::where('slug', $slug)->exists()) {
                $tags = [];
                $content = ''; // ✅ تعريف المتغير من الأول

                try {
                    $detailResponse = Http::get($link);
                    if ($detailResponse->ok()) {
                        $detailHtml = $detailResponse->body();
                        $detailCrawler = new \Symfony\Component\DomCrawler\Crawler($detailHtml);

                        // جلب نص المقال
                        if ($detailCrawler->filter('div.article-body')->count()) {
                            $content = $detailCrawler->filter('div.article-body')->html('');
                        }

                        // جلب التاجات
                        if ($detailCrawler->filter('div.atags a')->count()) {
                            $detailCrawler->filter('div.atags a')->each(function ($node) use (&$tags) {
                                $tagName = trim($node->text());
                                $href = $node->attr('href');
                                $tagId = null;

                                if (preg_match('#/tags/(\d+)#', $href, $m)) {
                                    $tagId = $m[1];
                                }

                                if ($tagId) {
                                    $tagModel = \App\Models\Tag::firstOrCreate(
                                        ['slug' => $tagId],
                                        ['name' => $tagName]
                                    );
                                    $tags[] = $tagModel->id;
                                }
                            });
                        }
                    }
                } catch (\Exception $e) {
                    Log::warning('Btolat: فشل في جلب تفاصيل الخبر', ['url' => $link, 'error' => $e->getMessage()]);
                }

                // تعديل الدومين واللينكات
                $currentDomain = request()->getSchemeAndHttpHost();
                $content = str_replace(
                    ['https://www.btolat.com', 'https://www.btolat.com/news', 'بطولات', '/news'],
                    [$currentDomain, $currentDomain . '/blog', $settings->name, '/blog'],
                    $content
                );

                // حفظ المقال
                $created = Post::create([
                    'title'           => $title,
                    'slug'            => $slug,
                    'content'         => $content,
                    'image'           => $img,
                    'source_url'      => $link,
                    'article_type_id' => $type->id,
                ]);

                if (!empty($tags)) {
                    $created->tags()->sync($tags);
                }

                $news[] = $created;
                Log::info('Btolat: تم حفظ خبر جديد', ['slug' => $slug, 'id' => $created->id]);
            } else {
                Log::info('Btolat: الخبر موجود مسبقاً', ['slug' => $slug]);
            }
        }
    }

    // لو مفيش أخبار جديدة
    if (empty($news)) {
        Log::warning('Btolat: لم يتم العثور على أي مقالات عند الجلب من جميع الـ RSS.');
    }

    session()->flash('success', __('admin.Created Successfully'));
    return redirect()->route('blog.index');
}









    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $articleTypes = \App\Models\ArticleType::all();
    $tags = \App\Models\Tag::all();
    return view('admin.blog.create', compact('articleTypes', 'tags'));
    }

    public function store(BlogRequest $request)
    {
//   return$request;

  $data = $request->only(['title', 'content', 'article_type_id', 'source_url', 'image']);

    // لو المستخدم مدخلش slug هنولده أوتوماتيك
    $data['slug'] = $request->slug
        ? Str::slug($request->slug, '-')
        : Str::slug($request->title, '-');

   $blog = Post::create($data);


        if ($request->hasFile('photo')) {

            $blog->setImageAttribute([$request->file('photo'),'photo']);
            $blog->save();
        }

        //  event(new SendMail($blog,'blog'));



    session()->flash('success', __('admin.Created Successfully'));
    return redirect()->route('blog.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
         $articleTypes = \App\Models\ArticleType::all();
    $tags = \App\Models\Tag::all();

    $blog = Post::findOrFail($id);
        return view('admin.blog.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest  $request,$id)
    {

//    return$request;

    $blog = Post::findOrFail($id);
        $blog->update($request->except('photo','title_ar1','title_en1','description_ar1','description_en1',));
        if ($request->hasFile('photo')) {

            if ($blog->photo) {
                Storage::disk('blog')->delete($blog->photo);
            }
             $blog->setImageAttribute([$request->file('photo'),'photo']);

            $blog->save();
        }


#############################BlogDescription#########################################

if (!empty($request->description_ar1)) {

    BlogDescription::where('blog_id', $blog->id)->delete();
    foreach ($request->description_ar1 as $key => $value) {


        BlogDescription::create([
            'blog_id'          => $blog->id,

            'description_ar'          => $request->description_ar1[ $key],
            'description_en'          => $request->description_en1[ $key],

        ]);
    }
    }
    #############################End BlogDescription#########################################







    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->route('blog.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $blog = Post::find($value);
    if ($blog->photo) {
        Storage::disk('blog')->delete($blog->photo);
    }
    $blog->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('blog.index');
    }
}

