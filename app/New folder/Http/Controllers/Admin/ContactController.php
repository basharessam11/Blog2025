<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{

    public function __construct()
{
     $this->middleware('permission:view contact')->only(['index', 'show']);


     $this->middleware('permission:delete contact')->only(['destroy']);

 }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view contact');

        return view('admin.contact.index');
    }

    public function data()
    {
        $service = Contact::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.contact.create');
    }

    public function store(ContactRequest $request)
{
     $ipAddress = $request->ip();






     $todayCount = Contact::whereDate('created_at', today())
        ->where('ip_address', $ipAddress)
        ->count();

     if ($todayCount >= 2) {
        session()->flash('error', __('admin.You cannot add more than two entries per day.'));
        return redirect()->route('contact');
    }

     $data = $request->all();
    $data['ip_address'] = $ipAddress;

     Contact::create($data);
     session()->flash('success', __('admin.Created Successfully'));
     return redirect()->route('contact');
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {

        $faq = Contact::find($id);
        return view('admin.contact.edit',get_defined_vars());

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContactRequest  $request,$id)
    {
        $faq = Contact::find($id);
        $faq->update($request->all());



        session()->flash('success',  __('admin.Updated Successfully'));
         return redirect()->route('faq.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $ex = explode(',', $request->id);



        Contact::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('faq.index');
    }
}
