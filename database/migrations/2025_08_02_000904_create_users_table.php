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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 100);
            $table->string('email', 100);
            $table->string('departamento', 50);
            $table->string('perfil', 30);
            $table->char('senha', 255);
            $table->enum('status', ['Ativo', 'Inativo'])->default('Ativo');
            $table->dateTime('ultimo_acesso')->nullable();
            $table->timestamp('criado_em')
                  ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('atualizado_em')
                  ->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
