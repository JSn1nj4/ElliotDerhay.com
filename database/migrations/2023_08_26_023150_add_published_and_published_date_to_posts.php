<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::whenTableDoesntHaveColumn('posts', 'published', static function (Blueprint $table) {
            $table->boolean('published')->default(false);
        });

        Schema::whenTableDoesntHaveColumn('posts', 'published_at', static function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::whenTableHasColumn('posts', 'published', static function (Blueprint $table) {
            $table->removeColumn('published');
        });

        Schema::whenTableHasColumn('posts', 'published_at', static function (Blueprint $table) {
			$table->removeColumn('published_at');
        });
    }
};
