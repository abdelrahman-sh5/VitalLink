<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('notification_text');
			$table->text('intro_text_1');
			$table->text('intro_text_2');
			$table->longText('about_text');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_link');
			$table->string('wa_link');
			$table->string('tw_link');
			$table->string('insta_link');
			$table->string('yt_link');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
