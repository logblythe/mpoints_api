<?php

use App\Utility;
use Illuminate\Database\Seeder;
use Faker\Factory;


class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.p
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Utility::truncate();
        Utility::create([
            'website' => $faker->url,
            'email' => $faker->email,
            'phone' => $faker->randomDigitNotNull,
            'facebook' => $faker->url,
            'privacy_policy' => $faker->randomHtml(),
            'terms_conditions' => $faker->randomHtml(),
        ]);
    }
}
