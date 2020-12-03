<?php

namespace App\Http\Controllers;

use App\Models\SectionTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SectionTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.sections.index',[
            'sections' => SectionTitle::all(),
            'section' => $this->getSection()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section = SectionTitle::create($request->validate([
            'code' => 'required',
            'title' => 'required'
        ]));
        
        return redirect(action([get_class($this), 'edit'], ['section' => $section]));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function show(SectionTitle $sectionTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SectionTitle  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(SectionTitle $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SectionTitle $sectionTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SectionTitle  $sectionTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(SectionTitle $sectionTitle)
    {
        //
    }
    
    public function getSection(){
        
        return SectionTitle::where('code', Route::currentRouteName())->get()->first();
    }
}
