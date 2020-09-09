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
                    ['hashtagname' => 'Sweet']
                    ,
                    ['hashtagname' => 'Unsweeted']
                ];

        \App\hashtag::insert($data);

    }
}
