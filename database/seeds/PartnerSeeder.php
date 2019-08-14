<?php

use App\Category;
use App\Partner;
use App\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        Partner::truncate();
        for ($i = 0; $i < 10; $i++) {
            $partner = Partner::create([
                'custom_id' => $faker->unique()->randomNumber(6), //todo
                'business_name' => $faker->name,
                'description_html' => $faker->paragraph,
                'image' => $faker->imageUrl(),
                'phone' => $faker->randomNumber(6),
                'email' => $faker->email,
                'website' => 'https://www.google.com/',
                'facebook' => 'https://www.fb.com/',
                'mp_rate' => $faker->numberBetween(5, 20),
                'sp_rate' => $faker->numberBetween(5, 20),
                'active_inactive' => $faker->boolean,
                'category_id' => $i,
            ]);
            $tags = Tag::skip(rand(0, 5))->take(rand(6, 10))->get();
            $partner->tags()->attach($tags);
        }
    }
}
