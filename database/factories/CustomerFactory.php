<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Candonga\Data\Entities\Customer;
use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Customer::class, function (Faker $faker) {
    $status = [
        'new',
        'pending',
        'in review',
        'approved',
        'inactive',
        'deleted'
    ];

    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'date_of_birth' => new Carbon($faker->date()),
        'status' => $status[rand(0, 5)]
    ];
});
