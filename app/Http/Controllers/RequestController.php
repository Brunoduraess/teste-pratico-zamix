<?php

namespace App\Http\Controllers;

use App\Models\Output;
use App\Models\Product;
use App\Models\Request as ModelsRequest;
use App\Models\RequestProduct;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    public function requisicoes()
    {
        $requisicoes = ModelsRequest::with(['produtos', 'usuarios'])->get();

        foreach ($requisicoes as $requisicao) {

            $idRequisicao = $requisicao->id;

            $totalProdutos = RequestProduct::where('id_requisicao', $idRequisicao)->count();

            $requisicao->totalProdutos = $totalProdutos;
            $requisicao->data = date('d/m/Y H:i', strtotime($requisicao->data));
            $requisicao->requisitante = $requisicao->usuarios->nome;
            $requisicao->departamento = $requisicao->usuarios->departamento;
        }

        return view('requests.menu', ['requisicoes' => $requisicoes]);
    }

    public function cadastrarRequisicao()
    {
        $produtos = Product::all();

        return view('requests.cadastrar', ['produtos' => $produtos]);
    }

    public function enviaCadastroRequisicao(Request $request)
    {
        $request->validate(
            [
                'finalidade' => 'required'
            ],
            [
                'finalidade.required' => 'Informe a finalidade da requisição.'
            ]
        );

        $idRequisicao = Str::uuid();
        $idUsuario = session('usuario.id');
        $finalidade = $request->input('finalidade');

        $novaRequisicao = new ModelsRequest();
        $novaRequisicao->id = $idRequisicao;
        $novaRequisicao->id_funcionario = $idUsuario;
        $novaRequisicao->finalidade = $finalidade;
        $novaRequisicao->save();

        foreach ($request->composicao as $produto) {
            $idProdutoRequisicao = Str::uuid();
            $idProduto = $produto['produto_id'];
            $quantidade = $produto['quantidade'];

            $produtoRequisicao = new RequestProduct();
            $produtoRequisicao->id = $idProdutoRequisicao;
            $produtoRequisicao->id_requisicao = $idRequisicao;
            $produtoRequisicao->id_produto = $idProduto;
            $produtoRequisicao->quantidade = $quantidade;
            $produtoRequisicao->save();
        }

        return redirect()->route('requisicoes')->with('alerta', 'Reuisição enviada.');
    }

    public function dadosRequisicao($id)
    {
        $requisicao = ModelsRequest::where('id', $id)->with(['produtos', 'usuarios', 'avaliador'])->first();

        $idRequisicao = $requisicao->id;

        $produtosRequisicao = RequestProduct::where('id_requisicao', $idRequisicao)
            ->with('produtos')
            ->get();

        foreach ($produtosRequisicao as $produto) {
            $produto->nome = $produto->produtos->nome;
            $idProduto = $produto->produtos->id;

            if ($requisicao->status == 'Concluida'){
                $totalEnviado = Output::where(
                    [
                        'id_requisicao' => $idRequisicao,
                        'id_produto' => $idProduto
                    
                    ])->value('quantidade');

                $produto->totalEnviado = $totalEnviado;
            }
        }

        $requisicao->data = date('d/m/Y H:i', strtotime($requisicao->data));
        $requisicao->requisitante = $requisicao->usuarios->nome;
        $requisicao->departamento = $requisicao->usuarios->departamento;
        $requisicao->data_avaliacao = date('d/m/Y H:i', strtotime($requisicao->data_avaliacao));
        $requisicao->avaliado_por = $requisicao->avaliador->nome;


        return view('requests.dados', ['requisicao' => $requisicao, 'produtos' => $produtosRequisicao]);
    }

    public function recusarRequisicao($id)
    {
        $requisicao = ModelsRequest::where('id', $id)->with(['produtos', 'usuarios'])->first();

        $idRequisicao = $requisicao->id;

        $produtosRequisicao = RequestProduct::where('id_requisicao', $idRequisicao)
            ->with('produtos')
            ->get();

        foreach ($produtosRequisicao as $produto) {
            $produto->nome = $produto->produtos->nome;
        }

        $requisicao->data = date('d/m/Y H:i', strtotime($requisicao->data));
        $requisicao->requisitante = $requisicao->usuarios->nome;
        $requisicao->departamento = $requisicao->usuarios->departamento;


        return view('requests.recusar', ['requisicao' => $requisicao, 'produtos' => $produtosRequisicao]);
    }

    public function enviaRecusaRequisicao(Request $request)
    {
        $request->validate(
            [
                'motivo' => 'required'
            ],
            [
                'motivo.required' => 'Informe o motivo da recusa da requisição.'
            ]
        );

        $idRequisicao = $request->input('id');
        $motivo = $request->input('motivo');
        $idUsuario = session('usuario.id');

        $requisicao = ModelsRequest::where('id', $idRequisicao)->first();
        $requisicao->status = 'Rejeitada';
        $requisicao->data_avaliacao = Carbon::now();
        $requisicao->avaliado_por = $idUsuario;
        $requisicao->observacao = $motivo;
        $requisicao->save();

        return redirect()->route('requisicoes')->with('alerta', 'Requisição recusada.');
    }

    public function aprovarRequisicao($id)
    {
        $requisicao = ModelsRequest::where('id', $id)->with(['produtos', 'usuarios'])->first();

        $idRequisicao = $requisicao->id;

        $produtosRequisicao = RequestProduct::where('id_requisicao', $idRequisicao)
            ->with('produtos')
            ->get();

        foreach ($produtosRequisicao as $produto) {
            $produto->nome = $produto->produtos->nome;
            $idProduto = $produto->produtos->id;
            $produto->idProduto = $idProduto;

            $totalEstoque = Stock::where('id_produto', $idProduto)->value('quantidade');
            $produto->total_estoque = $totalEstoque;
        }

        $requisicao->data = date('d/m/Y H:i', strtotime($requisicao->data));
        $requisicao->requisitante = $requisicao->usuarios->nome;
        $requisicao->departamento = $requisicao->usuarios->departamento;


        return view('requests.aprovar', ['requisicao' => $requisicao, 'produtos' => $produtosRequisicao]);
    }

    public function enviaAprovacaoRequisicao(Request $request)
    {
        $idRequisicao = $request->input('id');
        $idUsuario = session('usuario.id');
        $observacao = $request->input('observacao') ?? null;
        $produtos = $request->input('produtos');

        foreach ($produtos as $produto) {
            $idProduto = $produto["'id'"];
            $totalEnviado = $produto["'totalEnviado'"];

            $saida = new Output();
            $saida->id = Str::uuid();
            $saida->id_requisicao = $idRequisicao;
            $saida->id_produto = $idProduto;
            $saida->autorizado_por = $idUsuario;
            $saida->quantidade = $totalEnviado;
            $saida->save();

            $produtoEstoque = Stock::where('id_produto', $idProduto)->first();

            $produtoEstoque->quantidade -= $totalEnviado;
            $produtoEstoque->save();
        }

        $requisicao = ModelsRequest::where('id', $idRequisicao)->first();
        $requisicao->status = 'Concluida';
        $requisicao->data_avaliacao = Carbon::now();
        $requisicao->avaliado_por = $idUsuario;
        $requisicao->observacao = $observacao;
        $requisicao->save();

        return redirect()->route('requisicoes')->with('alerta', 'Saída confirmada');
    }
}
