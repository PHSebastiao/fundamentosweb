USE atividade;

CREATE TABLE IF NOT EXISTS pessoa (
    CPF VARCHAR(16) PRIMARY KEY,
    nomePessoa varchar(500) not null,
    idadePessoa int(10) not null
);

CREATE TABLE IF NOT EXISTS  produto (
    idProduto int(11) PRIMARY KEY auto_increment,
    nomeProduto varchar(500) not null,
    pesoProduto varchar(250) not null,
    precoProduto varchar(250) not null
);