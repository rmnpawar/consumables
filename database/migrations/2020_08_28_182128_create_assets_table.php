<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function GuzzleHttp\default_ca_bundle;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->integer('products_id');
            $table->boolean('in_stock')->default(1);
            $table->integer('invoice_id')->default(-1);
            $table->integer('asset_number')->default(-1);
            $table->integer('section_id')->default(-1);
            $table->integer('user_id')->default(-1);
            $table->string('serial_no', 50)->default(0);
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
        Schema::dropIfExists('assets');
    }
}
