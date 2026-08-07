# ImobiData

Landing page comercial premium da **ImobiData**, uma iniciativa da **Megaweb Solutions**.

## Posicionamento

A ImobiData organiza o mercado imobiliário a partir da demanda. O visitante descreve o imóvel que procura, a plataforma estrutura uma Missão ImobiData e prepara essa demanda para pesquisa e priorização sobre a base imobiliária.

## Produção

- Host: `147.93.183.134`
- Usuário: `idata`
- DocumentRoot: `/home/idata/public_html`
- Stack: Apache + PHP 8.3 + MariaDB
- Empresa: Megaweb Solutions

## Estrutura

```text
index.php
assets/
  css/site.css
  js/site.js
api/
  mission.php
  partner.php
_app/
_database/
.htaccess
```

## Princípios do MVP

- landing first;
- experiência premium;
- missão antes de cadastro;
- demanda antes de oferta;
- sem catálogo público;
- sem filtros tradicionais;
- captura de compradores e parceiros B2B;
- camada visual separada do motor de mineração.

As áreas `_app` e `_database` são protegidas no Apache e não devem ser servidas publicamente.
