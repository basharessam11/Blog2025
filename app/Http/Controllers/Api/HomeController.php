<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\Courses_ReviewRequest;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\Booking;
use App\Models\Card;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Countries;
use App\Models\Courses;
use App\Models\Courses_Item;
use App\Models\Courses_Review;
use App\Models\Courses_Time;
use App\Models\Faq;
use App\Models\Meta;
use App\Models\Order;
use App\Models\Policy;
use App\Models\Product;
use App\Models\Rateing;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Story;
use App\Models\Subscribe;
use App\Models\SuccessStory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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


     #########################################index##############################################################
    public function index($lang)
    {
        $customer_id = Auth::guard('customer')->id();
            $meta = Meta::select('index_title_' . $lang . ' as title' , 'index_description_' . $lang . ' as description' )->findORFail(1);

             $slider = Slider::select(['id', 'title_' . $lang . ' as title', 'title_' . $lang . '1 as title1', 'description_' . $lang . ' as description', 'photo'])->get();
            $setting = Setting::select('name', 'counter1', 'counter2', 'counter3', 'counter4', 'photo','instagram','youtube','facebook','location','email','phone')->firstOrFail();
            $cards = Card::select(['id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description', 'photo'])->get();
            $courses = Courses::latest()
                ->limit(3)
                ->select('title_' . $lang . ' as title', 'price' , 'slug_' . $lang . ' as slug', 'photo')
                ->withCount('review')
                ->withAvg('review', 'rate')
                ->get();
            $teacher = User::select(['id', 'name_' . $lang . ' as name','photo','category' ])->where('role',2)->limit(4)->get();


            $rateings = Rateing::latest()->limit(5)->get();
            $blogs = Blog::latest()
                ->limit(3)
                ->get(['id', 'title_' . $lang . ' as title', 'slug_' . $lang . ' as slug','overview_' . $lang . ' as overview',  'photo', 'created_at', 'updated_at']);


        return response()->json(get_defined_vars());
    }
     #########################################end index##############################################################


     #########################################faq##############################################################

    public function faq($lang)
    {


        $customer_id = Auth::guard('customer')->id();
            $faqs = Faq::select(['id', 'title_' . $lang . ' as title',   'description_' . $lang . ' as description' ])->firstOrFail();

        return response()->json(get_defined_vars()) ;


    }

     #########################################end faq##############################################################


     #########################################about##############################################################

    public function about($lang)
    {

        $customer_id = Auth::guard('customer')->id();

            $meta = Meta::select('about_title_' . $lang . ' as title' , 'about_description_' . $lang . ' as description' )->findORFail(1);
        $about = About::select(['id', 'title_' . $lang . ' as title',   'description_' . $lang . ' as description' ])->get();


        return response()->json(get_defined_vars()) ;


    }
     #########################################end about##############################################################


     #########################################teacher##############################################################

    public function teacher($lang)
    {

        $customer_id = Auth::guard('customer')->id();

            $meta = Meta::  select('teacher_title_' . $lang . ' as title' , 'teacher_description_' . $lang . ' as description' )->findORFail(1);
            $teacher = User::select(['id', 'name_' . $lang . ' as name' ,'photo','category' ])->where('role',2)->get();


        return response()->json(get_defined_vars()) ;


    }
     #########################################end teacher##############################################################


     #########################################teacher_details##############################################################

    public function teacher_details($lang,$id)
    {
        $customer_id = Auth::guard('customer')->id();
            $meta = User::select([ 'name_' . $lang . ' as title',   'meta_description_' . $lang . ' as description' ])->FindOrFail($id) ;
            $teacher = User::select(['id', 'name_' . $lang . ' as name',   'overview_' . $lang . ' as overview' ,'photo','category'])->with(['userDescription' => function($query) use ($lang) {
                $query->select('id','user_id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description');
            }])->FindOrFail($id) ;

            return response()->json(get_defined_vars()) ;

    }
     #########################################end teacher_details##############################################################



     #########################################policy##############################################################


    public function policy($lang)
    {
        $customer_id = Auth::guard('customer')->id();
            $meta = Meta::select('policies_title_' . $lang . ' as title' , 'policies_description_' . $lang . ' as description' )->findORFail(1);
            $policy = Policy::select(['id', 'title_' . $lang . ' as title',   'description_' . $lang . ' as description' ])->get();

        return response()->json(get_defined_vars()) ;

    }
     #########################################end policy##############################################################


     #########################################countries##############################################################
    public function countries()
    {
        $customer_id = Auth::guard('customer')->id();
        $countries = Countries::all();
        return response()->json(get_defined_vars()) ;


    }
     #########################################end countries##############################################################


     #########################################courses##############################################################
    public function courses($lang)
    {

        $customer_id = Auth::guard('customer')->id();

        $meta = Meta::select('courses_title_' . $lang . ' as title' , 'courses_description_' . $lang . ' as description' )->findORFail(1);
        $courses = Courses::latest()
        ->select('title_' . $lang . ' as title' , 'price', 'slug_' . $lang . ' as slug',  'photo')
        ->withCount('review')
        ->withAvg('review', 'rate')
        ->get();

        return response()->json(get_defined_vars()) ;


    }

     #########################################end courses##############################################################

     #########################################courses_details##############################################################

    public function courses_details($lang,$slug)
    {

        $customer_id = Auth::guard('customer')->id();



    $meta = Courses::select([ 'title_' . $lang . ' as title',   'meta_description_' . $lang . ' as description' ])->where('slug_en', 'like', '%' . $slug . '%')
    ->orWhere('slug_ar', 'like', '%' . $slug . '%')->first() ;
        $reviews = Courses_Review::all()->makeHidden(['ip_address']);

        $courses = Courses::select('id', 'title_' . $lang . ' as title', 'price','discount_date',DB::raw("DATEDIFF(discount_date,CURDATE()) as days"),'discount','discount_rate', 'slug_' . $lang . ' as slug', 'overview_' . $lang . ' as overview' , 'photo', 'video', 'tax', 'tax1', 'user_id', 'created_at', 'updated_at')
        ->with(['user' => function($query) use ($lang) {
            $query->select('id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description');
        }])
        ->with(['items' => function($query) use ($lang) {
            $query->select('id','course_id', 'name_' . $lang . ' as name', 'description_' . $lang . ' as description');
        }])

        ->with(['coursesDescription' => function($query) use ($lang) {
            $query->select('id','course_id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description');
        }])

        ->where('slug_en', 'like', '%' . $slug . '%')
        ->orWhere('slug_ar', 'like', '%' . $slug . '%')->
        with('user')->first() ;


        $avg1 = Courses_Review::where('course_id',  $courses->id)->avg('rate');
        $avg = number_format($avg1, 1);
        $num1 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>1])->count();
        $num2 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>2])->count();
        $num3 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>3])->count();
        $num4 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>4])->count();
        $num5 = Courses_Review::where(['course_id'=>$courses->id,'rate'=>5])->count();

        $num = Courses_Review::all()->count();




        $vars = get_defined_vars();
        unset($vars['avg1']);
        return response()->json($vars);
    }

     #########################################end courses_details##############################################################


     #########################################blog##############################################################


    public function blog($lang)
    {
$customer_id = Auth::guard('customer')->id();
            $meta = Meta::select('blog_title_' . $lang . ' as title' , 'blog_description_' . $lang . ' as description' )->findORFail(1);

            $blogs = Blog::select(
                'id',
                'title_' . $lang . ' as title',
                'slug_' . $lang . ' as slug',
                'overview_' . $lang . ' as overview',
                'tag_' . $lang . ' as tags',
                'photo',
                'created_at',
                'updated_at'
            ) ->get();




        return response()->json(get_defined_vars()) ;

    }

     #########################################end blog##############################################################


     #########################################blog_details##############################################################

    public function blog_details($lang,$slug)
    {

        $customer_id = Auth::guard('customer')->id();
    $meta = Blog::select('title_' . $lang . ' as title' , 'meta_description_' . $lang . ' as description' )->where('slug_en', 'like', '%' . $slug . '%')
    ->orWhere('slug_' . $lang . '', 'like', '%' . $slug . '%')->first() ;
        $blog = Blog::select(
            'id',
            'title_' . $lang . ' as title',
            'slug_' . $lang . ' as slug',
            'tag_' . $lang . ' as tags',
            'photo',
            'created_at',
            'updated_at'
        )->where('slug_en', 'like', '%' . $slug . '%')
        ->with(['blogDescription' => function($query) use ($lang) {
            $query->select('id','blog_id', 'title_' . $lang . ' as title', 'description_' . $lang . ' as description');
        }])
        ->orWhere('slug_ar', 'like', '%' . $slug . '%')->first() ;



        return response()->json(get_defined_vars()) ;

    }
     #########################################end blog_details##############################################################


     #########################################subscribe##############################################################

    public function subscribe(Request $request)
    {
        $customer_id = Auth::guard('customer')->id();

$subscribe= Subscribe::where('email', $request->email)->first();
if (!$subscribe) {
     $ip = request()->ip();
    $response = Http::get("http://ip-api.com/json/{$ip}");

        $data = $response->json();
        $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)






    $data = $request->all();
    $data['country'] = $country;
    Subscribe::create($data);



            return response()->json([
                'status' => 'success',
                'message' => 'تم تسجيل الدخول بنجاح',

            ], 200);



    }
           return response()->json([
            'status' => 'error',
            'message' => 'بيانات تسجيل الدخول غير صحيحة.',
        ], 401);


}
     #########################################end subscribe##############################################################

     #########################################contact##############################################################


public function contact(Request $request)
{
    $customer_id = Auth::guard('customer')->id();
    $ipAddress = $request->ip();

     $todayCount = Contact::whereDate('created_at', today())
        ->where('ip_address', $ipAddress)
        ->count();

     if ($todayCount >= 2) {
        return response()->json([
            'message' => __('admin.You cannot add more than two entries per day.')
        ], 400);
    }


    $data = $request->all();
    $data['ip_address'] = $ipAddress;

    Contact::create($data);

    return response()->json([
        'message' => __('admin.Created Successfully'),
        'data' => $data
    ], 201);

}
     #########################################end contact##############################################################



     #########################################booking##############################################################

public function booking(Request $request)
{
    if (!Auth::guard('customer')->check()) {
        return response()->json([
            'success' => false,
            'message' => 'المستخدم غير مسجل الدخول',
        ], 401);

    }
    $bookingExists = Booking::where([
        'date' => $request->date,
        'course_id' => $request->course_id,
        'customer_id' => $request->customer_id,
        'time' => $request->time
    ])->exists();





    $course = Courses::where(['id' => $request->course_id])->first();

    if ($bookingExists) {
         return response()->json([
            'success' => false,
            'message' => __('admin.This appointment is already booked.')
        ], 400);
    } else {
        $ip = request()->ip();
        $response = Http::get("http://ip-api.com/json/{$ip}");

        if ($response->successful()) {
            $data = $response->json();
            $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)

                $price = $course->price -$course->discount  ;

        }

         $data = $request->all();
        $data['total'] = $price;
        $book = Booking::create($data);
        $book->country = $country;
        $book->save();

        // رد بنجاح
        return response()->json([
            'success' => true,
            'message' => __('admin.Booking successful.'),
            'data' => $book
        ], 201);
    }
}

     #########################################end booking##############################################################


          #########################################courses_review##############################################################


public function courses_review(Courses_ReviewRequest $request)
{

    // return$request;
    $ipAddress = $request->ip();
     $existingReview = Courses_Review::where('course_id', $request->course_id)
                        ->where('ip_address', $ipAddress)
                        ->first();

    if ($existingReview) {
        return response()->json([
            'error' => __('admin.You cannot make more than one review.')
        ], 400);
    }

     $ipAddress = $request->ip();
    $data = $request->all();
    $data['ip_address'] = $ipAddress;

     Courses_Review::create($data);

    return response()->json([
        'success' => __('admin.Created Successfully')
    ], 201);
}
     #########################################end courses_review##############################################################

function session()  {

    return Auth::guard('customer')->logout();

}

}
