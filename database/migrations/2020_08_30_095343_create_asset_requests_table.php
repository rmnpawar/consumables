<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);  // increase binary steps 1,2,4, 8 ....
            $table->bigInteger('section_id');
            $table->bigInteger('for_user_id')->default(-1);
            $table->bigInteger('requesting_user_id')->default(-1);
            $table->bigInteger('sub_category_id');
            $table->string('remarks')->nullable()->default("No specific remarks");
            $table->bigInteger('issue_id')->nullable();
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
        Schema::dropIfExists('asset_requests');
    }
}
