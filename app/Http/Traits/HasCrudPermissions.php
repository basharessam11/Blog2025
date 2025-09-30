<?php
namespace App\Http\Traits;


trait HasCrudPermissions
{
    /**
     * Apply CRUD permissions middleware dynamically.
     *
     * @param string $module اسم الموديول مثل 'users', 'roles', 'departments' ...
     */
    public function applyCrudPermissions(string $module)
    {
        // عرض
        $this->middleware("permission:view $module")->only(['index','show']);

        // إنشاء
        $this->middleware("permission:create $module")->only(['create','store']);

        // تعديل
        $this->middleware("permission:edit $module")->only(['edit','update']);

        // حذف
        $this->middleware("permission:delete $module")->only('destroy');
    }
}
