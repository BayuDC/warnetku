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
        Schema::table('operators', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
        Schema::table('computers', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('computer_types');
        });
        Schema::table('rental_prices', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('computer_types');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('computer_id')->references('id')->on('computers');
            $table->foreign('operator_id')->references('id')->on('operators');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('operators', function (Blueprint $table) {
            $table->dropForeign('role_id');
        });
        Schema::table('computers', function (Blueprint $table) {
            $table->dropForeign('type_id');
        });
        Schema::table('rental_prices', function (Blueprint $table) {
            $table->dropForeign('type_id');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('computer_id');
            $table->dropForeign('operator_id');
        });
    }
};
