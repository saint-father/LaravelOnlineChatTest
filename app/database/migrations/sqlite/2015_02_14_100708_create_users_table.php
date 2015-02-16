<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *  Schema::create('users', function ($table) {
                $table->increments('id');
                $table->string('email')->unique();
                $table->string('name');
                $table->timestamps();
              });
	 * @return void
	 */
        public function up()
        {
        Schema::create('users', function($table) {
            // ID
            $table->increments('id');
 
            // E-Mail (unic)
            $table->string('email')->unique();
 
            // Password (60 simbols min - for Laraver interna hash function)
            $table->string('password', 60);
 
            $table->string('username')->unique();
 
            $table->boolean('isAdmin');
 
            $table->boolean('isActive')->index();
 
            $table->string('activationCode');
 
//            $table->rememberToken(); // remember_token
            $table->string('remember_token', 100)->nullable()->index(); 
            // created_at, updated_at
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
            Schema::drop('users');
	}

}