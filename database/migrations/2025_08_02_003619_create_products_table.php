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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('nome', 100);
            $table->text('descricao')->nullable();
            $table->enum('tipo', ['Simples', 'Composto']);
            $table->string('categoria', 30);
            $table->string('unidade_medida', 10);
            $table->double('custo');
            $table->double('preco_venda');
            $table->text('imagem')->nullable();
            $table->timestamp('criado_em')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('atualizado_em')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
