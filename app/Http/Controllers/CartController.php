<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\Productinfo;
use App\Cart;
use App\hashtag;
use App\material;
use App\CartDetail;


class CartController extends Controller
{
    public function CustomShow($cat_id ,$usid)
    {
        $categories = category::all();

        $materials = material::all();

        $hashtags = hashtag::all();

        $cartDetails = CartDetail::where('user_id', $usid)->get();


        $Carts = Cart::where('user_id', $usid)->get();
                    


        
        if($cat_id == 0)
        {
            $products = Productinfo::where('active' ,1)
                                    ->get();

        }
        else
        {
            $products = Productinfo::with('cart')
                                    ->where('category_id' , $cat_id)
                                    ->where('active' ,1)
                                    ->get();
        }

        return view('page.cart.index' , [   'categories' => $categories , 
                                            'products' => $products , 
                                            'Carts' => $Carts , 
                                            'cartDetails' => $cartDetails , 
                                            'materials'=> $materials , 
                                            'hashtags' => $hashtags
                                        ]);
    }

    public function CustomStore(Request $request, $pid , $usid , $price)
    {

        Cart::create([
                        'productinfo_id' =>  $pid ,
                        'price' =>  $price ,
                        'note' =>  "" ,
                        'quatity' =>  1 ,
                        'totalprice' =>  $price ,
                        'user_id' =>  $usid
                    ]);
        $request->session()->flash('success' , 'Add Cart Success fully');
        return redirect()->action('CartController@CustomShow' , ['cat_id' => 0 , 'usid' =>$usid]); 

    }

    public function CustomClear(Request $request , $usid)
    {
                Cart::where('user_id', $usid)
                    ->delete();

                CartDetail::where('user_id', $usid)
                    ->delete();

        $request->session()->flash('success' , 'Clear Cart Success fully');
        return redirect()->action('CartController@CustomShow' , ['cat_id' => 0 , 'usid' =>$usid]); 

    }
    //

    public function CustomDelCart(Request $request , $usid , $cartid)
    {
        Cart::where('id', $cartid)
                    ->delete();

        CartDetail::where('cart_id', $cartid)
                    ->delete();

        $request->session()->flash('success' , 'Delete Cart Success fully');
        return redirect()->action('CartController@CustomShow' , ['cat_id' => 0 , 'usid' =>$usid]); 

    }



    public function Updatehashtag(Request $request , $cartid)
    {
        Cart::where('id', $cartid)
            ->update(['note' => $request->hashtagname ]);

        $request->session()->flash('success' , 'Add Cart Success fully');
        return redirect()->action('CartController@CustomShow' , ['cat_id' => 0 , 'usid' =>$request->user_id]); 

    }
    //


    

    public function UpdateQuatity(Request $request , $id)
    {

        if($request->Value == 1)
        {
            Cart::where('id' , $id)
                ->increment('quatity' , 1);
        }
        else
        {
            Cart::where('id' , $id)
            ->decrement ('quatity' , 1);
        }

        $Cart = Cart::where('id', $id)
                    ->first();

        $CartDetails = CartDetail::where('cart_id', $id)
                    ->get();



        Cart::where('id', $id)
            ->update(['totalprice' =>( $Cart->quatity * $Cart->price) ]);


            foreach($CartDetails as $CartDetail)
            {
                CartDetail::where('cart_id', $id)
                            ->where('material_id' , $CartDetail->material_id)
                            ->update(['total_price' => $CartDetail->price * $Cart->quatity ]);
            }


        return redirect()->action('CartController@CustomShow' , ['cat_id' => 0 , 'usid' =>$request->usid]); 
    }
}
