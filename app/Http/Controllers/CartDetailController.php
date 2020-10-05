<?php

namespace App\Http\Controllers;

use App\Cart;
use App\CartDetail;
use App\material;
use Illuminate\Http\Request;

class CartDetailController extends Controller
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

        foreach ($request->material_id_value as $material_key => $material_value) {
            if ($material_value == "true") {

                $checkQuatity = Cart::where('id', $request->cart_id)
                    ->first();

                $getmaterial = material::where('id', $material_key)
                    ->first();

                $checkdupicate = CartDetail::where('cart_id', $request->cart_id)
                    ->where('material_id', $material_key)
                    ->get();

                if ($checkdupicate->isEmpty()) {
                    CartDetail::create([
                        'cart_id' => $request->cart_id,
                        'productinfo_id' => $request->Cart_product,
                        'material_id' => $material_key,
                        'materialName' => $getmaterial->materialname,
                        'price' => $getmaterial->materialprice,
                        'quatity' => $checkQuatity->quatity,
                        'total_price' => ($checkQuatity->quatity * $getmaterial->materialprice),
                        'user_id' => $request->user_id,
                    ]);
                }
            } else if ($material_value == "false") {
                $materialCheckdel = CartDetail::where('cart_id', $request->cart_id)
                    ->where('material_id', $material_key)
                    ->first();

                //return $userRolesCheckdel;

                if ($materialCheckdel != null) {
                    $materialCheckdel->delete();
                }
            }
        }

        return redirect()->action('CartController@CustomShow', ['cat_id' => 0, 'usid' => $request->user_id, 'oid' => $request->oid, 'osetid' => $request->osetid]);
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
