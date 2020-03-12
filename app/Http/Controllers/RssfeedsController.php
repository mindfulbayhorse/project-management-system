<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rssfeed;

class RssfeedsController extends Controller
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
        //displaying all recorded rss
        $rss = Rssfeed::all();
        
        return view('rss.index', compact('rss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rss.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'url' => 'required',
            'title' => ['required', 'min:5']
        ]);
        
        Rssfeed::create(request(['url', 'title', 'description']));
        
        return redirect('/rssfeed/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(rssfeed $rssfeed)
    {               
        return view('rss.show', compact('rssfeed'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(rssfeed $rssfeed)
    {                
        return view('rss.edit', compact('rssfeed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(rssfeed $rssfeed)    
    {
        
        $rssfeed->update(request(['url', 'title','description']));
        
        return redirect('/rssfeed/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(rssfeed $rssfeed)
    {
        $rssfeed->delete();   
        
        return redirect('/rssfeed/'); 
    }
}
