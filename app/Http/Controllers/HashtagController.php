<?php

namespace App\Http\Controllers;

use App\hashtag;
use Illuminate\Http\Request;

class HashtagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hashtags = hashtag::all();
        return view('page.hashtag.index' , ['hashtags' => $hashtags]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create";
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hashtagCheck = hashtag::where('hashtagname' , $request->hashtagname)->first();

        if($hashtagCheck == null)
        {
            hashtag::create(['hashtagname'=> $request->hashtagname,]);
            $request->session()->flash('success' , 'add hashtag success fully');
            return redirect()->action('HashtagController@index'); 
        }
        else
        {
            $request->session()->flash('warning' , 'hashtag has already exit');
            return redirect()->action('HashtagController@index'); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function show(hashtag $hashtag)
    {
        return "show function";
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function edit(hashtag $hashtag)
    {
        return "edit function";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$hashtag)
    {
        
        $hashtagCheck = hashtag::where('hashtagname' , $request->hashtagname)->first();

        if($hashtagCheck == null)
        {
            hashtag::where('id' , $hashtag)
                    ->update(['hashtagname'=> $request->hashtagname]);

            $request->session()->flash('success' , 'Add hashtag Success fully');
            return redirect()->action('HashtagController@index'); 
        }
        else
        {
            $request->session()->flash('warning' , 'hashtag has already exit');
            return redirect()->action('HashtagController@index'); 
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hashtag  $hashtag
     * @return \Illuminate\Http\Response
     */
    public function destroy(hashtag $hashtag)
    {
        $deleteModel = hashtag::where('id' , $hashtag->id);
        $deleteModel->delete();
        session()->flash('success' , 'Delete hashtag Success fully');
        return redirect()->action('HashtagController@index'); 
    }
}
