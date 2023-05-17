<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAttrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_attrs')->insert([
            [
                'user_id' => 1,
                'job' => 'client',
                'active' => 1,
                'approved' => 1,

            ],
            [
                'user_id' => 2,
                'job' => 'admin',
                'active' => 1,
                'approved' => 1,
            ],
            [
                'user_id' => 3,
                'job' => 'vendor',
                'active' => 1,
                'approved' => 1,
            ],
            [
                'user_id' => 4,
                'job' => 'vendor',
                'active' => 1,
                'approved' => 1,
            ],
        ]);
    }
}
