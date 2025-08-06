@extends('layouts.main')

@section('title')
    <title>Entrada de Produtos</title>
@endsection

@section('content')
    @include('layouts.navbar')

    @if (session('alerta'))
        <script>
            alert('{{ session('alerta') }}');
        </script>
    @endif

    <section class="resumo">
        <div class="pagina">
            <p class="titulo">Entradas</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('estoque') }}">Estoque</a> / Entradas
            </div>
        </div>
        <div class="ferramentas">
            <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar..." class="form-control">
            <form action="{{ route('filtrarEntradas') }}" method="post">
                @csrf
                <input type="date" name="de" id="de" class="form-control" required>
                <input type="date" name="ate" id="ate" class="form-control">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
            <a href="{{ route('cadastrarEntrada') }}" class="btn">+ Registrar nova entrada</a>
        </div>

        <div class="tabela">
            <table class="table table-data">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Responsável</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Fornecedor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada)
                        <tr>
                            <td>{{ $entrada->data }}</td>
                            <td>{{ $entrada->responsavel }}</td>
                            <td>{{ $entrada->produtos }}</td>
                            <td>{{ $entrada->quantidade }}</td>
                            <td>{{ $entrada->fornecedor }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script src="{{ asset('assets/js/pesquisar.js') }}"></script>
@endsection
