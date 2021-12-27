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
            $table->integer('project_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('code')->nullable();
            $table->date('date');
            $table->text('desc_vi')->nullable();
            $table->json('bug_images')->nullable();
            $table->json('bug_files')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('reason_vi')->nullable();
            $table->text('reason_en')->nullable();
            $table->text('consequence_vi')->nullable();
            $table->text('consequence_en')->nullable();
            $table->text('solution_vi')->nullable();
            $table->text('solution_en')->nullable();
            $table->text('solution_images')->nullable();
            $table->text('solution_files')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->integer('comments_count')->nullable()->default(0);
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
