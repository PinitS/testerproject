<?php

use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
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
                'materialname' => 'ร้อน',
                'materialprice' => 0,
            ],

            [ 
                'materialname' => 'เย็น',
                'materialprice' => 5,
            ],
            
            [ 
                'materialname' => 'ปั่น',
                'materialprice' => 10,
            ],

            [ 
                'materialname' => 'วิปครีม',
                'materialprice' => 15,
            ],
        ];

        \App\material::insert($data);

    }
}
