# Projeto Laravel e Vue.js com Docker

Este projeto é uma aplicação web utilizando Laravel no backend e Vue.js no frontend, configurada para rodar em contêineres Docker.

## Estrutura do Projeto

- `backend/`: Contém o código do backend desenvolvido em Laravel.
- `frontend/`: Contém o código do frontend desenvolvido em Vue.js.
- `docker-compose.yml`: Arquivo de configuração do Docker Compose para orquestrar os contêineres.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Configuração

### 1. Clonar o repositório

```sh
git clone https://github.com/erickcordeiroa/test-tray.git
cd test-tray
```

### 2. Configurar variáveis de ambiente
```sh
cp backend/.env.example backend/.env
```

### 3. Inserir as configurações do Google no env

*Informações enviadas no e-mail*

### 4. Construir e iniciar os contêineres
```sh
docker-compose up --build
```

### 5. Instalar dependências do Laravel
```sh
docker-compose exec backend bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```



