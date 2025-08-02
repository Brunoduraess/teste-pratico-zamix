<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'id' => Str::uuid(),
                'nome' => 'José da Silva',
                'email' => 'jose@zamix.com.br',
                'departamento' => 'Almoxarifado',
                'perfil' => 'Administrador',
                'status' => 'Ativo',
                'senha' => bcrypt('teste')
            ]
            );
    }
}
