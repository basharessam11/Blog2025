<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\HasCrudPermissions;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VisitController extends Controller
{
           use HasCrudPermissions;


    public function __construct()
    {
         $this->applyCrudPermissions('visit');
    }
    /**
     * Display a listing of the resource.
     */
  public function index(Request $request)
{
    $query = Visit::query();

    // فلترة حسب التاريخ
    if ($request->filled('from_date') && $request->filled('to_date') && $request->from_date <= $request->to_date) {
        $query->whereBetween('created_at', [
            Carbon::parse($request->from_date)->startOfDay(),
            Carbon::parse($request->to_date)->endOfDay()
        ]);
    } elseif ($request->filled('from_date')) {
        $query->whereDate('created_at', '>=', Carbon::parse($request->from_date)->startOfDay());
    } elseif ($request->filled('to_date')) {
        $query->whereDate('created_at', '<=', Carbon::parse($request->to_date)->endOfDay());
    }

    // ترتيب وعرض النتائج
    $visits = $query->orderBy('created_at', 'desc')->paginate(50)->appends($request->query());

    return view('admin.visit.index', compact('visits'));
}


    public function data()
    {


        $visit = Visit::with('country:id,name')->get(['id', 'ip_address as ip', 'visit_count as count', 'country_id', 'created_at' ]);

        return DataTables::of($visit)

            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,)
    {
        $ex = explode(',', $request->id);



        Visit::destroy($ex);


        session()->flash('success', __('admin.Deleted Successfully'));
        return redirect()->route('visit.index');
    }
}
