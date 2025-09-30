<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Admin\ServiceCategory;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\ArticleType;
use App\Models\Booking;
use App\Models\Card;
use App\Models\Cart;
use App\Models\Courses;
use App\Models\Courses_Item;
use App\Models\Courses_Review;
use App\Models\Courses_Time;
use App\Models\Expenses;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Policy;
use App\Models\Post;
use App\Models\Product;
use App\Models\Rateing;
use App\Models\Review;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Story;
use App\Models\SuccessStory;
use App\Models\Tag;
use App\Models\Terms;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Torann\GeoIP\Facades\GeoIP;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
                // Featured Blog (أحدث مقال)
                $featuredBlog = Post::orderBy('created_at', 'desc')->first();

                // أحدث المقالات مع pagination
                $recentBlogs = Post::orderBy('created_at', 'desc')->where( 'id','!=',$featuredBlog->id ??0)->paginate(6);

                // التصنيفات مع عدد المقالات
                $categories1 = ArticleType::withCount('posts')->limit(8)->get();
                $categories = ArticleType::withCount('posts')->limit(4)->get();


        // المقالات الشائعة (الأحدث فقط)
        $popularBlogs = Post::orderBy('created_at', 'desc')->where( 'id','!=',$featuredBlog->id ??0)->take(5)->get();

                // الوسوم
                $tags = Tag::limit(15)->get();

                return view('web.index', get_defined_vars());

    }


    public function contact()
    {
          $categories = ArticleType::withCount('posts')->limit(4)->get();
        return view('web.contact' ,get_defined_vars());
    }



    public function terms()
    {
         $categories = ArticleType::withCount('posts')->limit(4)->get();
        $terms = Terms::first();
        return view('web.term-condition' ,get_defined_vars());

    }
    public function about()
    {
         $categories = ArticleType::withCount('posts')->limit(4)->get();
        $about = About::where('id',1)->first();
        return view('web.about',get_defined_vars());


    }

    public function blog(Request $request)
    {
        $blogs = Blog::query()->paginate(10);



 $categories = ArticleType::withCount('posts')->limit(4)->get();

        return view('web.blog',get_defined_vars());

    }


    public function blogs(Request $request)
    {

          if ($request->search) {
    $q = $request->search;
                   $blogs = Post::query()
            ->where('title', 'like', "%$q%")
            ->orWhere('content', 'like', "%$q%")
            ->orWhereHas('tags', function($query) use ($q) {
                $query->where('name', 'like', "%$q%") ;
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

                }else{
   $blogs = Post::orderBy('created_at', 'desc')->paginate(12);
                }




 $categories = ArticleType::withCount('posts')->limit(4)->get();



        return view('web.blogs',get_defined_vars());

    }







public function blog_details($slug)
{



    try {
         $blog = Post::where('slug', $slug)->firstOrFail();

        $previousBlog = Post::where('id', '<', $blog->id)
            ->orderBy('id', 'desc')->first();

        $nextBlog = Post::where('id', '>', $blog->id)
            ->orderBy('id', 'asc')->first();



        $recentblogs = Post::where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')->take(5)->get();

 $categories1 = ArticleType::withCount('posts')->get()?? collect();
        // لو مفيش صفحات، هترجع Collection فاضية — ما فيش مشكلة
         $categories = ArticleType::withCount('posts')->limit(4)->get() ?? collect();

         $popularBlogs = Post::orderBy('created_at', 'desc')->take(5)->get();

        // ارجع المتغيرات صراحة بدل get_defined_vars() علشان أوضح المتغيرات المرسلة للفيو
          view('web.blog-details', compact(
            'blog',
            'previousBlog',
            'nextBlog',

            'recentblogs',
            'categories1',
            'categories',
            'popularBlogs'
        ));
    } catch (\Exception $e) {
        Log::error('blog_details error: '.$e->getMessage());
        // لو عايز تشوف الرسالة وقت التطوير:
        // dd($e->getMessage());
        abort(500, 'حدث خطأ ما، راجع اللوج.');
    }
}




    // عرض المقالات حسب التصنيف
    public function category($slug)
    {
         $categories = ArticleType::withCount('posts')->limit(4)->get();
        $category = \App\Models\ArticleType::where('slug', $slug)->firstOrFail();
        $blogs = \App\Models\Post::where('article_type_id', $category->id)->orderBy('created_at', 'desc')->paginate(12);

        return view('web.blogs' ,get_defined_vars());
    }







    // عرض المقالات حسب التاج
    public function tag($slug)
    {

        $tag = \App\Models\Tag::where('slug', $slug)->firstOrFail();
        $blogs = $tag->posts()->orderBy('created_at', 'desc')->paginate(12);
        $categories = ArticleType::withCount('posts')->limit(4)->get();
        return view('web.blogs',get_defined_vars());
    }


















}
