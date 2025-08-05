<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkLogin;
use Illuminate\Support\Facades\Route;

//Rotas de autenticação
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/esqueci', [AuthController::class, 'esqueci'])->name('esqueci');
Route::post('/esqueciSubmit', [AuthController::class, 'esqueciSubmit'])->name('esqueciSubmit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Middleware para verfificar se o usuário está logado
Route::middleware(checkLogin::class)->group(function () {
    //Rotas do menu
    Route::get('/menu', [AdminController::class, 'menu'])->name('menu');

    //Rotas para o menu do usuário
    Route::get('/usuarios', [UserController::class, 'usuarios'])->name('usuarios');
    Route::get('/cadastrar', [UserController::class, 'cadastrar'])->name('cadastrar');
    Route::post('/enviaCadastro', [UserController::class, 'enviaCadastro'])->name('enviaCadastro');
    Route::get('/editar/{id}', [UserController::class, 'editar'])->name('editar');
    Route::post('/enviaEdicao/{id}', [UserController::class, 'enviaEdicao'])->name('enviaEdicao');
    Route::get('/ativar/{id}', [UserController::class, 'ativar'])->name('ativar');
    Route::get('/desativar/{id}', [UserController::class, 'desativar'])->name('desativar');

    //Rotas para o menu de produtos
    Route::get('/produtos', [ProductController::class, 'produtos'])->name('produtos');
    Route::get('/cadastrarProduto', [ProductController::class, 'cadastrarProduto'])->name('cadastrarProduto');
    Route::post('/enviaCadastroProduto', [ProductController::class, 'enviaCadastroProduto'])->name('enviaCadastroProduto');
    Route::get('/dadosProduto/{id}', [ProductController::class, 'dadosProduto'])->name('dadosProduto');
    Route::get('/editarProduto/{id}', [ProductController::class, 'editarProduto'])->name('editarProduto');
    Route::post('/enviaEdicaoProduto', [ProductController::class, 'enviaEdicaoProduto'])->name('enviaEdicaoProduto');

    //Rotas para o estoque
    Route::get('/estoque', [StockController::class, 'estoque'])->name('estoque');
    Route::get('/editarProdutoEstoque/{id}', [StockController::class, 'editarProdutoEstoque'])->name('editarProdutoEstoque');
    Route::post('/enviaEdicaoProdutoEstoque', [StockController::class, 'enviaEdicaoProdutoEstoque'])->name('enviaEdicaoProdutoEstoque');

    //Rotas para entrada
    Route::get('/entradas', [InputController::class, 'entradas'])->name('entradas');
    Route::get('/cadastrarEntrada', [InputController::class, 'cadastrarEntrada'])->name('cadastrarEntrada');
    Route::post('/enviaCadastroEntrada', [InputController::class, 'enviaCadastroEntrada'])->name('enviaCadastroEntrada');
});
