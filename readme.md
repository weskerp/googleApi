# Google Api Teste

Bem-vindo ao Google Api Teste!

## Descrição do Projeto

Este projeto utiliza o framework Laravel 5.4 e PHP 7.2 para interagir com a API do Google Maps. O objetivo é permitir que os usuários abram um mapa, selecionem um ponto e recebam as coordenadas UTM e GMS (Graus, Minutos e Segundos).

## Requisitos do Ambiente

- PHP >= 7.2
- Composer (para gerenciamento de dependências)
- Laravel 5.4

## Instalação

1. Clone o repositório para o seu ambiente local:

   ```bash 
   git clone https://github.com/seu-usuario/seu-projeto.git
2. Instale as dependências do Composer:
    ```bash
    composer install
3. Copie o arquivo .env.example para .env e configure suas credenciais da API do Google Maps:
    ```bash
    cp .env.example .env
    ```
    Adicione as credenciais necessárias no arquivo .env.
4. Gere a chave de aplicativo Laravel:
    ```bash
    php artisan key:generate
5. Execute as migrações do banco de dados (se aplicável):
    ```bash
    php artisan migrate
6. Inicie o servidor de desenvolvimento:
    ```bash
    php artisan serve
    ```
    O aplicativo estará disponível em http://localhost:8000.
## Configuração da API do Google Maps
Certifique-se de que suas credenciais da API do Google Maps estejam corretamente configuradas no arquivo .env. Caso não tenha as credenciais, você pode obtê-las aqui.
```bash
GOOGLE_MAPS_API_KEY=your-api-key
```
## Uso
1. Acesse o aplicativo em http://localhost:8000.
2. Interaja com o mapa para selecionar um ponto.
3. Receba as coordenadas UTM e GMS no formato desejado.
## Contribuições
Contribuições são bem-vindas! Sinta-se à vontade para abrir issues ou enviar pull requests para melhorar este projeto.
## Licença
Este projeto está licenciado sob a WESKERP.