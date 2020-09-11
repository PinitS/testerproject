<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        return view('page.category.index' , ['categories' => $categories]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    
        $categoryCheck = category::where('categoryname' , $request->categoryname)->first();

        if($categoryCheck == null)
        {
            category::create(['categoryname'=> $request->categoryname,]);
            $request->session()->flash('success' , 'Add category success fully');
            return redirect()->action('CategoryController@index'); 
        }
        else
        {
            $request->session()->flash('danger' , 'category has already exit');
            return redirect()->action('CategoryController@index'); 
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        return "show";
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return "category";
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $categoryCheck = category::where('categoryname' , $request->categoryname)->first();

        if($categoryCheck == null)
        {
            category::where('id' , $category->id)
                    ->update(['categoryname'=> $request->categoryname]);

            $request->session()->flash('info' , 'Update category Success fully');
            return redirect()->action('CategoryController@index'); 
        }
        else
        {
            if($categoryCheck->id == $category->id)
            {
                category::where('id' , $category->id)
                        ->update(['categoryname'=> $request->categoryname]);

                $request->session()->flash('info' , 'Update category Success fully');
                return redirect()->action('CategoryController@index'); 

            }
            $request->session()->flash('danger' , 'category has already exit');
            return redirect()->action('CategoryController@index'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $deletecategory = category::where('id' , $category->id);
        $deletecategory->delete();
        session()->flash('success' , 'Delete category Success fully');
        return redirect()->action('CategoryController@index'); 
    }
}
