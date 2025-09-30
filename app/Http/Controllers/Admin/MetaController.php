<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutRequest;
use App\Http\Requests\MetaRequest;
use App\Models\About;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function __construct()
{
     $this->middleware('permission:view meta')->only(['index', 'show']);

     $this->middleware('permission:edit meta')->only(['edit', 'update']);

     $this->middleware('permission:delete meta')->only(['destroy']);

 }
    public function index()
    {
        $meta = Meta::findOrfail(1);
        return view('admin.meta.index',get_defined_vars());
    }



    public function update(MetaRequest $request,  $id)
    {






        $meta = Meta::findOrFail(1);
        $meta->update($request->all());





    session()->flash('success',  __('admin.Updated Successfully'));
            return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */

}
