<?php

use App\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Category::truncate();
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'category_name' => $faker->word
            ]);
        }
    }
}
