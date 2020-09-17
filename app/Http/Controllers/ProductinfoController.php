<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productinfo;
use App\category;
use App\QuatityReport;

class ProductinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Productinfo::all();

        $categories = category::all();

        $product_types = [
                            '1' => 'สินค้าทั่วไป' ,
                            '2' => 'สินค้าใหม่' ,
                            '3' => 'สินค้าแนะนำ' ,
                        ];

        return view('page.productinfo.index' , ['products' => $products , 'categories' => $categories , 'product_types' => $product_types]);

        // return "product info -> index";
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

        $productCheck = Productinfo::where('name' , $request->productname)->first();

        if($productCheck == null)
        {
            
            Productinfo::create([
                                    'category_id'=> $request->category,
                                    'active_count'=> $request->active_count,
                                    'count_quatity'=> 0,
                                    'active'=> 1,
                                    'name'=> $request->productname,
                                    'cost'=> $request->cost,
                                    'price'=> $request->price,
                                    'product_type'=> 1,
                                ]);

            $request->session()->flash('success' , 'Add product success fully');
            return redirect()->action('ProductinfoController@index'); 
        }
        else
        {
            $request->session()->flash('danger' , 'Product has already exit');
            return redirect()->action('ProductinfoController@index'); 
        }


        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Productinfo::where('id' , $id)
                    ->update([  
                                'category_id'=> $request->category,
                                'active_count'=> $request->active_count,
                                'name'=> $request->productname,
                                'cost'=> $request->cost,
                                'price'=> $request->price,
                            ]);

        $request->session()->flash('success' , 'Update Quatity success fully');
        return redirect()->action('ProductinfoController@index'); 
    }


    public function updatecount_product(Request $request, $id)
    {
        //return $id;

        $quatitycheck = QuatityReport::where('productinfo_id' , $id)
                                    ->get()
                                    ->last();


        if($request->typereport == 0)
        {
            Productinfo::where('id' , $id)
                        ->increment('count_quatity' , $request->count_quatity);



            if($quatitycheck == null)
            {
                QuatityReport::create([ 'productinfo_id' =>  $id ,
                                        'old_quatity' =>  0 ,
                                        'quatity' =>  $request->count_quatity ,
                                        'type' =>  0 ,
                                    ]);

            }

            else
            {
                QuatityReport::create([ 'productinfo_id' =>  $id ,
                                        'old_quatity' =>  $quatitycheck->quatity ,
                                        'quatity' =>  ($quatitycheck->quatity + $request->count_quatity) ,
                                        'type' =>  0 ,
                                    ]);
            }

            $request->session()->flash('success' , 'increment Quatity success fully');
            return redirect()->action('ProductinfoController@index');
        }
        else
        {

            Productinfo::where('id' , $id)
                        ->update(['count_quatity'=> $request->count_quatity]);



            QuatityReport::create([ 
                                    'productinfo_id' =>  $id ,
                                    'old_quatity' =>  $quatitycheck->quatity ,
                                    'quatity' =>  $request->count_quatity ,
                                    'type' =>  1 ,
                                ]);


            $request->session()->flash('success' , 'Update Quatity success fully');
            return redirect()->action('ProductinfoController@index'); 
        }


        //
    }


    public function changeproducttype(Request $request, $ptid,$pid)
    {

        Productinfo::where('id' , $pid)
                    ->update(['product_type'=> $ptid]);

        $request->session()->flash('success' , 'Update product_type success fully');
        return redirect()->action('ProductinfoController@index'); 
        //
    }

    public function changeactive(Request $request ,$pid,$active)
    {

        Productinfo::where('id' , $pid)
                    ->update(['active'=> abs($active-1)]);

        $request->session()->flash('success' , 'Update Active success fully');
        return redirect()->action('ProductinfoController@index'); 
     
    }

    public function testcon()
    {
        return "testcon";
     
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "destroy productinfo";
        //
    }
}
