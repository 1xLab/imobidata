# ImobiData Landing

Landing page comercial da ImobiData, preparada para hospedagem tradicional CWP/Apache/PHP 8.3.

## Estrutura

- `index.php` — landing principal
- `assets/` — CSS e JavaScript
- `api/` — captura de missões e parceiros
- `_app/` — bootstrap e configuração privada bloqueada pelo Apache
- `_database/` — schema MariaDB bloqueado pelo Apache
- `.htaccess` — HTTPS, hardening e proteção das pastas privadas

## Servidor alvo

- host: `147.93.183.134`
- usuário: `idata`
- document root: `/home/idata/public_html`
- PHP: 8.3 FPM
- MariaDB: 10.5+

## Deploy direto

Clone o repositório diretamente em `/home/idata/public_html` ou sincronize seu conteúdo para esse diretório.

1. Crie o banco e o usuário MariaDB pelo CWP.
2. Importe `_database/schema.sql`.
3. Copie `_app/config.example.php` para `_app/config.php`.
4. Preencha as credenciais reais.
5. Garanta `644` nos arquivos e `755` nos diretórios.
6. Ative SSL do domínio.
7. Teste `/`, `/api/mission.php` e `/api/partner.php`.

`_app/config.php` está no `.gitignore` e não deve ser versionado.
