<?php 

namespace Candonga\database\seeds;

use Faker\Factory;

use Illuminate\Database\Seeder;
use Candonga\Entities\Customer;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->delete();

        $faker = Factory::create();

        $status = [
            'new',
            'pending',
            'in review',
            'approved',
            'inactive',
            'deleted'
        ];

        /**
         * Assign random products to all customer
         */

        foreach (Customer::all() as $customer){
            for ($t = 0; $t < rand(0,10); $t++) {
                $customer->products()
                    ->create([
                        'issn' => $faker->isbn10,
                        'name' => $faker->word(),
                        'status' => $status[rand(0, 5)]
                    ]);
            }
        }

    }
}
