# ImobiData

Landing page comercial premium da **ImobiData**, uma iniciativa da **Megaweb Solutions**.

## Produção

- Host: `147.93.183.134`
- Usuário: `idata`
- DocumentRoot: `/home/idata/public_html`
- Stack: Apache + PHP 8.3 + MariaDB

## Direção de produto

A ImobiData não é um portal de imóveis e não começa pelo estoque. A experiência começa pela demanda.

A landing possui três contextos comerciais independentes:

1. **Missão ImobiData**: comprador, investidor ou locatário descreve o que procura.
2. **Imobiliárias**: relação institucional com carteira, equipe, cobertura, distribuição e integração.
3. **Corretores**: relação profissional individual baseada em praça, especialidade, faixa de preço e capacidade de colaboração.

## UX

Não existem formulários públicos tradicionais.

Todos os CTAs abrem uma interface conversacional única que pergunta uma informação por vez e envia os dados aos endpoints PHP existentes somente ao final da conversa e após consentimento explícito.

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

## Endpoints

- `POST /api/mission.php`
- `POST /api/agency.php`
- `POST /api/broker.php`

## Princípios

- premium editorial, não SaaS dashboard;
- preto, marfim e dourado;
- demanda antes da oferta;
- conversa antes de cadastro;
- comprador, imobiliária e corretor não compartilham o mesmo funil;
- sem catálogo público;
- sem filtros tradicionais;
- sem formulário estático;
- camada visual independente do motor de mineração.

As áreas `_app` e `_database` são protegidas no Apache e não devem ser servidas publicamente.