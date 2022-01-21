<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactPersonsTable extends Migration {

	public function up()
	{
		Schema::create('contact_persons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name');
			$table->string('last_name');
			$table->integer('company_id')->unsigned();
			$table->string('email');
			$table->string('phone', 11);
			$table->string('linkdin_profile_url')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('contact_persons');
	}
}