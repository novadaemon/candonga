<?php 

namespace Candonga\database\seeds;

use Illuminate\Database\Seeder;
use Candonga\Entities\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('customers')->delete();

        factory(Customer::class,10)->create();
    }
}
