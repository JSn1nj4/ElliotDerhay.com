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
		Schema::table('posts', function (Blueprint $table) {
			if (!Schema::hasColumns($table->getTable(), ['title', 'body'])) return;

			/** @todo revisit if it turns out full-text-specific stuff needs testing */
			if (DB::getDriverName() === 'sqlite') return;

			$table->fullText(['title', 'body']);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('posts', function (Blueprint $table) {
			if (!Schema::hasColumns($table->getTable(), ['title', 'body'])) return;
			
			/** @todo revisit if it turns out full-text-specific stuff needs testing */
			if (DB::getDriverName() === 'sqlite') return;

			$table->dropFullText(['title', 'body']);
		});
	}
};
