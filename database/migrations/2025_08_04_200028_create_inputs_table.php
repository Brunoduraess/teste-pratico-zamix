<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_produto');
            $table->uuid('id_funcionario');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('quantidade');
            $table->string('fornecedor', 100);

            $table->foreign('id_produto')->references('id')->on('products');
            $table->foreign('id_funcionario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
