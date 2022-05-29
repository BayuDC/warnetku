<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('rental_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('duration');
            $table->foreignId('type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('rental_prices');
    }
};
