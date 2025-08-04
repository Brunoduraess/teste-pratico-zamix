@extends('layouts.main')

@section('title')
    <title>Dados do produto</title>
@endsection

@section('content')
    @include('layouts.navbar')
    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Dados do produto - {{ $produto->nome }}</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('produtos') }}"> Produtos</a> / Dados
            </div>
        </div>
        <div class="row">
            @csrf
            <div class="form-group col-xl-4">
                <label for="nome">Nome:</label>
                <p>{{ $produto->nome }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="descricao">Descrição:</label>
                <p>{{ $produto->descricao }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label>Tipo:</label>
                <p>{{ $produto->tipo }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="categoria">Categoria:</label>
                <p>{{ $produto->categoria }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="medida">Unidade de medida:</label>
                <p>{{ $produto->unidade_medida }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="custo">Custo:</label>
                <p>{{ $produto->custo }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="preco_venda">Preço de venda:</label>
                <p>{{ $produto->preco_venda }}</p>
            </div>
            @if ($produto->tipo == 'Composto')
                <div class="tabela">
                    <table class="table table-data">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($composicoes as $composicao)
                                <tr>
                                    <td>{{ $composicao->produtoSimples->nome }}</td>
                                    <td>{{ $composicao->quantidade }}</td>
                                    <td class="acoes">
                                        <a href="{{ route('dadosProduto', ['id' => $produto->id]) }}" class="acao">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                                <path
                                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if ($produto->imagem)
                <div class="form-group col-xl-12">
                    <img src="{{ asset('storage/' . $produto->imagem . '') }}" alt="imagem" class="img_produto">
                </div>
            @endif
            <div class="form-group col-xl-2">
                <a href="{{ route('produtos') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </div>
    </section>
@endsection
