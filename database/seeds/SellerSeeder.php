<?php

use App\Partner;
use App\Seller;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Seller::truncate();
        for ($i = 1; $i <= 10; $i++) {
            $partner = Partner::where('id',$i)->first();
            Seller::create([
                    'custom_id' => $faker->randomNumber(6),
                    'partner_id'=>$partner->custom_id,
                    'brn' => $faker->word,
                    'main_store' => $faker->word,
                    'seller_name' => $faker->name,
                    'phone' => $faker->randomDigitNotNull,
                    'email' => $faker->email,
                    'active_inactive' => $faker->boolean
                ]
            );
        }
    }
}
