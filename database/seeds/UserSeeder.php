<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

                    'username' => 'admin',
                    'password' => bcrypt('123456'),
                    'name' => 'พินิต สุประยูร',
                    'contact' => 'Seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 1,
                ];

        \App\User::insert($data);

    }
}
