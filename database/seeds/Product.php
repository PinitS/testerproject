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
                'product_type'=> 2,
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
                'product_type'=> 3,
            ],

            [ 
                'category_id'=> 2,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 0,
                'name'=> "BlackTea",
                'cost'=> 25,
                'price'=> 35,
                'product_type'=> 1,
            ],

            [ 
                'category_id'=> 2,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "GreenTea",
                'cost'=> 25,
                'price'=> 45,
                'product_type'=> 1,
            ],

            [ 
                'category_id'=> 2,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "JasmineTea",
                'cost'=> 45,
                'price'=> 55,
                'product_type'=> 1,
            ],

            [ 
                'category_id'=> 2,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "RoesTea",
                'cost'=> 15,
                'price'=> 30,
                'product_type'=> 3,
            ],

            [ 
                'category_id'=> 2,
                'active_count'=> 0,
                'count_quatity'=> 0,
                'active'=> 1,
                'name'=> "LemonTea",
                'cost'=> 15,
                'price'=> 25,
                'product_type'=> 2,
            ],

        ];

        \App\Productinfo::insert($data);
        //
    }
}
