# Projeto Laravel e Vue.js com Docker

Este projeto é uma aplicação web utilizando Laravel no backend e Vue.js no frontend, configurada para rodar em contêineres Docker.
Utilizado para realizar um teste técnico para a empresa tray, onde busquei utilizar todo o meu conhecimento sobre o framework laravel no backend, trazendo as melhores tecnicas de desenvolvimento como SOLID e alguns Design Patterns.

## Estrutura do Projeto

- `backend/`: Contém o código do backend desenvolvido em Laravel.
- `frontend/`: Contém o código do frontend desenvolvido em Vue.js.

## Pré-requisitos

- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Configuração

### 1. Clonar o repositório

```sh
git clone https://github.com/erickcordeiroa/test-tray.git
cd test-tray
```

### 2. Configurar variáveis de ambiente (backend)
```sh
cd backend/
cp .env.example .env
```
**Obs: Enviarei o env no corpo do e-mail com credenciais a serem utilizados**


### 4. Construir e iniciar o container backend
```sh
docker-compose up -d --build
```

### 5. Instalar dependências do Laravel
```sh
docker exec -it tray-test bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 6. Construir e iniciar o frontend
```sh
cd frontend/
npm install
npm run dev
```

### 6. URL para acessar o sistema
```sh
http://localhost:5173/login
```

### 7. Rodar a fila para enviar o e-mail
```sh
docker exec -it tray-test bash
php artisan queue:work
```

