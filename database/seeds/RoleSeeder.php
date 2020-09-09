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
                    ['keyword' => 'Cashier' , 'rolename' => 'cashier']
                    ,
                    ['keyword' => 'CEO' , 'rolename' => 'ceo']
                ];

        \App\role::insert($data);

    }
}
