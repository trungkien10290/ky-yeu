<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectCategoryStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_category_statistics', function (Blueprint $table) {
            $table->integer('project_id')->nullable()->default(0);
            $table->integer('category_id')->nullable()->default(0);
            $table->integer('bugs_count');
            $table->unique(['project_id', 'category_id']);
        });
        \App\Services\ProjectCategoryStatisticService::makeData();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_category_statistics');
    }
}
