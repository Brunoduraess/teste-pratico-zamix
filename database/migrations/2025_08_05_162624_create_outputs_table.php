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
        Schema::create('outputs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_requisicao');
            $table->uuid('id_produto');
            $table->uuid('autorizado_por');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('quantidade');

            $table->foreign('id_requisicao')->references('id')->on('requests');
            $table->foreign('id_produto')->references('id')->on('products');
            $table->foreign('autorizado_por')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outputs');
    }
};
