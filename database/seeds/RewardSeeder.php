<?php

use App\Partner;
use App\Reward;
use App\Tag;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reward::truncate();
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $partner = Partner::where('id', $i)->first();
            $reward = Reward::create([
                'custom_id' => $faker->unique()->randomNumber(6), //todo
                'partner_id' => $partner->custom_id,
                'reward_name' => $faker->name,
                'details_html' => $faker->randomHtml(),
                'image' => $faker->imageUrl(),
                'category_id' => $i,
                'mp_cost' => $faker->randomNumber(2),
                'active_inactive' => $faker->boolean
            ]);
            $tags = Tag::skip(rand(0, 5))->take(rand(6, 10))->get();
            $reward->tags()->attach($tags);
        }
    }
}
