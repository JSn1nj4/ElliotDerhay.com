<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGithubEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up(): void
	{
		Schema::create('github_events', function (Blueprint $table) {
			$table->id();
			$table->text('type');
			$table->text('action')->nullable();
			$table->timestamp('date');
			$table->foreignIdFor(\App\Models\GithubUser::class, 'user_id');
			$table->text('source')->nullable();
			$table->text('repo');
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
		Schema::dropIfExists('github_events');
	}
}
