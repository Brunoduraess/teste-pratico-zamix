@extends('layouts.main')

@section('title')
    <title>Cadastrar requsições de produto</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Nova requisição de produtos</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('requisicoes') }}"> Requisições</a> / Cadastrar
            </div>
        </div>
        <form action="{{ route('enviaCadastroRequisicao') }}" class="row" method="post" enctype="multipart/form-data">
            @csrf
            <div id="composicaoProdutos">
                <label>Produtos:</label>
                <div id="listaProdutos"></div>
                <button type="button" onclick="adicionarProduto()" class="btn btn-success">+ Adicionar Produto</button>
            </div>
            <div class="form-group col-xl-12">
                <label for="finalidade">Finalidade:</label>
                <input type="text" name="finalidade" id="finalidade" placeholder="Informe a finalidade da requisição"
                    class="form-control">
                @error('finalidade')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar requisição</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('requisicoes') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao menu de requisições</a>
            </div>
        </form>
    </section>
    <script>
        const produtosSimples = @json($produtos);
        const oldComposicao = @json(old('composicao'));

        console.log(oldComposicao);
    </script>
    <script src="{{ asset('assets/js/composicao.js') }}"></script>
@endsection
