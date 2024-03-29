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
        Schema::create('imageables', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(\App\Models\Image::class, 'image_id');
			$table->unsignedBigInteger('imageable_id');
			$table->string('imageable_type');
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
        Schema::dropIfExists('imageables');
    }
};
