<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryReqest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\BlogCategory;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
  use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('blog category');
    }
    public function index()
    {
        return view('admin.blog_category.index');
    }

    public function data()
    {
        $service = BlogCategory::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog_category.create');
    }

    public function store(BlogCategoryReqest $request)
    {


        // if (blog_category::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('blog_category.index');
        // }
        BlogCategory::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('blog_category.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $blog_category = BlogCategory::find($id);
        return view('admin.blog_category.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogCategoryReqest  $request,$id)
    {
        $blogCategory = BlogCategory::find($id);
        $blogCategory->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('blog_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        BlogCategory::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('blog_category.index');
    }
}
