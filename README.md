#Bemacash Demo

Demonstração do sistema bemacash feito em Laravel e VueJs

####Instalação:

> Instalar as dependências do projeto
* composer install
* npm install
> Configurar o arquivo .env do Laravel
* APP_URL: endereço do servidor: (ex: http://localhost:8000)
* DB_HOST: endereço do banco de dados: (ex: localhost)
* DB_PORT: porta do banco de dados (ex: 3306)
* DB_DATABASE: schema do banco de dados (ex: bemacash)
* DB_USERNAME: usuário do banco de dados (ex: root)
* DB_PASSWORD: senha do banco de dados (ex: root)

> Criar o schema da aplicação no banco de dados com nome correspondente à variável DB_DATABASE


> Gerar a chave única da aplicação
* php artisan key:generate

> Criar as migrations e seeds do banco de dados
* php artisan migrate --seed

> Montar o bundle js e iniciar o servidor php
* npm run dev
* php artisan serve
