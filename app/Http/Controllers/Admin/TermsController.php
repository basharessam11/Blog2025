<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Terms;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TermsController extends Controller
{
       use HasCrudPermissions;


    public function __construct()
    {
         $this->applyCrudPermissions('terms');
    }
    public function index()
    {
        return view('admin.terms.index');
    }

    public function data()
    {
        $service = Terms::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.terms.create');
    }

    public function store(TermsRequest $request)
    {


        // if (Terms::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('terms.index');
        // }
         Terms::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('terms.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $terms = Terms::find($id);
        return view('admin.terms.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TermsRequest  $request,$id)
    {
        $terms = Terms::find($id);
        $terms->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));
        return redirect()->route('terms.edit',1);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Terms::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('terms.index');
    }
}
