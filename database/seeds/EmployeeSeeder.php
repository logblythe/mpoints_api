<?php

use App\Employee;
use App\Partner;
use App\PartnerSeller;
use App\Seller;
use Faker\Factory;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    var $j = 1;

    public function run()
    {
        $faker = Factory::create();
        Employee::truncate();
        for ($i = 1; $i < 199; $i++) {
            if ($i <= 99) {
                $partnerSeller = PartnerSeller::where('id', $i)->first();
                Employee::create([
                        'custom_id' => $faker->randomNumber(6, true),
                        'seller_id' => $partnerSeller->custom_id,
                        'first_name' => $faker->name,
                        'last_name' => $faker->lastName,
                        'active_inactive' => $faker->boolean
                    ]
                );
            } else {
                $seller = Seller::where('id', $this->j)->first();
                Employee::create([
                        'custom_id' => $faker->randomNumber(6, true),
                        'seller_id' => $seller->custom_id,
                        'first_name' => $faker->name,
                        'last_name' => $faker->lastName,
                        'active_inactive' => $faker->boolean
                    ]
                );
                $this->j++;
            }
        }
    }
}
