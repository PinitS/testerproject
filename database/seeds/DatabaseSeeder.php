<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HashtagSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(MaterialSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(Product::class);
        $this->call(PromotionSeeder::class);
    }
}
