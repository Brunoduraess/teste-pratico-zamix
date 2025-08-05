@extends('layouts.main')

@section('title')
    <title>Recusar requisição</title>
@endsection

@section('content')
    @include('layouts.navbar')
    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Recusar requisição</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('requisicoes') }}"> Requisições</a> / Recusar
            </div>
        </div>
        <form action="{{ route('enviaRecusaRequisicao') }}" method="post" class="row">
            @csrf
            <input type="hidden" name="id" value="{{ $requisicao->id }}">
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
            <div class="tabela">
                <p class="titulo"></p>
                <table class="table table-data">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->quantidade }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="form-group col-xl-12">
                <label for="motivo">Informe o motivo da recusa da requisição:</label>
                <textarea name="motivo" id="motivo" cols="30" rows="4" placeholder="Digite aqui o motivo da recusa da requisição..." class="form-control"></textarea>
                @error('motivo')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Registrar recusa da requisição</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('requisicoes') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </form>
    </section>
@endsection
