<?php

use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            [
                'productinfo_id' => '1',
                'start' => '2020-09-23 00:00:00',
                'end' => '2020-09-23 00:00:00',
                'discount' => '3',
                'active' => '1',
            ]

            
        ];

        \App\Promotion::insert($data);
    }
}
