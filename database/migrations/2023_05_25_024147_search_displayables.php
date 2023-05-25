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
        Schema::create('search_displayables', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('search_displayable_id');
			$table->string('search_displayable_type');
			$table->string('page_title')->nullable();
			$table->string('meta_description')->nullable();
			$table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
