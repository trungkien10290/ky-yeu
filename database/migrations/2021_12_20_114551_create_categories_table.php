<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_vi')->nullable();
            $table->string('title_en')->nullable();
            $table->string('type')->nullable()->default('other');
            $table->text('desc_vi')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('content_vi')->nullable();
            $table->text('content_en')->nullable();
            $table->text('thumbnail')->nullable();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('categories');
    }
}
