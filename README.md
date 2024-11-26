# teste-cashpago

# Projeto com API (Laravel) e Frontend (React)

Este projeto é composto por uma API desenvolvida em Laravel e um frontend desenvolvido em React. Abaixo estão as instruções para rodar o projeto, tanto utilizando Docker quanto rodando a API e o frontend separadamente.

---

## ⚙️ Rodando o projeto com Docker

### Pré-requisitos

1. Ter o [Docker](https://www.docker.com/) e o [Docker Compose](https://docs.docker.com/compose/) instalados na máquina.

### Passos para rodar o projeto

1. Clone o repositório:
   ```bash
   git clone <URL_DO_REPOSITORIO>
   cd <NOME_DA_PASTA_DO_PROJETO>

2. Inicie os containers com Docker Compose:
   ```bash
   docker-compose up --build

3. Acesse os serviços nos seguintes endereços:

API Laravel: http://localhost:8000
Frontend React: http://localhost:3000

4. Para parar os containers:
   ```bash
   docker-compose down


## Rodando o projeto separadamente (sem Docker)
### Pré-requisitos

1. API Laravel:

1.1. PHP 8.1 ou superior instalado ([guia de instalação](https://www.php.net/manual/pt_BR/install.php)).
1.2. Composer instalado (guia de instalação).
1.3. Ter a Chave da Api do OpenWeather # como OPENWEATHER_API_KEY no arquivo .env

2. Frontend React:

Node.js e npm instalados ([guia de instalação](https://nodejs.org/pt)).

### Rodando a API (Laravel)

1. Navegue até a pasta da API:
   ```bash
   cd <NOME_DA_PASTA_DA_API>

2. Instale as dependências do Laravel:
   ```bash
   composer install

3. Configure o arquivo .env:

3.1. Copie o arquivo .env.example:
   ```bash
   cp .env.example .env
   ## Atualize as variáveis de ambiente no .env (ex.: configurações do banco de dados).
   ## Chave da Api do OpenWeather como OPENWEATHER_API_KEY no arquivo .env

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate

5. Inicie o servidor local:
   ```bash
   php artisan serve
   ## A API estará disponível em http://localhost:8000.

### Rodando o Frontend (React)

1. Navegue até a pasta do frontend:
   ```bash
   cd <NOME_DA_PASTA_DO_FRONTEND>

2. Instale as dependências:
   ```bash
   npm install

3. Inicie o servidor de desenvolvimento:
   ```bash
   npm start
   ## O frontend estará disponível em http://localhost:3000.

## Estrutura do Projeto
.
├── api/                 # Código-fonte da API Laravel
├── frontend/            # Código-fonte do Frontend React
├── docker-compose.yml   # Configuração do Docker Compose
├── Dockerfile           # Configuração do Docker (API Laravel)
└── README.md            # Documentação do projeto
