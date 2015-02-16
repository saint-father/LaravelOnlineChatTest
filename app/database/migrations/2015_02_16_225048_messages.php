<?php

use Illuminate\Database\Migrations\Migration;

class Messages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('messages', function($table) {
            // ID
            $table->increments('id');
 
            $table->integer('userId')->index();
            $table->integer('receiverId')->index();
 
            $table->string('userName');
            $table->string('message');
 
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
            Schema::drop('messages');
	}

}