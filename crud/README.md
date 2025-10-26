# Sistema de CRUD - Competição Musical

Este projeto é um sistema básico de CRUD (Create, Read, Update, Delete) para gerenciar **grupos**, **músicas**, **competições** e **participações**. Foi desenvolvido em **PHP** com **PDO** e **MySQL**, utilizando **Tailwind CSS** para o front-end.

---

## Tecnologias Utilizadas

- **PHP 8.x**
- **MySQL**
- **PDO** para acesso seguro ao banco de dados
- **Tailwind CSS** para estilo
- Servidor local (ex.: XAMPP, MAMP ou LAMP)

---

## Instalação

1. Clone o repositório:

```bash
git clone https://github.com/cabarros3/web1.git
```

2. Copie os arquivos para a pasta do seu servidor local (htdocs no XAMPP, por exemplo).
3. Crie um banco de dados no MySQL e configure o arquivo config/db.php com suas credenciais:

```<?php
$host = 'localhost';
$db   = 'nome_do_banco';
$user = 'usuario';
$pass = 'senha';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```

4. Crie as tabelas necessárias no banco:

```
CREATE TABLE grupo (
    grupo_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE musica (
    musica_id INT AUTO_INCREMENT PRIMARY KEY,
    grupo_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    ano_lancamento INT,
    album VARCHAR(255),
    FOREIGN KEY (grupo_id) REFERENCES grupo(grupo_id)
);

CREATE TABLE competicao (
    competicao_id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    data DATE
);

CREATE TABLE participacao (
    participacao_id INT AUTO_INCREMENT PRIMARY KEY,
    grupo_id INT NOT NULL,
    competicao_id INT NOT NULL,
    musica_id INT NOT NULL,
    colocacao INT,
    pontuacao DECIMAL(5,2),
    FOREIGN KEY (grupo_id) REFERENCES grupo(grupo_id),
    FOREIGN KEY (competicao_id) REFERENCES competicao(competicao_id),
    FOREIGN KEY (musica_id) REFERENCES musica(musica_id)
);
```

---

## Uso

1. Abra o navegador e acesse http://localhost/seu-projeto/index.php.

2. Clique no link do CRUD que deseja acessar:

- Gerenciar Grupos

- Gerenciar Músicas

- Gerenciar Competições

- Gerenciar Participações

3. Utilize os formulários para criar, visualizar, editar e deletar registros.

---

## Estrutura de CRUD

Cada entidade possui quatro arquivos:

| Operação | Arquivo                |
| -------- | ---------------------- |
| Create   | create\_<entidade>.php |
| Read     | read\_<entidade>.php   |
| Update   | update\_<entidade>.php |
| Delete   | delete\_<entidade>.php |

---

## Observações

- Todos os formulários usam Tailwind CSS para estilo e responsividade.

- Todas as operações de banco utilizam PDO com prepared statements para segurança contra SQL Injection.

- Campos opcionais, como colocacao e pontuacao em participações, aceitam NULL.

## Autora

Camilla Barros – Desenvolvedor(a) Front-end / PHP
