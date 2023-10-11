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
        Schema::create('parsed_csv', function (Blueprint $table) {
            $table->integer('UNIQUE_KEY')->unique()->primary();
            $table->string('PRODUCT_TITLE');
            $table->string('PRODUCT_DESCRIPTION');
            $table->string('STYLE#');
            $table->string('SANMAR_MAINFRAME_COLOR');
            $table->string('SIZE');
            $table->string('COLOR_NAME');
            $table->float('PIECE_PRICE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parsed_csv');
    }
};
