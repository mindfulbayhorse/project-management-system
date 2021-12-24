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
            $table->string('title')->unique();
            $table->string('slug');
            
            $table->string('url')->nullable();
            
            $table->unsignedBigInteger('manager_id')->nullable();
            
            $table->date('start_date',6)->nullable();
            $table->date('end_date',6)->nullable();
            $table->timestamps(6);
            
            $table->unsignedSmallInteger('status_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('set null');
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
