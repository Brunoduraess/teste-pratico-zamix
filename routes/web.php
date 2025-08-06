<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\OutputController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\checkLogin;
use App\Http\Middleware\checkProfile;
use App\Models\Request;
use Illuminate\Support\Facades\Route;

//Rotas de autenticação
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/esqueci', [AuthController::class, 'esqueci'])->name('esqueci');
Route::post('/esqueciSubmit', [AuthController::class, 'esqueciSubmit'])->name('esqueciSubmit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Middleware para verfificar se o usuário está logado
Route::middleware(checkLogin::class)->group(function () {

    //Middleware para verificar se o usuário é Administrador
    Route::middleware(checkProfile::class)->group(function () {
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
        Route::post('/filtrarEntradas', [InputController::class, 'filtrarEntradas'])->name('filtrarEntradas');
        Route::get('/cadastrarEntrada', [InputController::class, 'cadastrarEntrada'])->name('cadastrarEntrada');
        Route::post('/enviaCadastroEntrada', [InputController::class, 'enviaCadastroEntrada'])->name('enviaCadastroEntrada');

        //Rotas para requisições
        Route::get('/recusarRequisicao/{id}', [RequestController::class, 'recusarRequisicao'])->name('recusarRequisicao');
        Route::post('/enviaRecusaRequisicao', [RequestController::class, 'enviaRecusaRequisicao'])->name('enviaRecusaRequisicao');
        Route::get('/aprovarRequisicao/{id}', [RequestController::class, 'aprovarRequisicao'])->name('aprovarRequisicao');
        Route::post('/enviaAprovacaoRequisicao', [RequestController::class, 'enviaAprovacaoRequisicao'])->name('enviaAprovacaoRequisicao');

        //Rotas para saidas
        Route::get('/saidas', [OutputController::class, 'saidas'])->name('saidas');
    });

    Route::get('/requisicoes', [RequestController::class, 'requisicoes'])->name('requisicoes');
    Route::post('/filtrarRequsiicoes', [RequestController::class, 'filtrarRequisicoes'])->name('filtrarRequisicoes');
    Route::get('/cadastrarRequsicao', [RequestController::class, 'cadastrarRequisicao'])->name('cadastrarRequisicao');
    Route::post('/enviaCadastroRequisicao', [RequestController::class, 'enviaCadastroRequisicao'])->name('enviaCadastroRequisicao');
    Route::get('/dadosRequisicao/{id}', [RequestController::class, 'dadosRequisicao'])->name('dadosRequisicao');
});
