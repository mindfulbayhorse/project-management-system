<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliverables', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedbigInteger('project_id');
            $table->unsignedbigInteger('parent_id')->nullable();
            $table->string('title', 200);
            $table->timestamp('start_date')->useCurrent();
            $table->date('end_date')->nullable();
            $table->float('cost',8,2)->default(0.0);
            $table->boolean('package')->default(false); 
            $table->unsignedSmallInteger('work_amount')->nullable();
            $table->unsignedSmallInteger('work_amount_id')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
            
            //deleting a project will delete all data about its WBS
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliverables');
    }
}
