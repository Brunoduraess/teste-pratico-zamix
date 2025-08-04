@extends('layouts.main')

@section('title')
    <title>Menu de Produtos</title>
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
            <p class="titulo">Produtos</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / Produtos
            </div>
        </div>
        <div class="ferramentas">
            <input type="text" name="pesquisar" id="pesquisar" placeholder="Pesquisar..." class="form-control">
            <a href="{{ route('cadastrarProduto') }}" class="btn">Cadastrar novo produto</a>
        </div>

        <div class="tabela">
            <table class="table table-data">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Und. de medida</th>
                        <th>Custo</th>
                        <th>Preço de venda</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->tipo }}</td>
                            <td>{{ $produto->categoria }}</td>
                            <td>{{ $produto->unidade_medida }}</td>
                            <td>{{ $produto->custo }}</td>
                            <td>{{ $produto->preco_venda }}</td>
                            <td class="acoes">
                                <a href="{{ route('dadosProduto', ['id' => $produto->id]) }}" class="acao">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-eye-fill"
                                        viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path
                                            d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg>
                                </a>
                                <a href="{{ route('editarProduto', ['id' => $produto->id]) }}" class="acao">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                    </svg>
                                </a>
                            </td>
                            {{-- <td>
                                @if ($produto->status == 'Ativo')
                                    <p class="ativo">{{ $produto->status }}</p>
                                @else
                                    <p class="inativo">{{ $produto->status }}</p>
                                @endif
                            </td>
                            <td>{{ $produto->ultimo_acesso }}</td>
                            <td class="acoes">
                                @if ($produto->status == 'Ativo')
                                    <a href="{{ route('editar', ['id' => $produto->id]) }}" class="acao">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('desativar', ['id' => $produto->id]) }}" class="acao desativar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-person-fill-x" viewBox="0 0 16 16">
                                            <path
                                                d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                            <path
                                                d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('ativar', ['id' => $produto->id]) }}" class="acao ativar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                            <path
                                                d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                    </a>
                                @endif
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script src="{{ asset('assets/js/pesquisar.js') }}"></script>
@endsection
