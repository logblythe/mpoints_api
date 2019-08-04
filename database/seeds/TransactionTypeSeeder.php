<?php

use App\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionType::create([
            'transaction_name' => "Get Points +"
        ]);
        TransactionType::create([
            'transaction_name' => "Use Points -"
        ]);
        TransactionType::create([
            'transaction_name' => "Reverse Get -"
        ]);
        TransactionType::create([
            'transaction_name' => "Reverse Use +"
        ]);
        TransactionType::create([
            'transaction_name' => "Contra Get +"
        ]);
        TransactionType::create([
            'transaction_name' => "Contra Use -"
        ]);

    }
}
