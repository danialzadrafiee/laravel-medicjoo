<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Category::class,3)->create();

        DB::table('categories')->insert([
            [
             'name'=>'بدون دسته',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/1/200/200'
            ],
            [
             'name'=>'جراحی',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/2/200/200'
            ],
            [
             'name'=>'زیبایی',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/3/200/200'
            ],
            [
             'name'=>'قیچی',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/4/200/200'
            ],
            [
             'name'=>'قیچی',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/5/200/200'
            ],
            [
             'name'=>'قیچی',
             'parent_id'=>'1',
             'image'=>'https://picsum.photos/seed/6/200/200'
            ],
        ]);
    }
}
