<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\About;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
      use HasCrudPermissions;

        public function __construct()
    {
         $this->applyCrudPermissions('about');
    }
    public function index()
    {
        return view('admin.about.index');
    }

    public function data()
    {
        $service = About::orderBy('created_at', 'desc')->where('id','!=',1)->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about.create');
    }

    public function store(AboutRequest $request)
    {


        // if (About::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('about.index');
        // }
         About::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('about.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $about = About::find($id);
        return view('admin.about.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest  $request,$id)
    {
        $about = About::find($id);
        $about->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('about.index');
    }





    public function edit1( $id)
    {

        $about = About::find($id);
        return view('admin.about.edit1',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update1(AboutRequest  $request,$id)
    {


        $about = About::find($id);
        $about->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('about.edit1',1);
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        About::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('about.index');
    }
}
