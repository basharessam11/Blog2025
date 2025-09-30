<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{

                        use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('role');
    }

    public function index()
    {


        return view('admin.roles.index');
    }


    public function data()
    {
        $role = Role::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($role)

            ->make(true);
    }
    /**
     * Show the form for crateing a new resource.
     */
    public function create()
    {
        $permissions =  Permission::all();
        return view('admin.roles.create',get_defined_vars());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required',
            ]);
            $role = Role::create(['name' => $request->input('name'),'guard_name' => 'web']);
            foreach ($request->permissions as $permission) {
                Permission::updateOrCreate(['name' => $permission]); // إضافة أو تحديث الصلاحيات
            }
            $role->syncPermissions($request->input('permissions'));



        session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('roles.index');



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('name')->toArray(); // ✅ حل المشكلة

        // تجميع الأذونات حسب الصفحة (مثل booking, meeting, contact, ...)
        $groupedPermissions = [];
        foreach ($permissions as $permission) {
            $parts = explode(' ', $permission->name);
            $action = array_shift($parts);
            $module = implode(' ', $parts);

            if (!isset($groupedPermissions[$module])) {
                $groupedPermissions[$module] = [
                    'module' => $module,
                    'actions' => [],
                ];
            }

            $groupedPermissions[$module]['actions'][$action] = $permission->name;
        }

        return view('admin.roles.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request  $request,$id)
    {
        $role = Role::findOrFail($id);

        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array',
        ]);

        // تحديث اسم الدور
        $role->name = $request->name;
        $role->save();

        // تحديث الأذونات
        $role->syncPermissions($request->permissions ?? []);


        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {


        $ex = explode(',', $request->id);

        Role::whereIn('id', $ex)->delete();



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('roles.index');
    }
}
