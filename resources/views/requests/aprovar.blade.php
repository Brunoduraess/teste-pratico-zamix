@extends('layouts.main')

@section('title')
    <title>Aprovar requisição</title>
@endsection

@section('content')
    @include('layouts.navbar')
    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Aprovar requisição e confirmar saída dos produtos</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('requisicoes') }}"> Requisições</a> / Aprovar
            </div>
        </div>
        <form action="{{ route('enviaAprovacaoRequisicao') }}" method="post" class="row">
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
            <div class="form-group col-xl-8">
                <label for="status">Status:</label>
                <p>{{ $requisicao->status }}</p>
            </div>
            <br>
            @for ($i = 0; $i < count($produtos); $i++)
                <input type="hidden" name="produtos[{{ $i }}]['id']" value="{{ $produtos[$i]['idProduto'] }}">
                <input type="hidden" name="produtos[{{ $i }}]['tipo']" value="{{ $produtos[$i]['tipoProduto'] }}">
                <div class="form-group col-xl-4">
                    <label for="produto">Produto:</label>
                    <input type="text" name="produtos[{{ $i }}]['nome']"
                        id="produtos[{{ $i }}]['nome']" class="form-control"
                        value="{{ $produtos[$i]['nome'] }}" readonly>
                </div>
                <div class="form-group col-xl-4">
                    <label for="quantidade">Quantia solicitada:</label>
                    <input type="number" name="produtos[{{ $i }}]['quantidade']"
                        id="produtos[{{ $i }}]['quantidade']" class="form-control"
                        value="{{ $produtos[$i]['quantidade'] }}" readonly>
                </div>
                <div class="form-group col-xl-4">
                    <label for="totalEnviado">Quantia a ser enviada:</label>
                    <input type="number" name="produtos[{{ $i }}]['totalEnviado']"
                        id="produtos[{{ $i }}]['totalEnviado']" class="form-control" min="1"
                        max="{{ $produtos[$i]['total_estoque'] }}" placeholder="Informe a quantia a ser enviada" required>
                </div>
            @endfor
            </div>
            <div class="form-group col-xl-12">
                <label for="observacao">Caso deseje, informe aqui a sua observação:</label>
                <textarea name="observacao" id="observacao" cols="30" rows="4" placeholder="Digite aqui sua observação..."
                    class="form-control"></textarea>
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Confirmar saída dos produtos</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('requisicoes') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </form>
    </section>
@endsection
