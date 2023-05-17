<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('credits')->insert([

            [
             'user_id'=>1,
             'change'=>1000,
             'describe'=>'start',
             'created_at'=>now(),
             'updated_at'=>now()
            ],
            [
                'user_id'=>1,
                'change'=>-500,
                'describe'=>'خرج',
                'created_at'=>now(),
                'updated_at'=>now()
            ],

        ]);
    }


    // $table->bigIncrements('id');
    // $table->bigInteger('user_id');
    // $table->bigInteger('change')->default(0);
    // $table->text('describe')->nullable();
    // $table->timestamps();

}
