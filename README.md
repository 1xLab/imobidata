# ImobiData

Landing page comercial premium da **ImobiData**, uma iniciativa da **Megaweb Solutions**.

## Posicionamento

A ImobiData organiza o mercado imobiliário a partir da demanda. O visitante descreve o imóvel que procura, a plataforma estrutura uma Missão ImobiData e prepara essa demanda para pesquisa e priorização sobre a base imobiliária.

A relação comercial com a oferta é dividida em dois contextos independentes:

- **Imobiliárias**: organizações, equipes, carteira, cobertura territorial, distribuição e integração.
- **Corretores**: profissionais individuais, território, especialidade, faixa de preço e colaboração.

Não existe mais um funil genérico de “parceiros”.

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
  agency.php
  broker.php
_app/
_database/
.htaccess
```

## Captura

- `POST /api/mission.php` → comprador / investidor / locatário
- `POST /api/agency.php` → imobiliária / operação institucional
- `POST /api/broker.php` → corretor / perfil profissional individual

## Princípios do MVP

- landing first;
- experiência premium;
- missão antes de cadastro;
- demanda antes de oferta;
- sem catálogo público;
- sem filtros tradicionais;
- imobiliárias e corretores tratados como contextos comerciais distintos;
- camada visual separada do motor de mineração.

As áreas `_app` e `_database` são protegidas no Apache e não devem ser servidas publicamente.
