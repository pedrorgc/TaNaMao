# TáNaMão

**TáNaMão** é uma plataforma web que conecta **clientes** a **prestadores de serviços locais**, oferecendo praticidade, rapidez e acessibilidade. O objetivo é simplificar a busca por serviços do dia a dia, aproximando quem precisa de ajuda de quem pode oferecer.

## 🛠️ Tecnologias Utilizadas
- **Frontend:** [React](https://react.dev/) + [TypeScript](https://www.typescriptlang.org/) + [Vite](https://vitejs.dev/)
- **Backend:** [PHP](https://www.php.net/) com [Laravel](https://laravel.com/)
- **Banco de Dados:** [MySQL](https://www.mysql.com/)
- **Gerenciador de Pacotes (Frontend):** npm ou yarn
- **Gerenciador de Dependências (Backend):** Composer
- **Versionamento:** Git + GitHub

## 📋 Pré-requisitos
Antes de começar, certifique-se de ter instalado:
- [Git](https://git-scm.com/) (para clonar o repositório)
- [Node.js](https://nodejs.org/) (v18 ou superior) + npm (ou [Yarn](https://yarnpkg.com/))
- [PHP](https://www.php.net/) (>= 8.1)
- [Composer](https://getcomposer.org/) (para instalar dependências do Laravel)
- [MySQL](https://www.mysql.com/) (para o banco de dados)

## 📂 Estrutura de Pastas (Sugerida)
tana-mao/
├── backend/ # Código do Laravel
│ ├── app/
│ ├── bootstrap/
│ ├── config/
│ ├── database/
│ └── ...
│
├── frontend/ # Código do React + TypeScript
│ ├── src/
│ │ ├── components/
│ │ ├── pages/
│ │ └── utils/
│ ├── public/
│ └── ...
│
├── .gitignore
├── README.md
└── LICENSE


## 📦 Instalação e Configuração
Para rodar o projeto localmente, siga os passos abaixo.

### 1️⃣ Clonar o Repositório
```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
cd seu-repositorio
```

## Configuração do ambiente PHP/Laravel
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

## Rode as migrações e inicie o servidor
```bash
php artisan migrate
php artisan serve
```
O backend estará disponível em http://localhost:8000.

## Configure o frontend (React + Typescript)
```bash
cd frontend
npm install
npm run dev
```


