<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="#080806">
  <meta name="description" content="A ImobiData é uma plataforma de inteligência imobiliária com ciência de dados. Pesquisa anúncios publicados em diferentes fontes e organiza as opções mais compatíveis com cada busca.">
  <meta property="og:title" content="ImobiData | Inteligência imobiliária com ciência de dados">
  <meta property="og:description" content="Descreva o imóvel que procura. A ImobiData pesquisa diferentes fontes do mercado e organiza as ofertas mais compatíveis com a sua busca.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://imobidata.com.br/">
  <title>ImobiData | Inteligência imobiliária com ciência de dados</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/site.css?v=4">
  <link rel="stylesheet" href="/assets/css/scroll-scenes.css?v=1">
  <link rel="stylesheet" href="/assets/css/indexing.css?v=1">
  <link rel="stylesheet" href="/assets/css/metric.css?v=1">
  <link rel="stylesheet" href="/assets/css/review-fixes.css?v=1">
</head>
<body>
<div class="site" id="top">
  <header class="header" data-header>
    <a class="brand" href="#top" aria-label="ImobiData, início"><span>IMOBI</span><b>DATA</b></a>
    <nav class="nav" aria-label="Navegação principal">
      <a href="#conceito">Como funciona</a>
      <a href="#inteligencia">O que é analisado</a>
      <a href="#imobiliarias">Imobiliárias</a>
      <a href="#corretores">Corretores</a>
    </nav>
    <button class="header-cta" type="button" data-flow="mission">Criar missão</button>
  </header>

  <main>
    <section class="hero" data-snap="hero">
      <div class="hero-noise" aria-hidden="true"></div>
      <div class="hero-meta reveal"><span>INTELIGÊNCIA IMOBILIÁRIA COM CIÊNCIA DE DADOS</span><span>JOINVILLE · SC</span></div>
      <div class="hero-grid">
        <div class="hero-copy reveal">
          <p class="eyebrow">IMOBIDATA</p>
          <h1>Descreva o imóvel.<br><em>A ImobiData pesquisa o mercado.</em></h1>
          <p class="hero-lead">A ImobiData usa ciência de dados para organizar informações de anúncios, histórico de mercado e critérios de busca. Em vez de começar por um catálogo, a pesquisa começa pelo imóvel que a pessoa procura e compara essa necessidade com ofertas publicadas em diferentes fontes.</p>
          <div class="hero-actions">
            <button class="gold-button" type="button" data-flow="mission">Criar uma missão <span>↗</span></button>
            <a class="quiet-link" href="#conceito">Entender como funciona <span>↓</span></a>
          </div>
        </div>
        <div class="hero-object reveal" aria-label="15 milhões de imóveis mapeados">
          <div class="object-frame">
            <span class="object-label">BASE MAPEADA</span>
            <div class="object-volume">
              <strong>15</strong>
              <span>MILHÕES</span>
              <p>de imóveis mapeados</p>
            </div>
            <div class="object-lines" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i></div>
            <div class="object-bottom"><span>ANÚNCIOS</span><span>HISTÓRICO</span><span>DEMANDA</span></div>
          </div>
        </div>
      </div>
      <div class="hero-foot reveal"><span>COMO A BUSCA MUDA</span><p>A mesma missão pode ser comparada com anúncios publicados em vários sites, perfis de corretores e imobiliárias.</p></div>
    </section>

    <section class="concept" id="conceito" data-snap="conceito">
      <div class="concept-index reveal">01 / COMO FUNCIONA</div>
      <div class="concept-copy reveal">
        <h2>Primeiro são definidos<br><span>os critérios da busca.</span></h2>
        <h2 class="concept-answer">Depois são pesquisados<br><em>os imóveis compatíveis.</em></h2>
      </div>
      <div class="concept-note reveal">
        <p>Nos portais tradicionais, a pessoa abre um estoque de anúncios e aplica filtros dentro daquele site. A busca fica limitada ao que está publicado ali e à forma como aquele portal organizou os imóveis.</p>
        <p>Na ImobiData, a necessidade é registrada primeiro. Localização, orçamento, número de quartos, vagas, prazo, preferências e restrições formam uma Missão ImobiData. Essa mesma missão pode então ser usada para pesquisar e comparar ofertas encontradas em diferentes fontes.</p>
      </div>
    </section>

    <section class="mission-callout" data-snap="missao">
      <div class="mission-callout-copy reveal">
        <p class="eyebrow">MISSÃO IMOBIDATA</p>
        <h2>Explique o que está procurando<br><em>do jeito que explicaria a uma pessoa.</em></h2>
        <p>Não é necessário preencher uma sequência de filtros. Basta descrever a necessidade com as informações importantes. Por exemplo: “Procuro apartamento na cidade XXX, no país XXX, de preferência no bairro YYY, até R$ 900 mil, com três quartos, duas vagas e sem interesse em unidades térreas”.</p>
      </div>
      <button class="mission-launch reveal" type="button" data-flow="mission">
        <span>CRIAR MISSÃO</span><b>→</b>
      </button>
    </section>

    <section class="intelligence" id="inteligencia" data-snap="inteligencia">
      <div class="section-head reveal">
        <span>02 / O QUE É ANALISADO</span>
        <h2>A ImobiData não compara apenas anúncios.<br><em>Procura entender o imóvel por trás deles.</em></h2>
      </div>
      <div class="signal-grid reveal">
        <article><span>01</span><h3>O mesmo imóvel em vários anúncios</h3><p>Um imóvel pode aparecer em mais de um portal, em perfis diferentes e até com preços ou descrições diferentes. A ImobiData procura identificar quando anúncios distintos se referem ao mesmo imóvel para evitar que repetições sejam tratadas como opções novas.</p></article>
        <article><span>02</span><h3>Alterações ao longo do tempo</h3><p>Quando os dados estão disponíveis, a análise pode considerar mudanças de preço, republicações e tempo de exposição. Isso ajuda a entender se uma oferta acabou de entrar no mercado, se já foi anunciada antes ou se sofreu alterações relevantes.</p></article>
        <article><span>03</span><h3>Compatibilidade com a missão</h3><p>Cada oferta encontrada é comparada com os critérios informados na missão. O objetivo é separar o que realmente atende à necessidade do que apenas aparece porque possui algumas características em comum.</p></article>
      </div>
      <div class="intelligence-statement reveal"><span>RESULTADO ESPERADO</span><blockquote>Reduzir uma pesquisa espalhada em muitos anúncios<br><em>a um conjunto menor de imóveis que realmente merece ser analisado.</em></blockquote></div>
    </section>

    <section class="agency" id="imobiliarias" data-snap="imobiliarias">
      <div class="audience-number reveal">03</div>
      <div class="audience-copy reveal">
        <p class="eyebrow">IMOBILIÁRIAS</p>
        <h2>A ImobiData pode levar uma demanda<br><em>até a imobiliária que possui a oferta adequada.</em></h2>
        <p>A relação com imobiliárias é institucional. A ImobiData registra a região atendida, o porte da operação e o interesse em receber demandas ou avaliar uma integração futura. Quando houver aderência, a imobiliária pode participar do atendimento com os imóveis da própria carteira.</p>
      </div>
      <div class="audience-side reveal">
        <div class="audience-list">
          <span>DEMANDAS COMPATÍVEIS COM A CARTEIRA</span>
          <span>CONTATO COM A OPERAÇÃO RESPONSÁVEL</span>
          <span>POSSIBILIDADE DE INTEGRAÇÃO FUTURA</span>
        </div>
        <button class="outline-button" type="button" data-flow="agency">Cadastrar imobiliária <b>↗</b></button>
      </div>
    </section>

    <section class="broker broker-indexing" id="corretores" data-snap="corretores">
      <div class="index-source-visual reveal" aria-label="Fontes públicas de anúncios para indexação">
        <span class="index-source-kicker">FONTES DE ANÚNCIOS</span>
        <div class="source-stack">
          <span>portal.com.br/corretor/seu-perfil</span>
          <span>imobiliaria.com.br/corretor/seu-nome</span>
          <span>seusite.com.br/imoveis</span>
        </div>
        <div class="index-source-foot"><span>FONTE</span><span>ANÚNCIOS</span><span>MISSÕES</span></div>
      </div>
      <div class="broker-copy reveal">
        <p class="eyebrow">CORRETORES</p>
        <h2>O corretor informa onde anuncia.<br><em>A ImobiData procura os imóveis nessas fontes.</em></h2>
        <p>Não é necessário cadastrar novamente cada imóvel. O corretor pode informar o endereço do próprio site, a página do seu perfil em um portal ou a página em que seus imóveis aparecem no site da imobiliária. A ImobiData registra essas fontes e, quando a coleta for tecnicamente possível, identifica os anúncios vinculados ao profissional.</p>
        <button class="dark-button" type="button" data-flow="broker">Indicar onde anuncio <span>↗</span></button>
        <p class="indexing-disclaimer">A indicação de uma página não garante que a coleta será possível. Cada fonte é analisada de acordo com sua disponibilidade técnica e suas condições de acesso.</p>
      </div>
      <div class="broker-note reveal">
        <span>O QUE A INDEXAÇÃO PERMITE</span>
        <strong>Relacionar a oferta já publicada às missões dos clientes.</strong>
        <p>Depois que os anúncios são identificados, a ImobiData pode reconhecer localização, tipo de imóvel, faixa de preço e outras características diretamente nas ofertas publicadas. Quando uma missão for compatível, a plataforma consegue localizar o anúncio e o profissional responsável por ele.</p>
      </div>
    </section>

    <section class="closing reveal" data-snap="fechamento">
      <p class="eyebrow">PARA QUEM PROCURA UM IMÓVEL</p>
      <h2>Descreva a necessidade uma vez.<br><em>A pesquisa começa a partir dela.</em></h2>
      <button class="gold-button" type="button" data-flow="mission">Criar uma missão <span>→</span></button>
    </section>
  </main>

  <footer class="footer">
    <div><a class="brand footer-brand" href="#top"><span>IMOBI</span><b>DATA</b></a><p>Inteligência imobiliária com ciência de dados.</p></div>
    <div class="footer-company"><span>IMOBIDATA</span><strong>INTELIGÊNCIA IMOBILIÁRIA</strong><small>Joinville · Santa Catarina</small></div>
    <p class="footer-legal">A ImobiData é uma plataforma de inteligência imobiliária baseada em ciência de dados. A plataforma pesquisa, organiza e relaciona informações de anúncios, histórico de mercado e demandas de clientes. Quando houver atividade de intermediação imobiliária, ela será realizada separadamente por profissional ou empresa legalmente habilitados.</p>
    <div class="footer-bottom"><span>© <?= date('Y') ?> ImobiData. Todos os direitos reservados.</span><a href="#top">Voltar ao topo ↑</a></div>
  </footer>
</div>

<div class="concierge" id="concierge" hidden aria-hidden="true">
  <div class="concierge-backdrop" data-close-concierge></div>
  <section class="concierge-panel" role="dialog" aria-modal="true" aria-labelledby="conciergeTitle">
    <header class="concierge-header">
      <div><span class="concierge-brand">IMOBI<b>DATA</b></span><small id="conciergeContext">MISSÃO</small></div>
      <button type="button" class="concierge-close" data-close-concierge aria-label="Fechar">×</button>
    </header>
    <div class="concierge-progress"><i id="conciergeProgress"></i></div>
    <div class="conversation" id="conversation" aria-live="polite"></div>
    <div class="quick-replies" id="quickReplies"></div>
    <div class="composer" id="composer">
      <textarea id="composerInput" rows="1" maxlength="2200" placeholder="Escreva aqui..."></textarea>
      <button type="button" id="composerSend" aria-label="Enviar">→</button>
    </div>
    <div class="concierge-foot"><span>Conversa privada</span><span id="conciergeStep">01 / 01</span></div>
  </section>
</div>

<script src="/assets/js/site.js?v=7" defer></script>
<script src="/assets/js/scroll-scenes.js?v=1" defer></script>
</body>
</html>