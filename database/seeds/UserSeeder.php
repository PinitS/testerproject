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

                    ['username' => 'admin',
                    'password' => bcrypt('123456'),
                    'name' => 'Super Admin',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 1,],

                    ['username' => 'member1',
                    'password' => bcrypt('123456'),
                    'name' => 'Seeder 1',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 1,],
                    
                    ['username' => 'member2',
                    'password' => bcrypt('123456'),
                    'name' => 'Seeder 2',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 0,],

                    ['username' => 'member3',
                    'password' => bcrypt('123456'),
                    'name' => 'Seeder 3',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 0,],

                    ['username' => 'member4',
                    'password' => bcrypt('123456'),
                    'name' => 'Seeder 4',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 0,],

                    ['username' => 'member5',
                    'password' => bcrypt('123456'),
                    'name' => 'Seeder 5',
                    'contact' => 'insert form seeder',
                    'active' => 1,
                    'job_id' => 0,
                    'status' => 0,],

                ];

        \App\User::insert($data);

    }
}
