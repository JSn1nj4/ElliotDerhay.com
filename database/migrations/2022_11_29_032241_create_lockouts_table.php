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
    public function up()
    {
        Schema::create('lockouts', function (Blueprint $table) {
            $table->id();
			$table->ipAddress();
			$table->string('url');
			$table->string('user_agent')->nullable();
			$table->string('content_type')->nullable();
			$table->string('credential')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lockouts');
    }
};
