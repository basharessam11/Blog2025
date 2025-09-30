<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;

class SubscribeController extends Controller
{
                            use HasCrudPermissions;

   public function __construct()
    {

     $this->middleware('permission:view subscribe')->only(['index', 'show']);
     $this->middleware('permission:edit subscribe')->only(['update', 'edit']);


     $this->middleware('permission:delete subscribe')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subscribe.index');
    }

    public function data()
    {
        $service = Subscribe::orderBy('created_at', 'desc')->get() ;

        return DataTables::of($service)

            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'email' => 'required|email|unique:subscribes,email',
    ]);



    $ip = request()->ip();
    $response = Http::get("http://ip-api.com/json/{$ip}");

        $data = $response->json();
        $country = $data['country'] ?? 'Unknown'; // رمز الدولة (EG لمصر)






    $data = $request->all();
    $data['country'] = $country;
    Subscribe::create($data);



         session()->flash('success', __('admin.Created Successfully'));
                 return redirect()->back();

    }

}
