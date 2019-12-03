<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        User::forceCreate([
            'name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('YourP@ssword'),
            'api_token' => Str::random(80),
        ]);
    }
}
