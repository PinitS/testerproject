<?php

use Illuminate\Database\Seeder;

class Product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        [
            [ 
                'category_id'=> 1,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "Cappuccino",
                'cost'=> 25,
                'price'=> 40,
                'product_type'=> 1,
            ],

            [ 
                'category_id'=> 1,
                'active_count'=> 1,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "Americano",
                'cost'=> 30,
                'price'=> 45,
                'product_type'=> 1,
            ],

            [ 
                'category_id'=> 1,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 0,
                'name'=> "Latte",
                'cost'=> 40,
                'price'=> 50,
                'product_type'=> 1,
            ],

        ];

        \App\Productinfo::insert($data);
        //
    }
}
