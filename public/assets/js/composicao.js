
function Composicao() {
    const tipoInput = document.getElementById('tipoProduto');

    if (!tipoInput) {
        console.warn('Elemento com id "tipoProduto" não encontrado.');
        return;
    }

    const tipo = tipoInput.value;
    const composicao = document.getElementById('composicaoProdutos');

    if (composicao) {
        composicao.style.display = tipo === 'Composto' ? 'block' : 'none';
    }
}

if (typeof oldComposicaoEntrada !== 'undefined' && Array.isArray(oldComposicaoEntrada)) {
    Composicao();

    oldComposicaoEntrada.forEach((item) => {
        adicionarProduto(item);
    });
}

else if (typeof oldComposicao !== 'undefined' && Array.isArray(oldComposicao)) {
    const tipoProduto = document.getElementById('tipoProduto');
    if (tipoProduto) tipoProduto.value = 'Composto';
    Composicao();

    oldComposicao.forEach((item) => {
        adicionarProduto(item);
    });
}

else if (typeof composicao !== 'undefined' && Array.isArray(composicao)) {
    Composicao();

    composicao.forEach((item) => {
        adicionarProduto(item);
    });
}


function adicionarProduto(oldData = null) {
    const lista = document.getElementById('listaProdutos');
    const index = lista.children.length;

    const linha = document.createElement('div');
    linha.style.marginBottom = '10px';
    linha.style.display = 'flex';
    linha.style.gap = '10px';
    linha.style.alignItems = 'center';

    // Select de produto
    const select = document.createElement('select');
    select.name = `composicao[${index}][produto_id]`;
    select.classList.add('form-control');
    select.required = true;

    const defaultOption = document.createElement('option');
    defaultOption.text = '-- Selecione o produto --';
    defaultOption.value = '';
    select.appendChild(defaultOption);

    produtosSimples.forEach(p => {
        const opt = document.createElement('option');
        opt.value = p.id;
        opt.text = p.nome;
        if (oldData?.produto_id == p.id) opt.selected = true;
        select.appendChild(opt);
    });

    // Campo de quantidade
    const quantidade = document.createElement('input');
    quantidade.type = 'number';
    quantidade.name = `composicao[${index}][quantidade]`;
    quantidade.placeholder = 'Quantidade';
    quantidade.min = 1;
    quantidade.classList.add('form-control');
    quantidade.required = true;
    quantidade.value = oldData?.quantidade ?? '';
    quantidade.style.width = '100px';

    // Botão de remover
    const remover = document.createElement('button');
    remover.type = 'button';
    remover.textContent = 'Remover';
    remover.classList.add('btn', 'btn-danger');
    remover.onclick = () => linha.remove();

    linha.appendChild(select);
    linha.appendChild(quantidade);
    linha.appendChild(remover);
    lista.appendChild(linha);
}