# encurta-link

## Desenvolvimento com Docker

Requisitos: Docker em execução, plugin `docker compose` (2.30 ou mais recente)
e Bash. Não é necessário instalar PHP, Composer ou Node.js no host.

```bash
./encurta-link setup
./encurta-link dev
```

A aplicação fica em **http://localhost:8000**. O Vite (hot reload) usa a porta
`5173`. O worker roda em um container separado e usa a fila configurada no `.env`
(`database` por padrão). Os três serviços compartilham uma imagem de desenvolvimento.
O `dev` também sobe MySQL e phpMyAdmin.

O `setup` preserva o `.env` e a `APP_KEY` se já existirem. Ele instala as
dependências, aguarda o MySQL, aplica as migrações e compila os assets. O código e
as dependências ficam na pasta do projeto, com as permissões do usuário que
chamou o wrapper. `down` não apaga esses arquivos.
No terminal, a contagem de progresso do Composer se atualiza na mesma linha.
Em logs redirecionados ou no CI, a barra é omitida.

```bash
./encurta-link status
./encurta-link logs app worker
./encurta-link artisan migrate
./encurta-link npm run build
./encurta-link test
./encurta-link shell
./encurta-link down
```

Quando o serviço `app` está parado, comandos como `artisan`, `npm` e `test`
usam um container temporário. Se o comando precisar do banco, suba o MySQL com
`./encurta-link db`. Execute `./encurta-link help` para ver a lista completa.

Para trocar as portas, adicione `ENCURTADOR_APP_PORT` e/ou `ENCURTADOR_VITE_PORT`
ao `.env`. Se mudar a porta da aplicação, ajuste também `APP_URL`. Rode
`./encurta-link dev` para aplicar as mudanças. As portas são publicadas apenas
localmente; esta configuração não é para produção.

### MySQL e phpMyAdmin

Para subir só o MySQL e o painel, execute `./encurta-link db`. Acesse
**http://localhost:8081** e entre com o usuário `encurta` e a senha de
desenvolvimento `encurta_local`. O banco inicial é `encurta_link`. A porta do
MySQL não é publicada no host.

Os dados do MySQL ficam no volume `mysql-data` e sobrevivem a
`./encurta-link down`. Para personalizar a criação do banco, configure
`MYSQL_DATABASE`, `MYSQL_USER` e `MYSQL_PASSWORD` no `.env` antes da primeira
inicialização do volume. Para mudar a porta do painel, use
`ENCURTADOR_PHPMYADMIN_PORT`.

O Laravel usa MySQL por padrão. Se você já tinha um `.env` com SQLite, atualize-o
com os valores abaixo para usar o banco do Docker:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=encurta_link
DB_USERNAME=encurta
DB_PASSWORD=encurta_local
```

Rode `./encurta-link setup` e depois `./encurta-link dev`. O `setup` cria as
tabelas no MySQL, mas não transfere dados de um banco anterior.
