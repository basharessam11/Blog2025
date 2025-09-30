<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\UserRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
                        use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('setting');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings.index',get_defined_vars() );

    }


    public function create()
    {
        return view('settings.create');
    }

    public function store(SettingRequest $request)
    {
        $setting=Setting::create($request->all());
        if ($request->hasFile('photo')) {

            $setting->setImageAttribute([$request->file('photo')]);
            $setting->save();
        }




        return redirect()->route('settings.index')->with('success', 'Setting created successfully.');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(SettingRequest $request, Setting $setting)
    {


        $data = $request->except('photo');

         $fields = ['Contact', 'FAQ', 'Sessions', 'Products', 'Services', 'About', 'Story', 'Blogs'];

        foreach ($fields as $field) {
            $data[$field] = $request->input($field, 0);
        }






        $setting->update($data);
        if ($request->hasFile('photo')) {

            if ($setting->photo) {
                Storage::disk('service')->delete($setting->photo);
            }
            $setting->setImageAttribute([$request->file('photo')]);
            $setting->save();
        }



        return redirect()->route('settings.index')->with('success',__('admin.Updated Successfully'));
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('settings.index') ;
    }











    public function pages()
    {
        $settings = Setting::first();
        return view('admin.pages.index', ['settings'=>$settings]);

    }


    public function pageupdate(Request $request )
    {

$setting = Setting::FindOrFail(1);


        $request->validate([
            'photo_about' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_services' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_products' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_faq' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_contact' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($request->hasFile('photo_about')) {

            if ($setting->photo_about) {
                Storage::disk('service')->delete($setting->photo_about);
            }
             $setting->setImageAttribute1([$request->file('photo_about'), 'photo_about']);
            $setting->save();

        }

        if ($request->hasFile('photo_services')) {

            if ($setting->photo_services) {
                Storage::disk('service')->delete($setting->photo_services);
            }
            $setting->setImageAttribute1([$request->file('photo_services'), 'photo_services']);
            $setting->save();
        }

        if ($request->hasFile('photo_products')) {

            if ($setting->photo_products) {
                Storage::disk('service')->delete($setting->photo_products);
            }
            $setting->setImageAttribute1([$request->file('photo_products'), 'photo_products']);
            $setting->save();
        }


        if ($request->hasFile('photo_faq')) {

            if ($setting->photo_faq) {
                Storage::disk('service')->delete($setting->photo_faq);
            }
            $setting->setImageAttribute1([$request->file('photo_faq'), 'photo_faq']);
            $setting->save();
        }

        if ($request->hasFile('photo_contact')) {

            if ($setting->photo_contact) {
                Storage::disk('service')->delete($setting->photo_contact);
            }
            $setting->setImageAttribute1([$request->file('photo_contact'), 'photo_contact']);
            $setting->save();
        }

        return redirect()->route('page.show')->with('success',__('admin.Updated Successfully'));
    }

}
