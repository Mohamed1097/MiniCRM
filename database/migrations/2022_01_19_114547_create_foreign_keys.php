<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('contact_persons', function(Blueprint $table) {
			$table->foreign('company_id')->references('id')->on('companies')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('contact_persons', function(Blueprint $table) {
			$table->dropForeign('contact_persons_company_id_foreign');
		});
	}
}