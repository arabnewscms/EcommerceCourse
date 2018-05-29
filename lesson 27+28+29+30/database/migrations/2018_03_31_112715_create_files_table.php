<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('files', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('size');
				$table->string('file');
				$table->string('path');
				$table->string('full_file');
				$table->string('mime_type');
				$table->string('file_type');// news / product / whatever
				$table->integer('relation_id');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('files');
	}
}
