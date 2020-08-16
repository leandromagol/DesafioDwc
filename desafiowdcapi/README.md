Crie seu .env 
Adicione suas credencias do banco de dados e de smtp 
Adicione no .env a variavel CLIENT_URL com a url da aplicação client

rode as migrations para criar as tableas do banco 
Rode php artisan queue:work para que o sistema rode a fila de envio de emails
