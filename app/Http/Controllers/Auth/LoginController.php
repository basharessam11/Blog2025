<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // لو المستخدم مسجل دخول فعلاً وفتح صفحة اللوجن → يتحول حسب صلاحياته
        $this->middleware(function ($request, $next) {
            if (Auth::check() && $request->is('login')) {
                return redirect($this->redirectPath());
            }
            return $next($request);
        })->only('showLoginForm');

        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * تحديد مكان التحويل بعد تسجيل الدخول
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        // لو الحساب غير مفعل
        if ($user->status != 1) {
            auth()->logout();
            return route('login');
        }

        // جلب أول صلاحية فيها view
        $permission = $user->getAllPermissions()
                           ->pluck('name')
                           ->first(fn($p) => str_starts_with($p, 'view'));

        if ($permission) {
            $routeName = str_replace('view ', '', $permission) . '.index';

            if ($routeName === 'dashboard.index') {
                return route('home');
            }

            if (route($routeName, [], false)) {
                return route($routeName);
            }

            return '/' . str_replace(' ', '-', $routeName);
        }

        return '/'; // fallback لو مفيش أي صلاحيات
    }

    /**
     * لو عايز تفضل تستخدم authenticated
     */
    protected function authenticated($request, $user)
    {
        if ($user->status != 1) {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => 'الحساب غير مفعل، تواصل مع الإدارة.'
            ]);
        }

        return redirect($this->redirectPath());
    }
}
