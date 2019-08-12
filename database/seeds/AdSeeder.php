<?php

use App\Ad;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;

class AdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        Ad::truncate();

        for ($i = 0; $i < 25; $i++) {
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addDays(7);
            $ad = Ad::create([
                'uid' => strval($faker->randomNumber(6)),
                'campaign_name' => $faker->name,
                'image' => $faker->imageUrl(),
                'url' => $faker->url,
                'active_inactive' => $faker->boolean
            ]);
            if ($i > 20) {
                $ad->start_date = $startDate->addDays(4);
                $ad->end_date = $endDate->addDays(5);
                $ad->save();
            } else if ($i > 15) {
                $ad->start_date = $startDate->addDays(3);
                $ad->end_date = $endDate->addDays(4);
                $ad->save();
            } else if ($i > 10) {
                $ad->start_date = $startDate->addDays(2);
                $ad->end_date = $endDate->addDays(3);
                $ad->save();
            } else if ($i > 5) {
                $ad->start_date = $startDate->addDays(1);
                $ad->end_date = $endDate->addDays(2);
                $ad->save();
            } else {
                $ad->start_date = $startDate;
                $ad->end_date = $endDate->addDays(1);
                $ad->save();
            }
        }
    }
}
