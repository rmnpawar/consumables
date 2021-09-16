<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumableIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumable_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consumable_id');
            $table->bigInteger('asset_id');
            $table->date('issue_date');
            $table->bigInteger('user_id');
            $table->bigInteger('section_id'); 
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
        Schema::dropIfExists('consumable_issues');
    }
}
