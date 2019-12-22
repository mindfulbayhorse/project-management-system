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
            $table->bigInteger('project_id');
            $table->bigInteger('parent_id')->nullable();
            $table->string('title',200);
            $table->timestamp('start_date')->useCurrent();
            $table->date('end_date')->nullable();
            $table->float('cost',8,2)->default(0.0);
            $table->boolean('package')->default(false);            
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
        Schema::dropIfExists('deliverables');
    }
}
