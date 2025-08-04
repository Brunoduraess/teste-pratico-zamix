@extends('layouts.main')

@section('title')
    <title>Cadastrar usuário</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Cadastrar usuário</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('usuarios') }}"> Usuários</a> / Cadastrar
            </div>
        </div>
        <form action="{{ route('enviaCadastro') }}" class="row" method="post">
            @csrf
            <div class="form-group col-xl-12">
                <label for="nome">Nome completo:</label>
                <input type="text" name="nome" id="nome" placeholder="Informe o nome do usuário"
                    class="form-control" value="{{ old('nome') }}">
                @error('nome')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" placeholder="Informe o email do usuário"
                    class="form-control" value="{{ old('email') }}">
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
                    <option value="">-- Selecione um departamento --</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Almoxarifado">Almoxarifado</option>
                    <option value="Atendimento ao Cliente">Atendimento ao Cliente</option>
                    <option value="Compras">Compras</option>
                    <option value="Comercial">Comercial</option>
                    <option value="Financeiro">Financeiro</option>
                    <option value="Jurídico">Jurídico</option>
                    <option value="Marketing">Marketing</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Tecnologia da Informação">Tecnologia da Informação</option>
                    <option value="Vendas">Vendas</option>
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
                    <option value="">-- Selecione um perfil --</option>
                    <option>Administrador</option>
                    <option>Usuário</option>
                </select>
                @error('perfil')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('usuarios') }}" class="btn btn-danger">Voltar ao menu</a>
            </div>
        </form>
    </section>
@endsection
