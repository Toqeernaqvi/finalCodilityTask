<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Factory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
 
       $category = new Category();
       $category->name =  $faker->name;
       $category->save();
    }
}
