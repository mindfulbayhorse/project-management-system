<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table){
            
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->timestamps(6);
            
            /** @todo ['active' => true] */
                        
        });
        
        Schema::create('permissions', function(Blueprint $table){
            
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->timestamps(6);
            
        });
        
        Schema::create('role_user', function(Blueprint $table){
            
            $table->primary(['role_id', 'user_id']);
            
            $table->foreignId('role_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->timestamps(6);
            
        });
        
        
        Schema::create('permission_role', function(Blueprint $table){
            
            $table->primary(['permission_id', 'role_id']);
            
            $table->foreignId('permission_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('role_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
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
        //
    }
}
