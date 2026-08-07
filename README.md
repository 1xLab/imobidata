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
3. **Corretores**: onboarding por fontes públicas de anúncios. O corretor indica onde seu estoque já está publicado e a ImobiData prepara essas fontes para indexação e cruzamento com missões compatíveis.

No contexto de corretores, o princípio é **observed inventory > declared profile**: bairros, tipologias, faixa de preço e volume de oferta devem ser inferidos dos anúncios sempre que possível, em vez de serem solicitados manualmente ao profissional.

## UX

Não existem formulários públicos tradicionais.

Todos os CTAs abrem uma interface conversacional única que pergunta uma informação por vez e envia os dados aos endpoints PHP somente ao final da conversa e após consentimento explícito.

A navegação desktop usa cenas com âncoras sem impedir a leitura de seções maiores que a viewport.

## Estrutura

```text
index.php
assets/
  css/site.css
  css/indexing.css
  css/scroll-scenes.css
  js/site.js
  js/scroll-scenes.js
api/
  mission.php
  agency.php
  broker.php
_app/
_database/
  schema.sql
  002_broker_indexing.sql
.htaccess
```

## Endpoints

- `POST /api/mission.php`
- `POST /api/agency.php`
- `POST /api/broker.php`

`broker.php` recebe até 10 URLs públicas indicadas pelo corretor e cria uma solicitação de indexação com uma linha independente por fonte.

A indicação de uma URL não significa garantia de coleta. A indexação efetiva depende da disponibilidade técnica e das políticas de acesso da fonte.

## Banco

Fluxo de corretores:

```text
broker_index_requests
    ↓ 1:N
broker_listing_sources
```

Cada fonte possui status próprio para futura fila de crawling/indexação (`pending`, processamento, erro, indexado etc.).

## Princípios

- premium editorial, não SaaS dashboard;
- preto, marfim e dourado;
- demanda antes da oferta;
- conversa antes de cadastro;
- comprador, imobiliária e corretor não compartilham o mesmo funil;
- corretor não recadastra estoque já publicado;
- fontes públicas viram matéria-prima para indexação;
- sem catálogo público;
- sem filtros tradicionais;
- sem formulário estático;
- camada visual independente do motor de mineração.

As áreas `_app` e `_database` são protegidas no Apache e não devem ser servidas publicamente.