# ImobiData

Landing page comercial da **ImobiData**.

## Produção

- Host: `147.93.183.134`
- Usuário: `idata`
- DocumentRoot: `/home/idata/public_html`
- Stack: Apache + PHP 8.3 + MariaDB

## Direção de produto

A ImobiData pesquisa o mercado imobiliário a partir da necessidade de quem procura um imóvel.

A landing possui três contextos comerciais independentes:

1. **Missão ImobiData**: comprador, investidor ou locatário descreve o imóvel procurado e a plataforma registra os critérios da busca.
2. **Imobiliárias**: cadastro institucional para receber demandas compatíveis e avaliar integrações futuras com a operação.
3. **Corretores**: indicação das páginas públicas em que os imóveis já são anunciados. A ImobiData registra essas fontes para posterior análise, indexação e cruzamento com missões compatíveis.

No contexto de corretores, localização, tipologia, faixa de preço e volume de oferta devem ser obtidos dos anúncios encontrados sempre que possível. O objetivo é evitar que o profissional tenha de recadastrar manualmente informações que já estão publicadas.

## UX

Não existem formulários públicos tradicionais.

Os CTAs abrem uma interface conversacional que solicita uma informação por vez e envia os dados aos endpoints PHP somente ao final da conversa e após consentimento explícito.

A navegação desktop utiliza cenas com pontos de parada definidos. Se uma seção for maior que a área visível, a rolagem permanece livre dentro dela até que o conteúdo seja percorrido.

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

`broker.php` recebe até 10 URLs públicas indicadas pelo corretor e cria uma solicitação de indexação com uma linha independente para cada fonte.

A indicação de uma URL não significa garantia de coleta. A indexação efetiva depende da disponibilidade técnica e das condições de acesso de cada fonte.

## Banco

Fluxo de corretores:

```text
broker_index_requests
    ↓ 1:N
broker_listing_sources
```

Cada fonte possui status próprio para futura fila de processamento e indexação.

## Princípios

- português brasileiro claro e direto;
- texto institucional em terceira pessoa;
- segunda pessoa apenas nas ações e perguntas da interface;
- preto, marfim e dourado;
- demanda antes da pesquisa da oferta;
- conversa antes do cadastro;
- comprador, imobiliária e corretor possuem jornadas diferentes;
- corretor não recadastra estoque já publicado;
- sem catálogo público;
- sem filtros tradicionais;
- sem formulário estático;
- camada visual independente do motor de mineração.

As áreas `_app` e `_database` são protegidas no Apache e não devem ser servidas publicamente.