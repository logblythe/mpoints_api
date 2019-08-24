<?php

use App\Partner;
use App\PartnerSeller;
use App\Seller;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PartnerSellerSeeder extends Seeder
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
        for ($i = 1; $i < 100; $i++) {
            $partner = Partner::where('id', substr($i, 0, 1))->first();
            Seller::create([
                    'custom_id' => $faker->randomNumber(6, true),
                    'partner_id' => $partner->custom_id,
                    'brn' => $faker->word,
                    'main_store' => $faker->word,
                    'seller_name' => $faker->name,
                    'phone' => $faker->randomDigitNotNull,
                    'email' => $faker->email,
                    'active_inactive' => $partner->active_inactive ? $faker->boolean : false
                ]
            );
        }
    }
}
