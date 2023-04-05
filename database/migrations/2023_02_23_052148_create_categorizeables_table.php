<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
	{
        Schema::create('categorizeables', function (Blueprint $table) {
            $table->id();
			$table->foreignIdFor(\App\Models\Category::class, 'category_id');
			$table->unsignedBigInteger('categorizeable_id');
			$table->string('categorizeable_type');
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
        Schema::dropIfExists('categorizeables');
    }
};
