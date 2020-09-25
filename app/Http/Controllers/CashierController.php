<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\OrderDetail;
use App\OrderDetailmaterial;

class CashierController extends Controller
{

    public function CustomShow($oid)
    {
        $Orders = Order::get();
        $OrderDetails = OrderDetail::where('order_id' , $oid)
                            ->get();

        $OrderDetailmaterials = OrderDetailmaterial::where('order_id' , $oid)
                            ->get();

        return view('page.cashier.index' , ['Orders' => $Orders , 'OrderDetails' => $OrderDetails , 'OrderDetailmaterials' =>$OrderDetailmaterials]);
        //
    }
    //

    public function CustomCheckcreate($oid , $osetid)
    {
        $Orders = Order::get();
        $OrderDetails = OrderDetail::where('order_id' , $oid)
                            ->get();

        $OrderDetailmaterials = OrderDetailmaterial::where('order_id' , $oid)
                            ->get();

        return view('page.cashier.index' , ['Orders' => $Orders , 'OrderDetails' => $OrderDetails , 'OrderDetailmaterials' =>$OrderDetailmaterials]);
        //
    }












}


