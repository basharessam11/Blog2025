<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class BtolatScraperController extends Controller
{
    // جلب قائمة الأخبار من الصفحة الرئيسية
    public function fetchNewsList()
    {
        $feeds = [
            // النوع => الرابط
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
            $type = \App\Models\ArticleType::firstOrCreate([
                'slug' => $typeSlug
            ], [
                'name' => $typeName
            ]);
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
                // استخراج الرقم فقط من نهاية الرابط
                // استخراج جميع الأرقام من الرابط
                // استخراج الأرقام التي يسبقها / ويتبعها / أو ? أو نهاية الرابط
                preg_match_all('#/(?P<num>\d+)(?=[/?]|$)#', $link, $allNumbersMatches);
                $allNumbers = $allNumbersMatches['num'] ?? [];
                // يمكنك استخدام أول رقم كـ slug أو جميع الأرقام حسب الحاجة
                if (!empty($allNumbers)) {
                    $slug = $allNumbers[0]; // أول رقم
                } else {
                    $slug = md5($link);
                }
                Log::info('Btolat: الأرقام المستخرجة من الرابط (بين / و / أو ? أو نهاية الرابط)', ['link' => $link, 'numbers' => $allNumbers, 'slug' => $slug]);
                if (!Post::where('slug', $slug)->exists()) {
                    $tags = [];
                    try {
                        $detailResponse = Http::get($link);
                        if ($detailResponse->ok()) {
                            $detailHtml = $detailResponse->body();
                            $detailCrawler = new \Symfony\Component\DomCrawler\Crawler($detailHtml);
                            if ($detailCrawler->filter('div.article-body')->count()) {
                                $content = $detailCrawler->filter('div.article-body')->html('');
                            }
                            // جلب التاجات من div.atags a
                            if ($detailCrawler->filter('div.atags a')->count()) {
                                $detailCrawler->filter('div.atags a')->each(function ($node) use (&$tags) {
                                    $tagName = trim($node->text());
                                    $href = $node->attr('href');
                                    $tagId = null;
                                    if (preg_match('#/tags/(\d+)#', $href, $m)) {
                                        $tagId = $m[1];
                                    }
                                    if ($tagId) {
                                        $tagModel = \App\Models\Tag::firstOrCreate(['slug' => $tagId], ['name' => $tagName]);
                                        $tags[] = $tagModel->id;
                                    }
                                });
                            }
                        }
                    } catch (\Exception $e) {
                        Log::warning('Btolat: فشل في جلب تفاصيل الخبر', ['url' => $link, 'error' => $e->getMessage()]);
                    }

                    $content = str_replace(['btolat.com', 'بطولات'], ['yourdomain.com', 'اسم موقعك'], $content);
                    $created = Post::create([
                        'title' => $title,
                        'slug' => $slug,
                        'content' => $content,
                        'image' => $img,
                        'source_url' => $link,
                        'article_type_id' => $type->id,
                    ]);
                    if (!empty($tags)) {
                        $created->tags()->sync($tags); // ids فقط
                    }
                    Log::info('Btolat: تم حفظ خبر جديد', ['slug' => $slug, 'id' => $created->id]);
                } else {
                    Log::info('Btolat: الخبر موجود مسبقاً', ['slug' => $slug]);
                }
            }
        }
        // حفظ الأخبار الجديدة فقط
        if (empty($news)) {
            Log::warning('Btolat: لم يتم العثور على أي مقالات عند الجلب من جميع الـ RSS.');
        }

        // جلب الأخبار من قاعدة البيانات للعرض
        $posts = Post::orderBy('created_at', 'desc')->take(30)->get();
        return view('btolat.news', ['news' => $posts]);
    }

    // جلب تفاصيل خبر معين
    public function fetchNewsDetail($slug)
    {


        $post = Post::where('slug', $slug)->firstOrFail();
        $news = [
            'title' => $post->title,
            'content' => $post->content,
        ];
        return view('btolat.news_show', compact('news'));
    }
}
