# Api.CategoryManager

<p align="center"><a href="https://categorymanage.salomao.dev.br" target="_blank"><img src="https://github.com/IanSalomao/CategoryManager/blob/main/src/assets/logo.png" width="400" alt="Logo"></a></p>

## Sobre o Projeto

Esse projeto se trata da do backend de uma aplicação desenvolvida para gerenciar categorias e subcategorias de forma eficiente, onde os usuários podem criar, editar, e excluir categorias e suas subcategorias.

## Tecnologias utilizadas

-   PHP: Linguagem principal utilizada para a construção da API.
-   Laravel: Framework PHP utilizado para a estruturação da API, organização do código e fornecimento de funcionalidades como roteamento, middleware e gerenciamento de banco de dados.
-   MySQL: Banco de dados relacional usado para armazenar as categorias, subcategorias e informações de usuários.
-   Composer: Gerenciador de dependências para o PHP, usado para instalar pacotes necessários ao Laravel.
-   Sanctum: Utilizado para a autenticação e gerenciamento de sessões de usuários.
-   Eloquent ORM: Ferramenta integrada ao Laravel que facilita as interações com o banco de dados usando uma abordagem orientada a objetos.
-   Migrations: Utilizado para o versionamento e controle do esquema do banco de dados.

## Demo

Confira a demonstração do projeto <a  href="https://categorymanage.salomao.dev.br">clicando aqui.</a>

## Como Usar

Para utilizar a API do CategoryManager, é nescesário ter configurado o php e o composer já configurados na sua máquina.

```bash
# Clone este repositório
$ git clone https://github.com/IanSalomao/Api.CategoryManager.git

# Acesse a pasta do projeto
$ cd Api.CategoryManager

# Instale as dependências do Laravel
$ composer install

# Copie o arquivo .env.example para .env
$ cp .env.example .env

# Configure o arquivo .env com as informações do banco de dados

# Gere a chave de criptografia do Laravel
$ php artisan key:generate

# Rode as migrações para criar as tabelas no banco de dados
$ php artisan migrate

# Inicie o servidor local do Laravel
$ php artisan serve

```
