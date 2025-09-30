<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolicyRequest;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Policy;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PolicyController extends Controller
{
                use HasCrudPermissions;

   public function __construct()
    {
         $this->applyCrudPermissions('policy');
    }
    public function index()
    {
        return view('admin.policy.index');
    }

    public function data()
    {
        $service = Policy::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.policy.create');
    }

    public function store(PolicyRequest $request)
    {


        // if (Policy::count() >= 4) {
        //     session()->flash('error', 'لا يمكن إضافة أكثر من 4 عناصر!');
        //     return redirect()->route('policy.index');
        // }
         Policy::create($request->all());





         session()->flash('success', __('admin.Created Successfully'));
        return redirect()->route('policy.index');



    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $policy = Policy::find($id);
        return view('admin.policy.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PolicyRequest  $request,$id)
    {
        $policy = Policy::find($id);
        $policy->update($request->all());




        session()->flash('success',  __('admin.Updated Successfully'));

        return redirect()->route('policy.edit',1);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Policy::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));

        return redirect()->route('policy.index');
    }
}
