<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:22 PM
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Will Dzama',
                'email' => 'will.dzama@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_admin' => 1,
                'is_publish_allowed' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Darth Vader',
                'email' => 'vader@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_admin' => 0,
                'is_publish_allowed' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
