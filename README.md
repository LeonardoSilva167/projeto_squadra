Passo 1 - Start Repositório Laravel
    
    git clone https://github.com/LeonardoSilva167/projeto_squadra.git

Passo 2 - Start Banco de dados
    
    CREATE DATABASE projeto_squadra CHARACTER SET utf8 COLLATE utf8_general_ci;

Passo 3 - Start Terminal
    
    composer install
    composer update
    cp .env.example .env
    php artisan key:generate

Passo 4 - Alterar o arquivo .env
    
    atribua o nome da base de dados: DB_DATABASE=projeto_squadra

Passo 5 - Continuando Terminal

    php artisan migrate
    php artisan serve

Passo 6 - Acessar 

    link http://127.0.0.1:8000

    Logins de acesso
        master@squadra.com
        super@squadra.com
        admsist@squadra.com
        resp@squadra.com

    senha: 12345
