# TáNaMão

**TáNaMão** é uma plataforma web que conecta **clientes** a **prestadores de serviços locais**, oferecendo praticidade, rapidez e acessibilidade. O objetivo é simplificar a busca por serviços do dia a dia, aproximando quem precisa de ajuda de quem pode oferecer.

## 🛠️ Tecnologias Utilizadas
- **Frontend:** [React](https://react.dev/) + [TypeScript](https://www.typescriptlang.org/) + [Vite](https://vitejs.dev/)
- **Backend:** [PHP](https://www.php.net/) com [Laravel 12](https://laravel.com/)
- **Banco de Dados:** [MySQL](https://www.mysql.com/)
- **Gerenciador de Pacotes (Frontend):** npm ou yarn
- **Gerenciador de Dependências (Backend):** Composer
- **Versionamento:** Git + GitHub

## 📋 Pré-requisitos
Certifique-se de ter instalado:
- [Git](https://git-scm.com/)
- [Node.js](https://nodejs.org/) (v18 ou superior) + npm (ou [Yarn](https://yarnpkg.com/))
- [PHP](https://www.php.net/) (>= 8.1)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/) - Opcional até o momento

## 📦 Instalação e Configuração
Para rodar o projeto localmente, siga os passos abaixo.

## Clonar o Repositório
```bash
git clone https://github.com/pedrorgc/TaNaMao.git
cd TaNaMao
```

## Instalar Dependências
```bash
composer install   # Backend
npm install        # Frontend

## Configurar o Ambiente
```bash
cp .env.example .env
php artisan key:generate

####  Usando MySQL  (opicional)
Edite o .env para colocar os dados do seu banco:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=TaNaMao
DB_USERNAME=root
DB_PASSWORD=SuaSenha

php artisan key:generate

Crie o banco de dados (caso ainda não exista):

 CREATE DATABASE TaNaMao CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
----------------------------------------------------------------
####  Usando SQLite (mais simples)
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/para/seu/projeto/database/database.sqlite

#Crie o arquivo do banco:

touch database/database.sqlite

## Limpar Cache e Configurações
```bash

php artisan config:clear
php artisan cache:clear
composer dump-autoload

#### Rodar Migrations e Seeders 
```bash

php artisan migrate:fresh --seed

php artisan config:clear
php artisan cache:clear

php artisan migrate --seed
```
## Rode a aplicação
```bash
php artisan serve #backend
npm run dev #frontend

composer run dev #ambos
```



