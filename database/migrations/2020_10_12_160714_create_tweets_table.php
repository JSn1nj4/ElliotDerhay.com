<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('tweets', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(\App\Models\TwitterUser::class, 'user_id');
			$table->text('body');
			$table->timestamp('date');
			$table->integer('sub_tweet_id')->nullable();
			$table->json('entities');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(): void
	{
		Schema::dropIfExists('tweets');
	}
}
