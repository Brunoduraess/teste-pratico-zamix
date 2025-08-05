<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu()
    {
        $totalUsuarios = User::count();
        $totalProdutos = Product::count();
        $totalEstoque = Stock::count();

        $de = Carbon::today()->startOfDay();
        $ate = Carbon::today()->endOfDay();

        $totalRequisicoes = ModelsRequest::whereBetween('data', [$de, $ate])->count();

        return view('admin.menu', [
            'totalUsuarios' => $totalUsuarios,
            'totalProdutos' => $totalProdutos,
            'totalEstoque' => $totalEstoque,
            'totalRequisicoes' => $totalRequisicoes
        ]);
    }
}
