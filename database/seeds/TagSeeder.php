<?php

use App\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();
        $faker = Factory::create();
        for ($i = 0; $i <10 ; $i++) {
            Tag::create([
                    'tag_name' => $faker->word
                ]
            );
        }
    }
}
