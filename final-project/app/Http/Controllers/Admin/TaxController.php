<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddTaxRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxs = DB::table('taxs')->orderBy('day_start', 'desc')->get();

        return view('admin.taxs.index', compact('taxs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taxs.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AddTaxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddTaxRequest $request)
    {
        $day_start = Carbon::parse($request->start)->firstOfMonth();
        $day_end = Carbon::parse($request->end_day)->lastOfMonth();
        $lastTax = DB::table('taxs')->orderBy('day_start', 'desc')->first();
        if($lastTax->day_end > $day_start){
            DB::table('taxs')->where('day_start', $lastTax->day_start)->update(['day_end' => $day_start->add('-1 days')]);
        }
        DB::table('taxs')->insert(['day_end' => $day_end, 'day_start' => $day_start, 'tax' => $request->tax]);

        return redirect()->back()->with('message', 'Update Tax successfully!!!');
    }
}
