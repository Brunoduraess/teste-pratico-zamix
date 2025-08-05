@extends('layouts.main')

@section('title')
    <title>Estoque de Produtos</title>
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
            <p class="titulo">Estoque</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / Estoque
            </div>
        </div>
        <div class="ferramentas">
            <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar..." class="form-control">
            <a href="{{ route('entradas') }}" class="btn">Acessar entradas</a>
        </div>

        <div class="tabela">
            <table class="table table-data">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Localização</th>
                        <th>Mínimo</th>
                        <th>Máximo</th>
                        <th>Última entrada</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estoque as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->quantidade }}</td>
                            <td>{{ $produto->localizacao }}</td>
                            <td>{{ $produto->minimo }}</td>
                            <td>{{ $produto->maximo }}</td>
                            <td>{{ $produto->ultimaEntrada }}</td>
                            <td class="acoes">
                                <a href="{{ route('editarProdutoEstoque', ['id' => $produto->id_produto]) }}" class="acao">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script src="{{ asset('assets/js/pesquisar.js') }}"></script>
@endsection
