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
        Schema::create('requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_funcionario');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->text('finalidade');
            $table->enum('status', ['Pendente', 'Rejeitada', 'Concluida'])->default('Pendente');
            $table->datetime('data_avaliacao')->nullable();
            $table->uuid('avaliado_por')->nullable();
            $table->text('observacao')->nullable();

            $table->foreign('id_funcionario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
