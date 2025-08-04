@extends('layouts.main')

@section('title')
    <title>Editar usuário</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Editar usuário - {{ $usuario->nome }}</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('usuarios') }}"> Usuários</a> / Editar
            </div>
        </div>
        <form action="{{ route('enviaEdicao', ['id' => $usuario->id]) }}" class="row" method="post">
            @csrf
            <div class="form-group col-xl-12">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" id="nome" placeholder="Informe o nome do usuário"
                    class="form-control" value="{{ $usuario->nome ?? old('nome') }}">
                @error('nome')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="Informe o email do usuário"
                    class="form-control" value="{{ $usuario->email ?? old('email') }}">
                @error('email')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group col-xl-12">
                <label for="departamento">Departamento:</label>
                <select name="departamento" id="departamento" class="form-control">
                    @if (old('departamento'))
                        <option>{{ old('departamento') }}</option>
                    @endif
                    @php
                        $departamentos = $departamentos = [
                            'Administrativo',
                            'Almoxarifado',
                            'Atendimento',
                            'Comercial',
                            'Compras',
                            'Contabilidade',
                            'Controladoria',
                            'Desenvolvimento',
                            'Financeiro',
                            'Jurídico',
                            'Logística',
                            'Marketing',
                            'Operações',
                            'Produção',
                            'Recursos Humanos',
                            'Relacionamento com o Cliente',
                            'Segurança do Trabalho',
                            'Suporte Técnico',
                            'Tecnologia da Informação',
                            'Vendas',
                        ];
                    @endphp
                    <option value="">-- Selecione um departamento --</option>
                    @foreach ($departamentos as $departamento)
                        @if ($usuario->departamento == $departamento)
                            <option selected>{{ $departamento }}</option>
                        @else
                            <option>{{ $departamento }}</option>
                        @endif
                    @endforeach
                </select>
                @error('departamento')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-12">
                <label for="perfil">Perfil no sistema:</label>
                <select name="perfil" id="perfil" class="form-control">
                    @if (old('perfil'))
                        <option>{{ old('perfil') }}</option>
                    @endif
                    @php
                        $perfis = ['Administrador', 'Usuário'];
                    @endphp
                    <option value="">-- Selecione um perfil --</option>
                    @foreach ($perfis as $perfil)
                        @if ($usuario->perfil == $perfil)
                            <option selected>{{ $perfil }}</option>
                        @else
                            <option>{{ $perfil }}</option>
                        @endif
                    @endforeach
                </select>
                @error('perfil')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('usuarios') }}" class="btn btn-danger">Voltar ao menu</a>
            </div>
        </form>
    </section>
@endsection
