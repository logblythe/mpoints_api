<?php

use Illuminate\Database\Seeder;
use Faker\Factory;


class UtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Utility::create([
            'website' => $faker->url,
            'email' => $faker->email,
            'phone' => $faker->randomNumber(10),
            'facebook' => $faker->url,
            'privacy_policy' => $faker->url,
            'terms_conditions' => $faker->paragraph
        ]);
    }
}
