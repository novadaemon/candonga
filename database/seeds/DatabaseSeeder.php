<?php

use Illuminate\Database\Seeder;
use Candonga\Database\Seeds\CustomersTableSeeder;
use Candonga\Database\Seeds\ProductsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(CustomersTableSeeder::class);
         $this->call(ProductsTableSeeder::class);
    }
}
