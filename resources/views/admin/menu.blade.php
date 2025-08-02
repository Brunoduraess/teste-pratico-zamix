@extends('layouts.main')

@section('title')
    <title>Menu</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="menu">
        <a href="">
            <div class="opcao">
                <p class="titulo">Usuários</p>
                <p class="total">20 usuários cadastrados</p>
            </div>
        </a>
        <a href="">
            <div class="opcao">
                <p class="titulo">Requisições</p>
                <p class="total">2 novas requisições</p>
            </div>
        </a>
        <a href="">
            <div class="opcao">
                <p class="titulo">Catálogo de produtos</p>
                <p class="total">205 produtos cadastrados</p>
            </div>
        </a>
                <a href="">
            <div class="opcao">
                <p class="titulo">Estoque de produtos</p>
                <p class="total">20 usuários cadastrados</p>
            </div>
        </a>
    </section>
@endsection
