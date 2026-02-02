<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::whenTableDoesntHaveColumn('posts', 'status', function (Blueprint $table) {
			$table->string('status')->default('draft');
		});

		DB::transaction(function () {
			DB::table('posts')
				->select('*')
				->where('published', true)
				->update(['status' => 'published']);
		});

		Schema::whenTableDoesntHaveColumn('posts', 'scheduled_for', function (Blueprint $table) {
			$table->timestamp('scheduled_for')->nullable();
		});

		Schema::whenTableHasColumn('posts', 'published', function (Blueprint $table) {
			$table->dropColumn('published');
		});
	}

	public function down(): void
	{
		Schema::whenTableDoesntHaveColumn('posts', 'published', function (Blueprint $table) {
			$table->boolean('published')->default(false);
		});

		DB::transaction(function () {
			DB::table('posts')
				->select('*')
				->where('status', \App\Enums\PostStatus::Published->value)
				->update(['published' => true]);
		});

		Schema::whenTableHasColumn('posts', 'scheduled_for', function (Blueprint $table) {
			$table->dropColumn('scheduled_for');
		});

		Schema::whenTableHasColumn('posts', 'status', function (Blueprint $table) {
			$table->dropColumn('status');
		});
	}
};
