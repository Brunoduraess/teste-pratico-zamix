<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                'id' => Str::uuid(),
                'nome' => 'REFRIGERANTE LATA 350ml',
                'descricao' =>'',
                'tipo' => 'Simples',
                'categoria' => 'Bebidas',
                'unidade_medida' => 'ml',
                'custo' => 0.85,
                'preco_venda' => 1.2
            ]
        );
    }
}
