<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // البحث عن العميل
        $customer = Customer::where('email', $request->email)->first();

        // التحقق من صحة البيانات
        if (!$customer || !Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // حذف جميع التوكنات القديمة (اختياري)
        $customer->tokens()->delete();

        // إنشاء توكن جديد
        $token = $customer->createToken('CustomerToken')->plainTextToken;

        return response()->json([
            'customer' => $customer,
            'token' => $token,
        ]);
    }


    public function register(Request $request)
    {

        // return$request;
        try {
            // التحقق من صحة البيانات المدخلة
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:150|unique:customers,email',
                'phone' => 'required|string|unique:customers,phone',
                'password' => 'required|string|min:8|confirmed',
                'age' => 'required|integer|min:1',
                'country_id' => 'required|exists:countries,id',
            ]);

            // إنشاء المستخدم الجديد
            $customer = Customer::create($request->all());

            $customer->password = Hash::make($request->password);

            $customer->save();

            // إنشاء توكن للمستخدم الجديد
            $token = $customer->createToken('CustomerToken')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => 'تم إنشاء الحساب بنجاح',
                'customer' => $customer,
                'token' => $token,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ في البيانات المدخلة',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'حدث خطأ غير متوقع',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return response()->json([
           'status' =>'success',
           'message' => 'تم تسجيل الخروج بنجا��',
        ], 200);
    }
}
