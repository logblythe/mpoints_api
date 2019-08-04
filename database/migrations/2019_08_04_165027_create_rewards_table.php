<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('partner_id');
            $table->string('reward_name');
            $table->text('details_html');
            $table->string('image');
            $table->integer('category_id');
            $table->integer('mp_cost');
            $table->boolean('active_inactive');
            $table->timestamps();
        });

//        Schema::table('rewards', function (Blueprint $table) {
//            $table->foreign('partner_id')->references('custom_id')->on('partners')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rewards');
    }
}
