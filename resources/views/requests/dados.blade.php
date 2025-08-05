@extends('layouts.main')

@section('title')
    <title>Dados da requisição</title>
@endsection

@section('content')
    @include('layouts.navbar')
    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Dados da requisição</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('requisicoes') }}"> Requisições</a> / Dados
            </div>
        </div>
        <div class="row">
            @csrf
            <div class="form-group col-xl-4">
                <label for="nome">Data:</label>
                <p>{{ $requisicao->data }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="requisitante">Requisitante:</label>
                <p>{{ $requisicao->requisitante }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="departamento">Departamento:</label>
                <p>{{ $requisicao->departamento }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="finalidade">Finalidade:</label>
                <p>{{ $requisicao->finalidade }}</p>
            </div>
            <div class="form-group col-xl-4">
                <label for="status">Status:</label>
                <p>{{ $requisicao->status }}</p>
            </div>
            @if ($requisicao->data_avaliacao)
                <div class="form-group col-xl-4">
                    <label for="data">Data da avaliação:</label>
                    <p>{{ $requisicao->data_avaliacao }}</p>
                </div>
                <div class="form-group col-xl-4">
                    <label for="avaliador">Avaliado por:</label>
                    <p>{{ $requisicao->avaliado_por }}</p>
                </div>

                @if ($requisicao->observacao)
                    <div class="form-group col-xl-4">
                        <label for="observacao">Avaliado por:</label>
                        <p>{{ $requisicao->observacao }}</p>
                    </div>
                @endif
            @endif
            <div class="tabela">
                <p class="titulo"></p>
                <table class="table table-data">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            @if ($requisicao->status == 'Concluida')
                                <th>Quantia enviada</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->quantidade }}</td>
                                @if ($requisicao->status == 'Concluida')
                                    <td>{{ $produto->totalEnviado }}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group col-xl-2">
                <a href="{{ route('requisicoes') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </div>
    </section>
@endsection
