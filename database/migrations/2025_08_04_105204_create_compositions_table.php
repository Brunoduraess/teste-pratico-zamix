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
        Schema::create('compositions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_produto_composto');
            $table->uuid('id_produto_simples');
            $table->integer('quantidade');

            $table->foreign('id_produto_composto')->references('id')->on('products');
            $table->foreign('id_produto_simples')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
