CREATE TABLE users (
    id CHAR(36) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    departamento VARCHAR(50) NOT NULL,
    perfil VARCHAR(30) NOT NULL,
    senha CHAR(255) NOT NULL,
    status ENUM('Ativo', 'Inativo') DEFAULT 'Ativo',
    ultimo_acesso DATETIME,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id CHAR(36) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    tipo ENUM('Simples', 'Composto') NOT NULL,
    categoria VARCHAR(30) NOT NULL,
    unidade_medida VARCHAR(10) NOT NULL,
    custo DOUBLE NOT NULL,
    preco_venda DOUBLE NOT NULL,
    imagem TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE compositions (
    id CHAR(36) PRIMARY KEY,
    id_produto_composto CHAR(36) NOT NULL,
    id_produto_simples CHAR(36) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_produto_composto) REFERENCES products(id),
    FOREIGN KEY (id_produto_simples) REFERENCES products(id)
);


CREATE TABLE stocks (
    id CHAR(36) PRIMARY KEY,
    id_produto CHAR(36) NOT NULL,
    quantidade INT NOT NULL,
    localizacao VARCHAR(100) NOT NULL,
    minimo INT DEFAULT 0,
    maximo INT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_produto) REFERENCES products(id)
);


CREATE TABLE inputs (
    id CHAR(36) PRIMARY KEY,
    id_produto CHAR(36) NOT NULL,
    id_funcionario CHAR(36) NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    quantidade INT NOT NULL,
    fornecedor VARCHAR(100) NOT NULL,
    FOREIGN KEY (id_produto) REFERENCES products(id),
    FOREIGN KEY (id_funcionario) REFERENCES users(id)
);

CREATE TABLE requests (
    id CHAR(36) PRIMARY KEY,
    id_funcionario CHAR(36) NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    finalidade TEXT NOT NULL,
    status ENUM('Pendente', 'Rejeitada', 'Concluida') DEFAULT 'Pendente',
    data_avaliacao DATETIME,
    avaliado_por CHAR(36),
    observacao TEXT,
    FOREIGN KEY (id_funcionario) REFERENCES users(id),
    FOREIGN KEY (avaliado_por) REFERENCES users(id)
);

CREATE TABLE request_products (
    id CHAR(36) PRIMARY KEY,
    id_requisicao CHAR(36) NOT NULL,
    id_produto CHAR(36) NOT NULL,
    quantidade INT NOT NULL,
    FOREIGN KEY (id_requisicao) REFERENCES requests(id),
    FOREIGN KEY (id_produto) REFERENCES products(id)
);


CREATE TABLE outputs (
    id CHAR(36) PRIMARY KEY,
    id_requisicao CHAR(36) NOT NULL,
    id_produto CHAR(36) NOT NULL,
    autorizado_por CHAR(36) NOT NULL,
    data TIMESTAMP,
    quantidade INT NOT NULL,
    observacao TEXT,
    FOREIGN KEY (id_requisicao) REFERENCES requests(id),
    FOREIGN KEY (id_produto) REFERENCES products(id),
    FOREIGN KEY (autorizado_por) REFERENCES users(id)
);

