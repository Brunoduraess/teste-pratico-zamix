@extends('layouts.main')

@section('title')
    <title>Editar produto</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="formulario">
        <div class="pagina">
            <p class="titulo">Editar produto - {{ $produto->nome }}</p>
            <div class="rota">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('produtos') }}"> Produtos</a> / Editar
            </div>
        </div>
        <form action="{{ route('enviaEdicaoProduto') }}" class="row" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $produto->id }}">
            <div class="form-group col-xl-12">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Informe o nome do produto"
                    class="form-control" value="{{ $produto->nome ?? old('nome') }}">
                @error('nome')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="descricao">Descrição (Não obrigatório):</label>
                <textarea name="descricao" id="descricao" cols="30" rows="3" placeholder="Descreva o produto aqui..."
                    class="form-control">{{ $produto->descricao }}</textarea>
            </div>
            <div class="form-group col-xl-12">
                <label>Tipo:</label>
                <select name="tipo" id="tipoProduto" onchange="Composicao()" class="form-control">
                    @if ($produto->tipo)
                        <option>{{ $produto->tipo }}</option>
                    @endif
                    <option value="">-- Selecione um tipo --</option>
                    <option value="Simples" {{ old('tipo') == 'Simples' ? 'selected' : '' }}>Simples</option>
                    <option value="Composto" {{ old('tipo') == 'Composto' ? 'selected' : '' }}>Composto</option>
                </select>
                @error('tipo')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div id="composicaoProdutos" style="display: none;">
                <label>Composição do Produto:</label>
                <div id="listaProdutos"></div>
                <button type="button" onclick="adicionarProduto()" class="btn btn-success">+ Adicionar Produto</button>
            </div>
            <div class="form-group col-xl-12">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" class="form-control">
                    @if (old('categoria'))
                        <option>{{ old('categoria') }}</option>
                    @endif
                    @if ($produto->categoria)
                        <option>{{ $produto->categoria }}</option>
                    @endif
                    <option value="">-- Selecione uma categoria --</option>
                    <option value="Alimentos">Alimentos</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Construção">Construção</option>
                    <option value="Equipamentos">Equipamentos</option>
                    <option value="Ferramentas">Ferramentas</option>
                    <option value="Informática">Informática</option>
                    <option value="Limpeza">Limpeza</option>
                    <option value="Materiais de escritório">Materiais de escritório</option>
                    <option value="Materiais elétricos">Materiais elétricos</option>
                    <option value="Materiais hidráulicos">Materiais hidráulicos</option>
                    <option value="Medicamentos">Medicamentos</option>
                    <option value="Papelaria">Papelaria</option>
                </select>
                @error('categoria')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="medida">Unidade de medida:</label>
                <select name="medida" id="medida" class="form-control">
                    @if (old('medida'))
                        <option>{{ old('medida') }}</option>
                    @endif
                    @if ($produto->unidade_medida)
                        <option>{{ $produto->unidade_medida }}</option>
                    @endif
                    <option value="">-- Selecione a unidade de medida --</option>
                    <option value="un">Unidade</option>
                    <option value="kg">Quilograma</option>
                    <option value="g">Grama</option>
                    <option value="l">Litro</option>
                    <option value="ml">Mililitro</option>
                    <option value="m">Metro</option>
                    <option value="cm">Centímetro</option>
                    <option value="cx">Caixa</option>
                    <option value="pct">Pacote</option>
                    <option value="dz">Dúzia</option>
                    <option value="par">Par</option>
                    <option value="rolo">Rolo</option>
                </select>
                @error('medida')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="custo">Custo:</label>
                <input type="text" name="custo" id="custo" placeholder="Informe o custo do produto"
                    class="form-control" value="{{ $produto->custo ?? old('custo') }}">
                @error('custo')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="preco_venda">Preço de venda:</label>
                <input type="text" name="preco_venda" id="preco_venda" placeholder="Informe o preço de venda do produto"
                    class="form-control" value="{{ $produto->preco_venda ?? old('preco_venda') }}">
                @error('preco_venda')
                    <p class="erro">{{ $message }}</p>
                @enderror
            </div>
            @if ($produto->imagem)
                <div class="form-group col-xl-12">
                    <label for="imagem">Imagem atual do produto:</label>
                    <br>
                    <img src="{{ asset('storage/' . $produto->imagem . '') }}" alt="imagem" class="img_produto">
                </div>
            @endif
            <div class="form-group col-xl-12">
                <label for="imagem">Imagem do produto (Não obrigatório):</label>
                <input type="file" name="imagem" id="imagem" class="form-control">
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Enviar</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('produtos') }}" accept="image/png, image/jpeg" class="btn btn-danger">Voltar ao
                    menu</a>
            </div>
        </form>
    </section>
    <script>
        const produtosSimples = @json($produtosSimples);
        const oldComposicao = @json(old('composicao'));
        const tipo = @json($produto->tipo);
        const composicao = @json($composicoes);
    </script>
    <script src="{{ asset('assets/js/composicao.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#custo').mask('#0,00', {
                reverse: true
            });

            $('#preco_venda').mask('#0,00', {
                reverse: true
            });
        });
    </script>
@endsection
