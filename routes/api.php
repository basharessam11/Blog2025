<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/customer/session', function (Request $request) {

    return response()->json(Auth::guard('customer1')->user());
});

Route::get('/customer-id', function () {
    return  json_decode(request()->cookie('token'), true);

});
Route::group([

    'middleware' => 'api',

], function ($router) {

      Route::post('login', [AuthController::class, 'login']);
      Route::post('register', [AuthController::class, 'register']);

      Route::get('index/{lang}', [HomeController::class, 'index']);

      Route::get('faq/{lang}', [HomeController::class, 'faq']);

      Route::get('about/{lang}', [HomeController::class, 'about']);


      Route::get('countries', [HomeController::class, 'countries']);
      Route::get('logout', [AuthController::class, 'logout'])->name('api_logout');



      Route::get('/test-session', function () {
        $customerId = auth('customer')->id();

        if (Auth::guard('customer')->check()) {
            return response()->json([
                'customer' => Auth::guard('customer')->user()
            ]);
        }

        return response()->json(['message' => 'لم يتم العثور على مستخدم مسجل'], 401);
      });

      Route::get('policy/{lang}', [HomeController::class, 'policy']);

      Route::get('blog/{lang}', [HomeController::class, 'blog']);
      Route::get('blog/{lang}/{slug}', [HomeController::class, 'blog_details']);

      Route::get('courses/{lang}', [HomeController::class, 'courses'])->name('courses');
      Route::get('courses/{lang}/{slug}', [HomeController::class, 'courses_details'])->name('courses_details');

      Route::post('contact', [HomeController::class, 'contact']);

    //   Route::get('gallary', [HomeController::class, 'gallary']);

      Route::post('subscribe', [HomeController::class,'subscribe'])->name('subscribe');

      Route::get('teacher/{lang}', [HomeController::class, 'teacher'])->name('teacher');
      Route::get('teacher/{lang}/{slug}', [HomeController::class, 'teacher_details']) ;


      Route::post('booking', [HomeController::class, 'booking']);
      Route::post('courses_review', [HomeController::class, 'courses_review']);





      Route::post('make-payment', [PaymentController::class, 'createPayment']);
    // Route::post('v1/marketing-clients-store', [MarketingClientController::class,'apiStore']);
    // Route::get('v1/appointements/getAll/{type}', [AppointmentController::class, 'getAll'])->name('appointments.getAll');
    // Route::get('v1/appointements-show-report/{id}', [AppointmentController::class, 'showReport'])->name('appointments.showReport');
    // Route::get('v1/appointements-edit-appointment/{id}', [AppointmentController::class, 'editAppointmentApi'])->name('appointments.editAppointmentApi');
    // Route::post('v1/appointements-update-appointment/{id}', [AppointmentController::class, 'editAppointment'])->name('appointments.updateAppointmentApi');
});
