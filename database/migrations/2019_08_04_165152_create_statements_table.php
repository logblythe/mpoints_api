<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('partner_id');
            $table->string('seller_id')->nullable();
            $table->string('employee_id')->nullable();
            $table->integer('transaction_type');
            $table->integer('purchase_amount')->nullable();
            $table->integer('count_of_items')->nullable();
            $table->integer('mp_amount')->nullable();
            $table->integer('sp_amount')->nullable();
            $table->string('reward_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statements');
    }
}
