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
                'materialname' => 'hot',
                'materialprice' => 0,
            ],

            [ 
                'materialname' => 'cold',
                'materialprice' => 5,
            ],
            
            [ 
                'materialname' => 'spin',
                'materialprice' => 10,
            ],

            [ 
                'materialname' => 'Whipped cream',
                'materialprice' => 15,
            ],
        ];

        \App\material::insert($data);

    }
}
