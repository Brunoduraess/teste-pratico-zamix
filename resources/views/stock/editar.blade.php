@extends('layouts.main')

@section('title')
    <title>Editar produto no estoque</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Editar produto - {{ $produto->produtos->nome }}</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('estoque') }}"> Estoque</a> / Editar
            </div>
        </div>
        <form action="{{ route('enviaEdicaoProdutoEstoque') }}" class="row" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $produto->id_produto }}">
            <div class="form-group col-xl-12">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Informe o nome do produto"
                    class="form-control" value="{{ $produto->produtos->nome ?? old('nome') }}" readonly>
                @error('nome')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="nome">Quantidade:</label>
                <input type="text" name="quantidade" id="quantidade" placeholder="Informe o quantidade do produto"
                    class="form-control" value="{{ $produto->quantidade ?? old('quantidade') }}" readonly>
                @error('quantidade')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="localizacao">Localização:</label>
                <input type="text" name="localizacao" id="localizacao" class="form-control"
                    placeholder="Informe a localização do produto. Ex: Prateleira azul."
                    value="{{ $produto->localizacao ?? old('localizacao') }}">
                @error('localizacao')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="minimo">Quantia mínima em estoque:</label>
                <input type="number" name="minimo" id="minimo" class="form-control"
                    value="{{ $produto->minimo ?? old('minimo') }}">
                @error('minimo')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="maximo">Quantia máxima em estoque:</label>
                <input type="number" name="maximo" id="maximo" class="form-control"
                    value="{{ $produto->maximo ?? old('maximo') }}">
                @error('maximo')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('produtos') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </form>
    </section>
@endsection
