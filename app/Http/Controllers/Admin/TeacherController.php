<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Country;
use App\Models\User;
use App\Models\UserDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{

       use HasCrudPermissions;


    public function __construct()
    {
         $this->applyCrudPermissions('user');
    }
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $users = User::with('country:id,name', 'roles') // حمّل العلاقة
        ->when($request->search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name_ar', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($request->role, function ($query, $role) {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('id', $role); // أو where('name', $role) لو بتبحث بالاسم
            });
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    $roles = Role::get(['id','name']);

    return view('admin.users.index', compact('users', 'roles'));
}




    public function create()
    {
        $country = Country::all();
$roles = Role::get(['id','name']);
        return view('admin.users.create',  get_defined_vars());

    }

    public function store( UserRequest $request)
    {



        $user=User::create($request->except('photo' ,'role'));
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }
        if ($request->hasFile('photo')) {

            $user->setImageAttribute([$request->file('photo')]);
            $user->save();
        }
         $user->assignRole($request->role);




        return redirect()->route('users.index')->with('success', __('admin.Created Successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::all();
        $teachers = User::FindOrFail($id);
        $roles = Role::get(['id','name']);
        return view('admin.users.edit',  get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request,  $id)
    {


        $user = User::findOrFail($id);
         $user->update($request->except('photo', 'password','role'));

         if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }


        if ($request->hasFile('photo')) {

            if ($user->photo) {
                Storage::disk('setting')->delete($user->photo);
            }
            $user->setImageAttribute([$request->file('photo')]);
            $user->save();
        }
         $user->save();


    $user->syncRoles([$request->role]);

        return redirect()->route('users.index')->with('success', __('admin.Updated Successfully'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



foreach ($ex as $key => $value) {
    $teacher = User::findOrFail($value);
    if ($teacher->photo) {
        Storage::disk('setting')->delete($teacher->photo);
    }
    $teacher->delete();
}



session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->back();
    }
}
