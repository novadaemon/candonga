<?php

use Faker\Factory;

use Illuminate\Database\Seeder;
use Core\Api\App\Data\Entities\Customer;
use Carbon\Carbon;

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
         * Create 10 faked customers
         */
        for ($t = 0; $t < 10; $t++) {
            Customer::create([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName,
                'date_of_birth' => new Carbon($faker->date()),
                'status' => $status[rand(0, 5)]
            ]);
        }
    }
}
