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

### 1️⃣ Clonar o Repositório
```bash
git clone https://github.com/pedrorgc/TaNaMao.git
cd TaNaMao
```

## Configuração do ambiente PHP/Laravel e Frontend
```bash
composer install
cp .env.example .env
php artisan key:generate
npm install

```
## Rode a aplicação
```bash
composer run dev
```



