# Projeto Laravel e Vue.js com Docker

Este projeto é uma aplicação web utilizando Laravel no backend e Vue.js no frontend, configurada para rodar em contêineres Docker.
Utilizado para realizar um teste técnico para a empresa tray, onde busquei utilizar todo o meu conhecimento sobre o framework laravel no backend, trazendo as melhores tecnicas de desenvolvimento como SOLID e alguns Design Patterns.

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
docker-compose up -d --build
```

### 5. Instalar dependências do Laravel
```sh
docker exec -it backend bash
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed
```


### 6. URL para acessar o sistema
```sh
http://localhost:5173/login
```

### 7. Rodar a fila para enviar o e-mail
```sh
docker exec -it backend bash
php artisan queue:work
```

