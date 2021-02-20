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
        
        Schema::create('users_roles', function(Blueprint $table){
            
            $table->primary(['user_id', 'role_id']);
            
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreignId('role_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->timestamps(6);
            
        });
        
        
        Schema::create('role_permission', function(Blueprint $table){
            
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
