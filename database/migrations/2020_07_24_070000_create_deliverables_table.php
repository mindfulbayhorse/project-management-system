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
            $table->foreignId('wbs_id')->constrained()->onDelete('cascade');
            $table->unsignedbigInteger('parent_id')->nullable();
            $table->string('title', 200);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->float('cost',8,2)->default(0.0);
            $table->boolean('package')->default(false); 
            $table->boolean('milestone')->default(false); 
            $table->unsignedSmallInteger('work_amount')->nullable();
            $table->unsignedSmallInteger('work_amount_id')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps(6);
            
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
