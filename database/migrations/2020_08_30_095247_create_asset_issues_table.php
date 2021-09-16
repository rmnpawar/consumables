<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_issues', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('asset_id');
            $table->date('issue_date');
            $table->boolean('issue')->default(0);   // 0 for issue and 1 for receiving. must set through a setter after checking in_stock column in assets.
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
        Schema::dropIfExists('asset_issues');
    }
}
