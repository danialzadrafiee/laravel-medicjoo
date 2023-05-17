<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
           'name' => 'client',
           'phone' => '1',
           'password' => Hash::make('Eloel241'),
           'remember_token' => 'abc',
           'created_at' => now(),
           'updated_at' => now()
        ],
        [
           'name' => 'admin',
           'phone' => '2',
           'password' => Hash::make('112211aa00'),
           'remember_token' => 'abc',
           'created_at' => now(),
           'updated_at' => now()
        ],
        [
            'name' => 'vendor1',
            'phone' => '3',
            'password' => Hash::make('Eloel241'),
            'remember_token' => 'abc',
            'created_at' => now(),
            'updated_at' => now()
         ],
        [
            'name' => 'vendor2',
            'phone' => '3',
            'password' => Hash::make('Eloel241'),
            'remember_token' => 'abc',
            'created_at' => now(),
            'updated_at' => now()
         ],
        ]);
    }
}
