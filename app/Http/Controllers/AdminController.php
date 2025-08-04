<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu()
    {
        $totalUsuarios = User::count();
        $totalProdutos = Product::count();

        return view('admin.menu', [
            'totalUsuarios' => $totalUsuarios,
            'totalProdutos' => $totalProdutos
        ]);
    }
}
