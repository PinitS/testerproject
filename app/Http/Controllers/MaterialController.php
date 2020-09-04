<?php

namespace App\Http\Controllers;

use App\material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = material::all();
        return view('page.material.index' , ['materials' => $materials]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "create func";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $hashtagCheck = material::where('materialname' , $request->materialname)->first();

        if($hashtagCheck == null)
        {
            material::create([

                                'materialname'  => $request->materialname,
                                'materialprice' => $request->materialprice,

                            ]);
            $request->session()->flash('success' , 'add material success fully');
            return redirect()->action('MaterialController@index'); 
        }
        else
        {
            $request->session()->flash('warning' , 'material has already exit');
            return redirect()->action('MaterialController@index'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(material $material)
    {
        return "show func";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(material $material)
    {
        return "edit func";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$material)
    {

        $materialCheck = material::where('materialname' , $request->materialname)->first();

        if($materialCheck == null)
        {
            material::where('id' , $material)
                    ->update([
                                'materialname'=> $request->materialname,
                                'materialprice'=> $request->materialprice
                            ]);

            $request->session()->flash('success' , 'Update material Success fully');
            return redirect()->action('MaterialController@index'); 
        }
        else
        {
            if($materialCheck->id == $material)
            {
                material::where('id' , $material)
                        ->update([
                                    'materialname'=> $request->materialname,
                                    'materialprice'=> $request->materialprice
                                ]);

                $request->session()->flash('success' , 'Update material Success fully');
                return redirect()->action('MaterialController@index'); 
            }

            $request->session()->flash('warning' , 'material has already exit');
            return redirect()->action('MaterialController@index'); 
        }
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(material $material)
    {
        $deletematerial = material::where('id' , $material->id);
        $deletematerial->delete();
        session()->flash('success' , 'Delete Material Success fully');
        return redirect()->action('MaterialController@index'); 
    }
}
