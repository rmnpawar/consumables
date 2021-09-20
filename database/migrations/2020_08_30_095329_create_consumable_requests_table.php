<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('asset_id');
            $table->integer('sub_category_id');
            $table->integer('user_id');
            $table->integer('section_id');
            $table->integer('requesting_user_id');
            $table->integer('status');
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
        Schema::dropIfExists('consumable_requests');
    }
}
