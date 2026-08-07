<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#f4f1eb">
  <meta name="description" content="ImobiData organiza o mercado imobiliário a partir de quem procura. Descreva sua missão e transforme milhões de ofertas em poucas decisões relevantes.">
  <meta property="og:title" content="ImobiData | O mercado pesquisado por você">
  <meta property="og:description" content="Você descreve o que procura. A ImobiData cruza o mercado e prioriza o que realmente merece atenção.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://imobidata.com.br/">
  <title>ImobiData | O mercado pesquisado por você</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/site.css?v=1">
</head>
<body>
  <div class="page-shell" id="top">
    <header class="header" data-header>
      <a class="brand" href="#top" aria-label="ImobiData, início">
        <span class="brand-dot" aria-hidden="true"></span>
        <span>IMOBIDATA</span>
      </a>
      <nav class="nav" aria-label="Navegação principal">
        <a href="#como">Como funciona</a>
        <a href="#dados">Nossa vantagem</a>
        <a href="#parceiros">Imobiliárias</a>
      </nav>
      <a class="header-cta" href="#missao">Criar missão</a>
    </header>

    <main>
      <section class="hero section-pad">
        <div class="hero-kicker reveal">REAL ESTATE INTELLIGENCE · JOINVILLE</div>
        <div class="hero-grid">
          <div class="hero-copy reveal">
            <h1>O mercado inteiro.<br><em>Uma busca que entende você.</em></h1>
            <p class="hero-lead">Você descreve o imóvel ideal em linguagem natural. A ImobiData organiza a demanda, cruza milhões de ofertas e reduz o mercado ao que realmente merece sua atenção.</p>
            <div class="hero-actions">
              <a class="button button-dark" href="#missao">Criar minha missão <span>↗</span></a>
              <a class="text-link" href="#como">Entender a lógica <span>↓</span></a>
            </div>
          </div>

          <aside class="hero-panel reveal" aria-label="Visão da plataforma">
            <div class="hero-panel-top">
              <span class="micro">IMOBIDATA / DEMAND SIGNAL</span>
              <span class="signal"><i></i> live market context</span>
            </div>
            <div class="market-orbit" aria-hidden="true">
              <div class="orbit orbit-a"></div>
              <div class="orbit orbit-b"></div>
              <div class="orbit orbit-c"></div>
              <div class="orbit-core">3M+</div>
              <span class="orbit-label l1">ofertas</span>
              <span class="orbit-label l2">histórico</span>
              <span class="orbit-label l3">demanda</span>
              <span class="orbit-label l4">contexto</span>
            </div>
            <div class="hero-panel-bottom">
              <div><strong>3M+</strong><span>anúncios mapeados</span></div>
              <div><strong>1</strong><span>missão estruturada</span></div>
              <div><strong>0</strong><span>catálogos para garimpar</span></div>
            </div>
          </aside>
        </div>
      </section>

      <section class="manifesto-band" aria-label="Manifesto">
        <div class="marquee" aria-hidden="true">
          <span>PORTAIS COMEÇAM PELO IMÓVEL · IMOBIDATA COMEÇA PELA DEMANDA · </span>
          <span>PORTAIS COMEÇAM PELO IMÓVEL · IMOBIDATA COMEÇA PELA DEMANDA · </span>
        </div>
      </section>

      <section class="mission-section section-pad" id="missao">
        <div class="section-heading reveal">
          <span class="section-index">01</span>
          <div>
            <p class="eyebrow">MISSÃO IMOBIDATA</p>
            <h2>Não filtre o mercado.<br><em>Explique o que você quer.</em></h2>
          </div>
        </div>

        <div class="mission-layout">
          <div class="mission-copy reveal">
            <p>Preço, bairros, estilo, prazo, restrições, o que é obrigatório e o que você aceita negociar. Uma missão consegue carregar nuances que filtros tradicionais perdem.</p>
            <ul class="plain-list">
              <li><span>01</span> descreva como falaria com uma pessoa;</li>
              <li><span>02</span> a busca vira uma demanda estruturada;</li>
              <li><span>03</span> o mercado passa a trabalhar para essa demanda.</li>
            </ul>
          </div>

          <div class="mission-card reveal">
            <div class="mission-card-head">
              <span>NOVA MISSÃO</span>
              <span class="step-indicator"><b data-step="1">01</b> / 02</span>
            </div>

            <form id="missionForm" class="mission-form" autocomplete="on" novalidate>
              <div class="form-step" data-form-step="1">
                <label class="prompt" for="missionText">Qual imóvel faria sentido para você agora?</label>
                <textarea id="missionText" name="mission" rows="6" maxlength="2200" required placeholder="Ex.: Quero comprar um apartamento em Joinville, de preferência América ou Atiradores, até R$ 950 mil, 3 quartos, duas vagas, prédio mais novo e sem térreo."></textarea>
                <div class="examples" aria-label="Exemplos">
                  <button type="button" data-example="Quero comprar um apartamento em Joinville até R$ 700 mil, 3 quartos e 2 vagas, perto do centro e em prédio mais recente.">Compra</button>
                  <button type="button" data-example="Procuro imóvel para investir em Joinville até R$ 550 mil, com boa liquidez e potencial de renda.">Investimento</button>
                  <button type="button" data-example="Quero alugar apartamento em Joinville, 2 quartos, 1 vaga, até R$ 3.500 por mês e que aceite pet.">Locação</button>
                </div>
                <div class="form-footer">
                  <small>Sem cadastro antes de você explicar a busca.</small>
                  <button class="button button-accent" type="submit">Continuar <span>→</span></button>
                </div>
              </div>
            </form>

            <form id="contactForm" class="contact-form is-hidden" autocomplete="on" novalidate>
              <div class="form-step">
                <div class="mission-recap">
                  <span>SUA MISSÃO</span>
                  <p id="missionPreview"></p>
                </div>
                <label class="prompt">Onde a ImobiData pode continuar essa busca?</label>
                <div class="fields">
                  <label><span>Nome</span><input name="name" maxlength="120" autocomplete="name" required></label>
                  <label><span>WhatsApp</span><input name="whatsapp" maxlength="40" autocomplete="tel" inputmode="tel" required placeholder="(47) 99999-9999"></label>
                  <label class="wide"><span>E-mail <em>opcional</em></span><input name="email" maxlength="180" autocomplete="email" type="email"></label>
                </div>
                <label class="consent"><input type="checkbox" name="consent" value="1" required><span>Autorizo o contato da ImobiData exclusivamente sobre esta missão e oportunidades relacionadas.</span></label>
                <div class="form-footer">
                  <button class="text-button" type="button" id="editMission">← editar missão</button>
                  <button class="button button-accent" type="submit">Ativar missão <span>→</span></button>
                </div>
                <p id="missionStatus" class="form-status" aria-live="polite"></p>
              </div>
            </form>

            <div id="missionSuccess" class="success-panel is-hidden" aria-live="polite">
              <span class="success-kicker">MISSÃO ATIVADA</span>
              <h3>Agora existe uma busca com contexto.</h3>
              <p>Recebemos sua necessidade. O próximo passo é transformar essa demanda em opções que realmente justifiquem atenção.</p>
              <button class="text-button" type="button" id="newMission">Criar outra missão →</button>
            </div>
          </div>
        </div>
      </section>

      <section class="logic-section section-pad" id="como">
        <div class="section-heading reveal">
          <span class="section-index">02</span>
          <div>
            <p class="eyebrow">OUTRA LÓGICA</p>
            <h2>Menos vitrine.<br><em>Mais inteligência de decisão.</em></h2>
          </div>
        </div>

        <div class="logic-grid reveal">
          <article class="logic-card large">
            <span class="logic-number">01</span>
            <h3>Demanda antes da oferta.</h3>
            <p>O ponto de partida é a necessidade real do comprador, locatário ou investidor. Não o estoque de uma única empresa.</p>
            <div class="logic-visual demand-visual">
              <div>você</div><i></i><span>missão</span><i></i><strong>mercado</strong>
            </div>
          </article>
          <article class="logic-card">
            <span class="logic-number">02</span>
            <h3>Ruído deixa de parecer escolha.</h3>
            <p>Duplicidades, republicações, ofertas incompatíveis e informação dispersa passam a ser contexto, não trabalho manual.</p>
          </article>
          <article class="logic-card inverted">
            <span class="logic-number">03</span>
            <h3>Poucas opções. Com motivo.</h3>
            <p>O objetivo não é entregar 300 cards. É mostrar o que merece tempo, investigação e próximo passo.</p>
          </article>
        </div>
      </section>

      <section class="data-section section-pad" id="dados">
        <div class="data-hero reveal">
          <p class="eyebrow">THE DATA ADVANTAGE</p>
          <h2>Um anúncio é um instante.<br><em>Dados revelam a trajetória.</em></h2>
          <p>Quando diferentes fontes, preços, aparições e sinais são relacionados ao longo do tempo, o anúncio deixa de ser a resposta e passa a ser apenas uma peça.</p>
        </div>

        <div class="data-grid reveal">
          <div class="data-metric"><strong>3M+</strong><span>registros imobiliários mapeados</span></div>
          <div class="data-metric"><strong>multi-source</strong><span>o mercado não cabe em uma única vitrine</span></div>
          <div class="data-metric"><strong>history</strong><span>o que mudou importa tanto quanto o que aparece hoje</span></div>
          <div class="data-metric"><strong>demand graph</strong><span>o que as pessoas procuram vira sinal de mercado</span></div>
        </div>
      </section>

      <section class="partner-section section-pad" id="parceiros">
        <div class="partner-grid">
          <div class="partner-copy reveal">
            <p class="eyebrow">PARA IMOBILIÁRIAS</p>
            <h2>Não precisamos do seu catálogo.<br><em>Precisamos saber quando sua oferta resolve uma demanda.</em></h2>
            <p>A ImobiData pode aproximar missões estruturadas de imobiliárias e profissionais com oferta compatível. A conversa começa com contexto, não com um lead genérico.</p>
            <div class="partner-points">
              <span>demanda qualificada</span>
              <span>compatibilidade primeiro</span>
              <span>colaboração aberta</span>
            </div>
          </div>

          <form id="partnerForm" class="partner-form reveal" novalidate>
            <div class="partner-form-head">
              <span>PARTNER SIGNAL</span>
              <h3>Quero receber demandas compatíveis.</h3>
            </div>
            <label><span>Imobiliária / empresa</span><input name="company" maxlength="160" required></label>
            <label><span>Responsável</span><input name="name" maxlength="120" required></label>
            <label><span>WhatsApp</span><input name="whatsapp" maxlength="40" inputmode="tel" required></label>
            <label><span>Região de atuação</span><input name="region" maxlength="180" required placeholder="Ex.: Joinville e região"></label>
            <label><span>Perfil de oferta <em>opcional</em></span><textarea name="profile" rows="3" maxlength="600" placeholder="Ex.: médio e alto padrão, apartamentos, América, Atiradores..."></textarea></label>
            <label class="consent"><input type="checkbox" name="consent" value="1" required><span>Autorizo contato da ImobiData sobre oportunidades de parceria.</span></label>
            <button class="button button-light" type="submit">Entrar no radar <span>↗</span></button>
            <p id="partnerStatus" class="form-status" aria-live="polite"></p>
          </form>
        </div>
      </section>

      <section class="closing-section section-pad reveal">
        <div class="closing-copy">
          <p class="eyebrow">IMOBIDATA</p>
          <h2>O imóvel certo pode já estar no mercado.<br><em>O problema é encontrá-lo com contexto.</em></h2>
        </div>
        <a class="button button-accent" href="#missao">Criar minha missão <span>→</span></a>
      </section>
    </main>

    <footer class="footer">
      <div class="footer-main">
        <a class="brand brand-footer" href="#top"><span class="brand-dot"></span><span>IMOBIDATA</span></a>
        <p>Inteligência de dados aplicada ao mercado imobiliário.</p>
      </div>
      <div class="footer-meta">
        <span>Joinville · Santa Catarina</span>
        <span>Plataforma de tecnologia e inteligência imobiliária.</span>
        <span>© <?= date('Y') ?> ImobiData.</span>
      </div>
      <p class="footer-legal">A ImobiData organiza informações e demandas imobiliárias. Atividades de intermediação, quando aplicáveis, são realizadas separadamente por profissionais ou empresas legalmente habilitados.</p>
    </footer>
  </div>

  <script src="/assets/js/site.js?v=1" defer></script>
</body>
</html>
