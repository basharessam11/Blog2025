<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function authorizeDynamic(Request $request, $modelClass)
    {
        // استخراج اسم الميثود من الـ Route
        $action = $request->route()->getActionMethod(); // مثل (edit, update, delete)

        // تحويل اسم الميثود إلى صلاحية متوافقة مع الـ Policies
        $permission = Str::snake($action); // تحويل edit إلى edit_teacher مثلاً

        // استخراج اسم الموديل لاستخدامه مع الصلاحية
        $modelName = Str::snake(class_basename($modelClass)); // تحويل Teacher إلى teacher

        // دمج الصلاحية مع اسم الموديل
        $fullPermission = "$permission $modelName"; // مثل edit_teacher

        // تنفيذ التفويض
        $this->authorize($fullPermission);
    }
}
