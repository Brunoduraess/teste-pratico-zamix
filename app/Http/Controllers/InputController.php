<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InputController extends Controller
{
    public function entradas()
    {

        $entradas = Input::with(['produtos', 'usuarios'])->get();

        foreach ($entradas as $entrada) {
            $entrada->produtos = $entrada->produtos->nome;
            $entrada->responsavel = $entrada->usuarios->nome;
            $entrada->data = date('d/m/Y H:i', strtotime($entrada->data));
        }

        return view('inputs.menu', ['entradas' => $entradas]);
    }

    public function cadastrarEntrada()
    {
        $produtos = Product::where('tipo', 'Simples')->orderBy('nome')->get(['id', 'nome']);

        return view('inputs.cadastrar', ['produtos' => $produtos]);
    }

    public function enviaCadastroEntrada(Request $request)
    {
        $request->validate(
            [
                'fornecedor' => 'required'
            ],
            [
                'fornecedor.required' => 'Informe o fornecedor dos produtos.'
            ]
        );

        $produtos = $request->input('composicao');
        $fornecedor = $request->input('fornecedor');
        $idUsuario = session('usuario.id');

        foreach ($produtos as $produto) {
            $idProduto = $produto['produto_id'];
            $quantidade = $produto['quantidade'];

            $entrada = new Input();
            $entrada->id = Str::uuid();
            $entrada->id_produto = $idProduto;
            $entrada->id_funcionario = $idUsuario;
            $entrada->quantidade = $quantidade;
            $entrada->fornecedor = $fornecedor;
            $entrada->save();

            $estoque = Stock::where('id_produto', $idProduto)->first();

            if ($estoque !== null) {
                $estoque->quantidade += $quantidade;
                $estoque->save();
            } else {
                $entradaEstoque = new Stock();
                $entradaEstoque->id = Str::uuid();
                $entradaEstoque->id_produto = $idProduto;
                $entradaEstoque->quantidade = $quantidade;
                $entradaEstoque->localizacao = 'Almoxarifado';
                $entradaEstoque->save();
            }
        }

        return redirect()->route('entradas')->with('alerta', 'Entrada cadastrada');
    }

    public function dadosProdutoEstoque($id)
    {
        
    }
}
