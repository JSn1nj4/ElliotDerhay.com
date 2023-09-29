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
		Schema::whenTableDoesntHaveColumn('images', 'caption', static function (Blueprint $table) {
			$table->string('caption')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::whenTableHasColumn('images', 'caption', static function (Blueprint $table) {
			$table->removeColumn('caption');
		});
	}
};
