<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedSmallInteger('status_id')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('started')->nullable();
            $table->timestamp('finished')->nullable();
            $table->timestamps();
            
            $table->foreign('status_id')->references('id')->on('statuses');
         
        });
              
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
