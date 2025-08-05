@extends('layouts.main')

@section('title')
    <title>Menu</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="menu">
        <a href="{{ route('usuarios') }}">
            <div class="opcao">
                <p class="titulo">Usuários</p>
                <p class="total">{{ $totalUsuarios}} usuário(s) cadastrado(s)</p>
            </div>
        </a>
        <a href="{{ route('requisicoes') }}">
            <div class="opcao">
                <p class="titulo">Requisições</p>
                <p class="total">{{ $totalRequisicoes }} nova(s) requisiçõe(s)</p>
            </div>
        </a>
        <a href="{{ route('produtos') }}">
            <div class="opcao">
                <p class="titulo">Catálogo de produtos</p>
                <p class="total">{{ $totalProdutos }} produto(s) cadastrado(s)</p>
            </div>
        </a>
                <a href="{{ route('estoque') }}">
            <div class="opcao">
                <p class="titulo">Estoque de produtos</p>
                <p class="total">{{ $totalEstoque }} produto(s) em estoque</p>
            </div>
        </a>
    </section>
@endsection
