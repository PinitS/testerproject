<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\Order;
use App\OrderDetail;
use App\OrderDetailmaterial;
use App\OrderSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CashierController extends Controller
{

    public function CustomShow($oid)
    {
        $Orders = Order::get();
        $OrderDetails = OrderDetail::where('order_id', $oid)
            ->get();

        $OrderDetailmaterials = OrderDetailmaterial::where('order_id', $oid)
            ->get();

        $forchangeOrder = Order::where('id', '!=', $oid)
            ->get();

        $getOrders = Order::with('orderSet')
            ->where('id', $oid)
            ->first();

        return view('page.cashier.index', ['Orders' => $Orders, 'OrderDetails' => $OrderDetails, 'OrderDetailmaterials' => $OrderDetailmaterials, 'oid' => $oid, 'forchangeOrder' => $forchangeOrder, 'getOrders' => $getOrders]);
        //
    }
    //

    public function CustomCheckcreate(Request $request, $oid, $usid)
    {
        $osetlast = OrderSet::where('order_id', $oid)->get()->last();

        // $osetid= OrderSet::where('id', $osetlast->id)

        Cart::where('user_id', $usid)->delete();

        CartDetail::where('user_id', $usid)->delete();

        $request->session()->flash('success', 'Add more to order ');
        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetlast]);
    }

    public function CustomDelOrder(Request $request, $oid, $usid)
    {
        Order::where('id', $oid)->delete();

        OrderSet::where('order_id', $oid)->delete();

        $request->session()->flash('success', 'Add product success fully');
        return redirect()->action('CashierController@CustomShow', ['oid' => 0]);
    }

    public function changeOrder(Request $request)
    {

        $orderDetailId = explode(',', $request->product);

        $orderDetailLength = count($orderDetailId);

        $checktimes = OrderSet::where('order_id', $request->toOrderId)->get()->last();

        if ($checktimes->times == 0) {

            OrderSet::where('order_id', $request->toOrderId)
                ->update(['times' => 1]);

            $orderSetlast = OrderSet::where('order_id', $request->toOrderId)->get()->last();
        } else {
            OrderSet::create([
                'order_id' => $request->toOrderId,
                'status' => 0,
                'times' => $checktimes->times + 1,
                'user_id' => $request->user_id,
            ]);
            $orderSetlast = OrderSet::get()->last();
        }

        for ($i = 0; $i < $orderDetailLength; $i++) {

            $checkOrderSet = OrderDetail::where('order_detail_id', $orderDetailId[$i])
                ->first();

            OrderDetailmaterial::where('order_detail_id', $orderDetailId[$i])
                ->update([
                    'order_id' => $request->toOrderId,
                    'order_set_id' => $orderSetlast->id,
                ]);


            OrderDetail::where('order_detail_id', $orderDetailId[$i])
                ->update([
                    'order_id' => $request->toOrderId,
                    'order_set_id' => $orderSetlast->id,
                ]);

            $CheckEmptyOrderSet = OrderSet::where('id', $checkOrderSet->id)
                ->first();

            echo $CheckEmptyOrderSet;

            if ($CheckEmptyOrderSet->orderDetail->isEmpty()) {
                OrderSet::where('id', $checkOrderSet->id)->delete();
            }
        }





        //return Redirect::route('cashier.CustomShow', ['oid' => 0]);

    }
}
