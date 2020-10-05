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
        return view('page.hashtag.index', ['hashtags' => $hashtags]);
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
        $hashtagCheck = hashtag::where('hashtagname', $request->hashtagname)->first();

        if ($hashtagCheck == null) {
            hashtag::create(['hashtagname' => $request->hashtagname]);
            $request->session()->flash('success', 'Add hashtag success fully');
            return redirect()->action('HashtagController@index');
        } else {
            $request->session()->flash('danger', 'hashtag has already exit');
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
    public function update(Request $request, $hashtag)
    {

        $hashtagCheck = hashtag::where('hashtagname', $request->hashtagname)->first();

        if ($hashtagCheck == null) {
            hashtag::where('id', $hashtag)
                ->update(['hashtagname' => $request->hashtagname]);

            $request->session()->flash('info', 'Update hashtag Success fully');
            return redirect()->action('HashtagController@index');
        } else {
            if ($hashtagCheck->id == $hashtag) {
                hashtag::where('id', $hashtag)
                    ->update(['hashtagname' => $request->hashtagname]);

                $request->session()->flash('info', 'Update hashtag Success fully');
                return redirect()->action('HashtagController@index');

            }
            $request->session()->flash('danger', 'hashtag has already exit');
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
        $deletehashtag = hashtag::where('id', $hashtag->id);
        $deletehashtag->delete();
        session()->flash('success', 'Delete hashtag Success fully');
        return redirect()->action('HashtagController@index');
    }
}
