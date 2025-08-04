<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function produtos()
    {
        $produtos = Product::all();

        foreach ($produtos as $produto) {
            $produto->descricao = isset($produto->descricao) ? $produto->descricao : '-';
            $produto->custo = "R$ " . number_format($produto->custo, 2, ',', '.');
            $produto->preco_venda = "R$ " . number_format($produto->preco_venda, 2, ',', '.');
        }


        return view('products.menu', ['produtos' => $produtos]);
    }

    public function cadastrarProduto()
    {

        $produtosSimples = Product::where('tipo', 'Simples')->get();

        return view('products.cadastrar', ['produtosSimples' => $produtosSimples]);
    }

    public function enviaCadastroProduto(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'tipo' => 'required',
                'categoria' => 'required',
                'medida' => 'required',
                'custo' => 'required',
                'preco_venda' => 'required'
            ],
            [
                'nome.required' => 'Informe o nome do produto.',
                'tipo.required' => 'Informe o tipo de produto.',
                'categoria.required' => 'Informe a categoria do produto.',
                'medida.required' => 'Informe a unidade de medida do produto.',
                'custo.required' => 'Informe o custo do produto.',
                'preco_venda.required' => 'Informe o preço de venda do produto.'
            ]
        );

        $id = Str::uuid();
        $nome = $request->input('nome');
        $descricao = $request->input('descricao') ?? null;
        $tipo = $request->input('tipo');
        $categoria = $request->input('categoria');
        $medida = $request->input('medida');
        $custo = $this->toDouble($request->input('custo'));
        $preco_venda = $this->toDouble($request->input('preco_venda'));
        $imagem = $request->file('imagem');

        if ($imagem) {
            $imagem = Storage::disk('public')->put("uploads/$id", $request->file('imagem'));
        }

        $produto = new Product();
        $produto->id = $id;
        $produto->nome = $nome;
        $produto->descricao = $descricao;
        $produto->tipo = $tipo;
        $produto->categoria = $categoria;
        $produto->unidade_medida = $medida;
        $produto->custo = $custo;
        $produto->preco_venda = $preco_venda;
        $produto->imagem = $imagem;
        $produto->save();

        if ($tipo == "Composto") {
            foreach ($request->composicao as $item) {
                $idComposicao = Str::uuid();
                $idProdutoSimples = $item['produto_id'];
                $quantidade = $item['quantidade'];

                $composicao = new Composition();
                $composicao->id = $idComposicao->toString();
                $composicao->id_produto_composto = $id->toString();
                $composicao->id_produto_simples = $idProdutoSimples;
                $composicao->quantidade = $quantidade;

                $composicao->save();
            }
        }

        return redirect()->route('produtos')->with('alerta', 'Produto cadastrado.');
    }

    private function toDouble($valor)
    {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);

        return $valor;
    }

    public function dadosProduto($id)
    {
        $produto = Product::find($id);

        $id = $produto->id;

        $produtoComposto = Product::with('composicoes.produtoSimples')->find($id);

        $produto->custo = "R$ " . $this->formataValor($produto->custo);
        $produto->preco_venda = "R$ " . $this->formataValor($produto->preco_venda);

        return view('products.dados', ['produto' => $produto, 'composicoes' => $produtoComposto->composicoes]);
    }

    public function editarProduto($id)
    {
        $produto = Product::find($id);

        $id = $produto->id;

        $produtoComposto = Product::with('composicoes.produtoSimples')->find($id);

        foreach ($produtoComposto->composicoes as $composicao) {
            $composicao->produto_id = $composicao->id_produto_simples;
            $composicao->nome = $composicao->produtoSimples->nome;
        }

        $produtosSimples = Product::where('tipo', 'Simples')->get();

        $produto->custo = $this->formataValor($produto->custo);
        $produto->preco_venda = $this->formataValor($produto->preco_venda);

        return view('products.editar', ['produto' => $produto, 'composicoes' => $produtoComposto->composicoes, 'produtosSimples' => $produtosSimples]);
    }

    public function enviaEdicaoProduto(Request $request)
    {
        $request->validate(
            [
                'nome' => 'required',
                'tipo' => 'required',
                'categoria' => 'required',
                'medida' => 'required',
                'custo' => 'required',
                'preco_venda' => 'required'
            ],
            [
                'nome.required' => 'Informe o nome do produto.',
                'tipo.required' => 'Informe o tipo de produto.',
                'categoria.required' => 'Informe a categoria do produto.',
                'medida.required' => 'Informe a unidade de medida do produto.',
                'custo.required' => 'Informe o custo do produto.',
                'preco_venda.required' => 'Informe o preço de venda do produto.'
            ]
        );

        $id = $request->input('id');
        $nome = $request->input('nome');
        $descricao = $request->input('descricao') ?? null;
        $tipo = $request->input('tipo');
        $categoria = $request->input('categoria');
        $medida = $request->input('medida');
        $custo = $this->toDouble($request->input('custo'));
        $preco_venda = $this->toDouble($request->input('preco_venda'));
        $imagem = $request->file('imagem');

        if ($imagem) {
            $imagem = Storage::disk('public')->put("uploads/$id", $request->file('imagem'));
        }

        $produto = Product::find($id);
        $produto->id = $id;
        $produto->nome = $nome;
        $produto->descricao = $descricao;
        $produto->tipo = $tipo;
        $produto->categoria = $categoria;
        $produto->unidade_medida = $medida;
        $produto->custo = $custo;
        $produto->preco_venda = $preco_venda;

        if ($imagem) {
            $produto->imagem = $imagem;
        }

        $produto->save();

        if ($tipo == "Composto") {

            $composicao = Composition::where('id_produto_composto', $id);
            $composicao->delete();

            foreach ($request->composicao as $item) {

                $idComposicao = Str::uuid();
                $idProdutoSimples = $item['produto_id'];
                $quantidade = $item['quantidade'];

                $composicao = new Composition();
                $composicao->id = $idComposicao;
                $composicao->id_produto_composto = $id;
                $composicao->id_produto_simples = $idProdutoSimples;
                $composicao->quantidade = $quantidade;

                $composicao->save();
            }
        }

        return redirect()->route('produtos')->with('alerta', 'Alterações salvas.');
    }

    private function formataValor($valor)
    {
        return number_format($valor, 2, ',', '.');
    }
}
