@extends('layouts.main')

@section('title')
    <title>Menu de Requisições</title>
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
            <p class="titulo">Requisições</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / Requisições
            </div>
        </div>
        <div class="ferramentas">
            <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar..." class="form-control">
            <form action="{{ route('filtrarRequisicoes') }}" method="post">
                @csrf
                <input type="date" name="de" id="de" class="form-control" required>
                <input type="date" name="ate" id="ate" class="form-control">
                <button type="submit" class="btn btn-success">Filtrar</button>
            </form>
            @if (session('usuario.acesso') == 'Administrador')
                <a href="{{ route('saidas') }}" class="btn">Acessar tabela de saídas</a>
            @else
                <a href="{{ route('cadastrarRequisicao') }}" class="btn">+ Nova requisição</a>
            @endif
        </div>
        <div class="tabela">
            <table class="table table-data">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Requisitante</th>
                        <th>Departamento</th>
                        <th>Total de produtos</th>
                        <th>Finalidade</th>
                        <th>Status</th>
                        <th style="width: 130px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($requisicoes as $requisicao)
                        <tr>
                            <td>{{ $requisicao->data }}</td>
                            <td>{{ $requisicao->requisitante }}</td>
                            <td>{{ $requisicao->departamento }}</td>
                            <td>{{ $requisicao->totalProdutos }}</td>
                            <td>{{ $requisicao->finalidade }}</td>
                            <td>{{ $requisicao->status }}</td>
                            <td class="acoes">
                                <a href="{{ route('dadosRequisicao', ['id' => $requisicao->id]) }}" class="acao">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye-fill"
                                        viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                </a>
                                @if (session('usuario.acesso') == 'Administrador')
                                    @if ($requisicao->status == 'Pendente')
                                        <a href="{{ route('aprovarRequisicao', ['id' => $requisicao->id]) }}"
                                            class="acao ativar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                class="bi bi-check-lg" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('recusarRequisicao', ['id' => $requisicao->id]) }}"
                                            class="acao desativar">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-lg"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                            </svg>
                                        </a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script src="{{ asset('assets/js/pesquisar.js') }}"></script>
@endsection
