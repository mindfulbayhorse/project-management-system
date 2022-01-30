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

            $table->id();
			$table->unsignedBigInteger('valuable_id');
			$table->string('valuable_type');
			
			$table->foreignId('type_id')
			    ->references('id')->on('resource_types')
			    ->onUpdate('cascade')
			    ->onDelete('cascade');
			
			$table->foreignId('project_id')
			    ->constrained()
			    ->onUpdate('cascade')
			    ->onDelete('cascade');
			
			$table->unique(['valuable_id', 'valuable_type', 'project_id'], 'resource_unique');

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
