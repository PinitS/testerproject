<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
                    ['keyword' => 'satawat',
                    'rolename' => 'stworchwk',
                    ],
                    ['keyword' => 'satawat1',
                    'rolename' => 'stworchwk2',
                    ]
                ];

        \App\role::insert($data);

    }
}
