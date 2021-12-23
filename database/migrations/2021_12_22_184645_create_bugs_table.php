<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bugs', function (Blueprint $table) {
            $table->id();
            $table->integer('project_category_id')->nullable();
            $table->integer('other_category_id')->nullable();
            $table->integer('bug_category_id')->nullable();
            $table->string('code')->nullable();
            $table->date('date');
            $table->text('desc_vi')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('reason_vi')->nullable();
            $table->text('reason_en')->nullable();
            $table->text('consequence_vi')->nullable();
            $table->text('consequence_en')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('bugs');
    }
}
