<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\OrderDetail;
use App\OrderDetailmaterial;
use App\OrderSet;
use App\Cart;
use App\CartDetail;


class OrderController extends Controller
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
        Order::create([
                        'user_id' =>  $request->user_id ,
                        'status' =>  0 
                    ]);

        $orderlast = Order::get()
                        ->last();

        OrderSet::create([
                            'order_id' =>  $orderlast->id ,
                            'status' =>  0 ,
                            'times' =>  1 
                        ]);

        $orderSetlast = OrderSet::get()
                        ->last();

        $CartUsers = Cart::where('user_id' , $request->user_id)
                    ->get();

        foreach($CartUsers as $CartUser)
        {

            OrderDetail::create([
                                    'order_id'=> $orderlast->id,
                                    'order_detail_id' => $CartUser->id,
                                    'order_set_id' => $orderSetlast->id,
                                    'productinfo_id' =>  $CartUser->productinfo_id ,
                                    'productname' => $CartUser->productname,
                                    'price' =>  $CartUser->price ,
                                    'quatity' =>  $CartUser->quatity ,
                                    'note' =>  $CartUser->note ,
                                    'totalprice' =>  $CartUser->totalprice ,
                                    'textpromotion' =>  $CartUser->textpromotion 
                                ]);

            foreach($CartUser->CartDetail as $CartDetail)
            {
                OrderDetailmaterial::create([
                                                'order_id'=> $orderlast->id,
                                                'order_set_id'=> $orderSetlast->id,
                                                'order_detail_id' =>  $CartUser->id ,
                                                'material_id'=> $CartDetail->material_id,
                                                'materialName'=> $CartDetail->materialName,
                                                'price'=> $CartDetail->price,
                                                'quatity'=> $CartUser->quatity,
                                                'total_price'=> $CartDetail->total_price,
                                            ]);

            }

        }

        Cart::where('user_id', $request->user_id)
                    ->delete();
        
        CartDetail::where('user_id', $request->user_id)
        ->delete();

        $request->session()->flash('success' , 'Add product success fully');
        return redirect()->action('CashierController@CustomShow' , ['oid' => 0]); 
        //
    }


    public function CustomNewOrder(Request $request,$usid)
    {
        return $C;
        //
        Order::create([
                        'user_id' =>  $usid ,
                        'status' =>  0 
                        ]);

        $orderlast = Order::get()->last();

        OrderSet::create([
                            'order_id' =>  $orderlast->id ,
                            'status' =>  0 ,
                            'times' =>  0
                        ]);

        $request->session()->flash('success' , 'Add product success fully');
        return redirect()->action('CashierController@CustomShow' , ['oid' => 0]); 
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
