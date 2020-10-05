<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\Order;
use App\OrderDetail;
use App\OrderDetailmaterial;
use App\OrderSet;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $CartUsers = Cart::where('user_id', $request->user_id)->get();

        if ($request->oid == 0) {
            Order::create([
                'user_id' => $request->user_id,
                'status' => 0,
            ]);

            $orderlast = Order::get()->last();

            OrderSet::create([
                'order_id' => $orderlast->id,
                'status' => 0,
                'times' => 1,
                'user_id' => $request->user_id,
            ]);

            $orderSetlast = OrderSet::get()->last();

        } else {

            $checktimes = OrderSet::where('id', $request->osetid)->get()->first();

            if ($checktimes->times == 0) {

                OrderSet::where('id', $request->osetid)
                    ->update(['times' => 1]);

                $orderSetlast = OrderSet::where('id', $request->osetid)
                    ->get()
                    ->last();
            } else {
                OrderSet::create([
                    'order_id' => $request->oid,
                    'status' => 0,
                    'times' => $checktimes->times + 1,
                    'user_id' => $request->user_id,
                ]);
                $orderSetlast = OrderSet::get()->last();
            }

        }

        foreach ($CartUsers as $CartUser) {
            if ($CartUser->oid == 0) {

                OrderDetail::create([
                    'order_id' => $orderlast->id,
                    'order_detail_id' => $CartUser->id,
                    'order_set_id' => $orderSetlast->id,
                    'productinfo_id' => $CartUser->productinfo_id,
                    'productname' => $CartUser->productname,
                    'price' => $CartUser->price,
                    'quatity' => $CartUser->quatity,
                    'note' => $CartUser->note,
                    'totalprice' => $CartUser->totalprice,
                    'textpromotion' => $CartUser->textpromotion,
                ]);

                foreach ($CartUser->CartDetail as $CartDetail) {
                    OrderDetailmaterial::create([
                        'order_id' => $orderlast->id,
                        'order_set_id' => $orderSetlast->id,
                        'order_detail_id' => $CartUser->id,
                        'material_id' => $CartDetail->material_id,
                        'materialName' => $CartDetail->materialName,
                        'price' => $CartDetail->price,
                        'quatity' => $CartUser->quatity,
                        'total_price' => $CartDetail->total_price,
                    ]);

                }
            } else {
                OrderDetail::create([
                    'order_id' => $CartUser->oid,
                    'order_detail_id' => $CartUser->id,
                    'order_set_id' => $orderSetlast->id,
                    'productinfo_id' => $CartUser->productinfo_id,
                    'productname' => $CartUser->productname,
                    'price' => $CartUser->price,
                    'quatity' => $CartUser->quatity,
                    'note' => $CartUser->note,
                    'totalprice' => $CartUser->totalprice,
                    'textpromotion' => $CartUser->textpromotion,
                ]);

                foreach ($CartUser->CartDetail as $CartDetail) {
                    OrderDetailmaterial::create([
                        'order_id' => $CartUser->oid,
                        'order_set_id' => $orderSetlast->id,
                        'order_detail_id' => $CartUser->id,
                        'material_id' => $CartDetail->material_id,
                        'materialName' => $CartDetail->materialName,
                        'price' => $CartDetail->price,
                        'quatity' => $CartUser->quatity,
                        'total_price' => $CartDetail->total_price,
                    ]);

                }
            }

        }

        Cart::where('user_id', $request->user_id)->delete();

        CartDetail::where('user_id', $request->user_id)->delete();

        $request->session()->flash('success', 'Add product success fully');
        return redirect()->action('CashierController@CustomShow', ['oid' => 0]);
        //
    }

    public function CustomNewOrder(Request $request, $usid)
    {
        //
        Order::create([
            'user_id' => $usid,
            'status' => 0,
        ]);

        $orderlast = Order::get()->last();

        OrderSet::create([
            'order_id' => $orderlast->id,
            'status' => 0,
            'times' => 0,
            'user_id' => $usid,
        ]);

        $request->session()->flash('success', 'Add product success fully');
        return redirect()->action('CashierController@CustomShow', ['oid' => 0]);
        //
    }

}
