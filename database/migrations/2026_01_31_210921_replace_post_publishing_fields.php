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

		Schema::whenTableDoesntHaveColumn('posts', 'scheduled_for', function (Blueprint $table) {
			$table->timestamp('scheduled_for')->nullable();
		});

		DB::transaction(function () {
			DB::table('posts')
				->select('*')
				->where('published', true)
				->update(['status' => 'published']);
		});

		Schema::whenTableHasColumn('posts', 'published', function (Blueprint $table) {
			$table->removeColumn('published');
		});
	}
};
