<?php

namespace App\Http\Controllers;

use App\Models\Supplyer;
use Illuminate\Http\Request;

class SupplyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supplyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplyer = Supplyer::create($request->validate([
            'name'=>'required',
            'url' => 'nullable'
        ]));
        
        redirect($supplyer->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplyer  $Supplyer
     * @return \Illuminate\Http\Response
     */
    public function show(Supplyer $supplyer)
    {

       return view('supplyers.show', compact('supplyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplyer  $Supplyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplyer $Supplyer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplyer  $Supplyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplyer $Supplyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplyer  $Supplyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplyer $Supplyer)
    {
        //
    }
}
