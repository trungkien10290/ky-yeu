<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title_vi')->nullable();
            $table->text('desc_vi')->nullable();
            $table->text('thumbnail')->nullable();
            $table->text('video')->nullable();
            $table->integer('position')->nullable()->default(0);
            $table->string('title_en')->nullable();
            $table->text('desc_en')->nullable();
            $table->integer('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('banners');
    }
}
