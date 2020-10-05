<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\category;
use App\hashtag;
use App\material;
use App\Productinfo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function CustomShow(Request $request, $cat_id, $usid, $oid, $osetid)
    {
        $categories = category::all();

        $materials = material::all();

        $hashtags = hashtag::all();

        $cartDetails = CartDetail::where('user_id', $usid)->get();

        $Carts = Cart::where('user_id', $usid)->get();

        if ($cat_id == 0) {
            $products = Productinfo::where('active', 1)
                ->get();
        } else {
            $products = Productinfo::with('cart')
                ->where('category_id', $cat_id)
                ->where('active', 1)
                ->get();
        }

        return view('page.cart.index', [
            'categories' => $categories,
            'products' => $products,
            'Carts' => $Carts,
            'cartDetails' => $cartDetails,
            'materials' => $materials,
            'hashtags' => $hashtags,
            'oid' => $oid,
            'osetid' => $osetid,
        ]);
    }

    public function CustomStore(Request $request, $pid, $pname, $usid, $price, $promotion, $oid, $osetid)
    {

        Cart::create([
            'productinfo_id' => $pid,
            'productname' => $pname,
            'price' => $price,
            'note' => "",
            'quatity' => 1,
            'textpromotion' => $promotion,
            'totalprice' => $price,
            'user_id' => $usid,
            'oid' => $oid,
            'osetid' => $osetid,
        ]);
        $request->session()->flash('success', 'Add Cart Success fully');
        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetid]);
    }

    public function CustomClear(Request $request, $usid, $oid, $osetid)
    {
        Cart::where('user_id', $usid)
            ->delete();

        CartDetail::where('user_id', $usid)
            ->delete();

        $request->session()->flash('success', 'Clear Cart Success fully');
        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetid]);
    }
    //

    public function CustomDelCart(Request $request, $cat_id, $usid, $oid, $osetid)
    {
        Cart::where('id', $cat_id)
            ->delete();

        CartDetail::where('cart_id', $cat_id)
            ->delete();

        $request->session()->flash('success', 'Delete Cart Success fully');
        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetid]);
    }

    public function Updatehashtag(Request $request, $cartid, $oid, $osetid)
    {

        $usid = $request->user_id;

        Cart::where('id', $cartid)
            ->update(['note' => $request->hashtagname]);

        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetid]);
    }
    //

    public function UpdateQuatity(Request $request, $id, $usid, $oid, $osetid)
    {

        if ($request->Value == 1) {
            Cart::where('id', $id)
                ->increment('quatity', 1);
        } else {
            Cart::where('id', $id)
                ->decrement('quatity', 1);
        }

        $Cart = Cart::where('id', $id)
            ->first();

        $CartDetails = CartDetail::where('cart_id', $id)
            ->get();

        Cart::where('id', $id)
            ->update(['totalprice' => ($Cart->quatity * $Cart->price)]);

        foreach ($CartDetails as $CartDetail) {
            CartDetail::where('cart_id', $id)
                ->where('material_id', $CartDetail->material_id)
                ->update(['total_price' => $CartDetail->price * $Cart->quatity]);
        }

        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $usid, 'oid' => $oid, 'osetid' => $osetid]);
    }
}
