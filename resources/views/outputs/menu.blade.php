@extends('layouts.main')

@section('title')
    <title>Menu de Saídas</title>
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
            <p class="titulo">Saídas</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / Saídas
            </div>
        </div>
        <div class="ferramentas">
            <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar..." class="form-control">
            <a href="" class="btn">Filtrar</a>
        </div>
        <div class="tabela">
            <table class="table table-data">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Requisitante</th>
                        <th>Departamento</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Autorizado por</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saidas as $saida)
                        <tr>
                            <td>{{ $saida->data }}</td>
                            <td>{{ $saida->requisitante }}</td>
                            <td>{{ $saida->departamento }}</td>
                            <td>{{ $saida->produto }}</td>
                            <td>{{ $saida->quantidade }}</td>
                            <td>{{ $saida->autorizado_por }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script src="{{ asset('assets/js/pesquisar.js') }}"></script>
@endsection
