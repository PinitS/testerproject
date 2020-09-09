<?php

use Illuminate\Database\Seeder;

class HashtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['hashtagname' => 'หวานน้อย']
                    ,
                    ['hashtagname' => 'ไม่หวาน']
                ];

        \App\hashtag::insert($data);

    }
}
