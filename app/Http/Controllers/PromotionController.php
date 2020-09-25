<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use Carbon\Carbon;
use App\Productinfo;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $start_date = Carbon::parse($request->sdate)->format('Y-m-d');
        $end_date = Carbon::parse($request->edate)->format('Y-m-d');
        $timenow = Carbon::now()->format('Y-m-d');

        $promotions = Promotion::where('productinfo_id' , $request->product_id)
                                ->get();

        $productCheck = Productinfo::where('id' , $request->product_id)->first();

        if($request->promotionprice >= $productCheck->price)
        {
            $request->session()->flash('danger' , 'Promotion Price Over Product Price ');
            return redirect()->action('ProductinfoController@index');
        }


        foreach($promotions as $promotion)
        {
            if(($start_date >= $promotion->start  && $start_date <= $promotion->end) 
            || 
            ($end_date >= $promotion->start  && $end_date <= $promotion->end)
            || $start_date < $timenow)
            {
                $request->session()->flash('danger' , 'Times Promotion has already exits');
                return redirect()->action('ProductinfoController@index');
            }
        }

        Promotion::create([ 

                            'productinfo_id' =>  $request->product_id ,
                            'start' =>  $start_date ,
                            'end' =>  $end_date ,
                            'discount' =>  $request->promotionprice ,
                            'active' => 1

                        ]);
        
        $request->session()->flash('success' , 'Add Promotion success fully');
        return redirect()->action('ProductinfoController@index');
        
    }


    public function activepromotion(Request $request, $id , $active)
    {
        Promotion::where('id' , $id)
                    ->update(['active'=> abs($active-1)]);

        $request->session()->flash('success' , 'Update Active Promotion success fully');
        return redirect()->action('ProductinfoController@index'); 
    }


    public function CustomDelPro(Request $request, $id , $active)
    {
        if($active == 0)
        {
            Promotion::where('id' , $id)->delete();

            $request->session()->flash('success' , 'Delete Promotion success fully');
            return redirect()->action('ProductinfoController@index'); 
        }
        else
        {
            $request->session()->flash('danger' , 'Someting Wrong Promotion has active');
            return redirect()->action('ProductinfoController@index'); 
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
