@extends('layouts.main')

@section('title')
    <title>Cadastrar entrada</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Nova entrada de produtos</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('estoque') }}"> Estoque</a> / <a href="{{ route('entradas') }}">Entradas</a> / Cadastrar
            </div>
        </div>
        <form action="{{ route('enviaCadastroEntrada') }}" class="row" method="post" enctype="multipart/form-data">
            @csrf
            <div id="composicaoProdutos">
                <label>Produtos:</label>
                <div id="listaProdutos"></div>
                <button type="button" onclick="adicionarProduto()" class="btn btn-success">+ Adicionar Produto</button>
            </div>
            <div class="form-group col-xl-12">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" name="fornecedor" id="fornecedor" placeholder="Informe o fornecedor do produto"
                    class="form-control">
                @error('fornecedor')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar entrada</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('entradas') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao menu de entradas</a>
            </div>
        </form>
    </section>
    <script>
        const produtosSimples = @json($produtos);
        const oldComposicaoEntrada = @json(old('composicao'));
    </script>
    <script src="{{ asset('assets/js/composicao.js') }}"></script>
@endsection
