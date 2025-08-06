<?php

namespace App\Http\Controllers;

use App\Models\Input;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function estoque()
    {

        $estoque = Stock::with('produtos')->get();

        foreach ($estoque as $produto) {
            $idProduto = $produto->id_produto;
            $ultimaEntrada = Input::where('id_produto', $idProduto)
                ->orderBy('data', 'desc')
                ->value('data');

            $produto->nome = $produto->produtos->nome;
            $produto->maximo = $produto->maximo ?? '-';
            $produto->ultimaEntrada = isset($ultimaEntrada) ? date('d/m/Y H:i', strtotime($ultimaEntrada)) : '-';
        }

        return view('stock.menu', ['estoque' => $estoque]);
    }

    public function editarProdutoEstoque($id)
    {
        $produtoEstoque = Stock::where('id_produto', $id)
            ->with('produtos')
            ->first();

        return view('stock.editar', ['produto' => $produtoEstoque]);
    }

    public function enviaEdicaoProdutoEstoque(Request $request)
    {
        $request->validate(
            [
                'localizacao' => 'required',
                'minimo' => 'min:0',
                'maximo' => 'min:0'
            ],
            [
                'localizacao.required' => 'Informe a localização do produto. Ex: Prateleira azul.',
                'minimo.min' => 'Informe um valor maior que 0',
                'maximo.min' => 'Informe um valor maior que 0'
                            ]
        );

        $localizacao = $request->input('localizacao');
        $minimo = $request->input('minimo');
        $maximo = $request->input('maximo');

        $produtoEstoque = Stock::where('id_produto', $request->input('id'))->first();

        $produtoEstoque->localizacao = $localizacao;
        $produtoEstoque->minimo = $minimo;
        $produtoEstoque->maximo = $maximo;
        $produtoEstoque->save();

        return redirect()->route('estoque')->with('alerta', 'Estoque editado.');
    }
}
