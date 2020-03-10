<?php

namespace App\Http\Controllers;

use App\Work_amount;
use Illuminate\Http\Request;

class WorkAmountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workUnits = Work_amount::all();
        return view('work_units.index', compact('workUnits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('work_units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $this->validateFields($request);
        
        Work_amount::create($fields);
        
        return redirect('/work_units/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Work_amount  $work_amount
     * @return \Illuminate\Http\Response
     */
    public function show(Work_amount $work_amount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Work_amount  $work_amount
     * @return \Illuminate\Http\Response
     */
    public function edit(Work_amount $work_amount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Work_amount  $work_amount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work_amount $work_amount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Work_amount  $work_amount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work_amount $work_amount)
    {
        //
    }
    
    /**
     * Check the requirements for title and description fields
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateFields(Request $request){
        
        return $request->validate([
            'name' => 'required|min:2',
            'description' => 'nullable|min:10'
        ]);
    }
}
