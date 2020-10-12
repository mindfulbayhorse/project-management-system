<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {

			$table->unsignedSmallInteger('type_id');
			$table->unsignedBigInteger('valuable_id');
			$table->string('valuable_type');
			
			$table->foreign('type_id')->references('id')->on('resource_types')->onDelete('cascade');
			$table->primary(['type_id','valuable_id','valuable_type']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
