<?php declare(strict_types=1); ?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#090909">
  <meta name="description" content="ImobiData transforma sua intenção em uma missão imobiliária e pesquisa o mercado para encontrar o que realmente merece sua atenção.">
  <meta property="og:title" content="ImobiData | Faça o mercado procurar por você">
  <meta property="og:description" content="Descreva o imóvel que procura. A ImobiData cruza milhões de ofertas e sinais de mercado para priorizar as melhores possibilidades.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://imobidata.com.br/">
  <title>ImobiData | Faça o mercado procurar por você</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:ital,wght@0,500;1,500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/site.css?v=3">
</head>
<body>
  <div class="site" id="top">
    <header class="header" data-header>
      <a class="brand" href="#top" aria-label="ImobiData, início">
        <span class="brand-word">IMOBI</span><span class="brand-gold">DATA</span>
      </a>
      <nav class="nav" aria-label="Navegação principal">
        <a href="#conceito">O conceito</a>
        <a href="#inteligencia">Inteligência</a>
        <a href="#imobiliarias">Imobiliárias</a>
        <a href="#corretores">Corretores</a>
      </nav>
      <a class="header-cta" href="#missao">Criar missão</a>
    </header>

    <main>
      <section class="hero section-pad">
        <div class="hero-rule" aria-hidden="true"></div>
        <div class="hero-topline reveal">
          <span>REAL ESTATE INTELLIGENCE</span>
          <span>JOINVILLE · SANTA CATARINA</span>
        </div>

        <div class="hero-copy reveal">
          <p class="eyebrow gold">IMOBIDATA</p>
          <h1>Faça o mercado<br><em>procurar por você.</em></h1>
          <p class="hero-lead">Descreva o imóvel que você realmente quer. A ImobiData transforma sua intenção em uma missão e cruza milhões de ofertas, histórico e sinais de mercado para priorizar o que merece sua atenção.</p>
          <div class="hero-actions">
            <a class="button button-gold" href="#missao">Criar minha missão <span>↗</span></a>
            <a class="quiet-link" href="#conceito">Conhecer a lógica <span>↓</span></a>
          </div>
        </div>

        <div class="hero-proof reveal">
          <div class="hero-proof-number">
            <span class="prefix">+</span><strong>3</strong><span class="suffix">MILHÕES</span>
          </div>
          <div class="hero-proof-copy">
            <span>REGISTROS IMOBILIÁRIOS MAPEADOS</span>
            <p>O valor não está em mostrar mais anúncios. Está em entender o mercado suficiente para mostrar menos, com mais contexto.</p>
          </div>
        </div>

        <div class="hero-signature reveal" aria-hidden="true">
          <div class="signature-line"></div>
          <span>DEMAND FIRST</span>
          <div class="signature-line"></div>
        </div>
      </section>

      <section class="statement" id="conceito">
        <div class="statement-inner section-pad reveal">
          <p class="eyebrow">UMA NOVA ORDEM</p>
          <h2>Portais começam pela oferta.<br><em>A ImobiData começa pela demanda.</em></h2>
          <p class="statement-copy">Você não precisa navegar por centenas de imóveis para descobrir o que faz sentido. Primeiro definimos a sua intenção. Depois o mercado é pesquisado para atendê-la.</p>
        </div>
      </section>

      <section class="mission-section section-pad" id="missao">
        <div class="mission-intro reveal">
          <p class="eyebrow gold">MISSÃO IMOBIDATA</p>
          <h2>Uma conversa.<br><em>Não vinte filtros.</em></h2>
          <p>Preço, localização, estilo, prazo, preferências, restrições e aquilo que você não aceita negociar. Descreva como falaria com um especialista.</p>
          <div class="mission-note"><span>01</span><p>Você explica a necessidade.</p></div>
          <div class="mission-note"><span>02</span><p>A ImobiData estrutura a missão.</p></div>
          <div class="mission-note"><span>03</span><p>O mercado passa a ser observado para ela.</p></div>
        </div>

        <div class="mission-card reveal">
          <div class="mission-card-head">
            <div><span class="gold-dot"></span><span>NOVA MISSÃO</span></div>
            <span class="step-indicator"><b data-step="1">01</b> / 02</span>
          </div>

          <form id="missionForm" class="mission-form" autocomplete="on" novalidate>
            <div class="form-step" data-form-step="1">
              <label class="prompt" for="missionText">O que você procura?</label>
              <textarea id="missionText" name="mission" rows="7" maxlength="2200" required placeholder="Ex.: Quero um apartamento em Joinville, no América ou Atiradores, até R$ 950 mil, 3 quartos, duas vagas, prédio mais recente e não quero térreo."></textarea>
              <div class="examples" aria-label="Exemplos de missão">
                <button type="button" data-example="Quero comprar um apartamento em Joinville até R$ 700 mil, 3 quartos e 2 vagas, perto do centro e em prédio mais recente.">Compra</button>
                <button type="button" data-example="Procuro imóvel para investir em Joinville até R$ 550 mil, com boa liquidez e potencial de renda.">Investimento</button>
                <button type="button" data-example="Quero alugar apartamento em Joinville, 2 quartos, 1 vaga, até R$ 3.500 por mês e que aceite pet.">Locação</button>
              </div>
              <div class="form-footer">
                <small>Sem catálogo. Sem cadastro antes da sua intenção.</small>
                <button class="button button-gold" type="submit">Continuar <span>→</span></button>
              </div>
            </div>
          </form>

          <form id="contactForm" class="contact-form is-hidden" autocomplete="on" novalidate>
            <div class="form-step">
              <div class="mission-recap"><span>SUA MISSÃO</span><p id="missionPreview"></p></div>
              <label class="prompt">Onde podemos continuar essa busca?</label>
              <div class="fields">
                <label><span>Nome</span><input name="name" maxlength="120" autocomplete="name" required></label>
                <label><span>WhatsApp</span><input name="whatsapp" maxlength="40" autocomplete="tel" inputmode="tel" required placeholder="(47) 99999-9999"></label>
                <label class="wide"><span>E-mail <em>opcional</em></span><input name="email" maxlength="180" autocomplete="email" type="email"></label>
              </div>
              <label class="consent"><input type="checkbox" name="consent" value="1" required><span>Autorizo o contato da ImobiData exclusivamente sobre esta missão e oportunidades relacionadas.</span></label>
              <div class="form-footer">
                <button class="text-button" type="button" id="editMission">← editar missão</button>
                <button class="button button-gold" type="submit">Ativar missão <span>→</span></button>
              </div>
              <p id="missionStatus" class="form-status" aria-live="polite"></p>
            </div>
          </form>

          <div id="missionSuccess" class="success-panel is-hidden" aria-live="polite">
            <span class="success-kicker">MISSÃO ATIVADA</span>
            <h3>Agora existe uma busca com contexto.</h3>
            <p>Recebemos sua necessidade. A partir daqui, o objetivo é reduzir o mercado às opções que realmente justificam investigação e próximo passo.</p>
            <button class="text-button" type="button" id="newMission">Criar outra missão →</button>
          </div>
        </div>
      </section>

      <section class="intelligence-section section-pad" id="inteligencia">
        <div class="intelligence-heading reveal">
          <p class="eyebrow gold">THE INTELLIGENCE LAYER</p>
          <h2>Um anúncio mostra o agora.<br><em>Dados mostram a história.</em></h2>
        </div>
        <div class="intelligence-grid reveal">
          <article><span class="card-index">01</span><h3>Oferta fragmentada</h3><p>O mesmo imóvel pode aparecer em fontes diferentes, com descrições, preços e momentos diferentes.</p></article>
          <article><span class="card-index">02</span><h3>Histórico de mercado</h3><p>Mudanças de preço, reaparições e exposição ao longo do tempo ajudam a revelar contexto que um card isolado não mostra.</p></article>
          <article><span class="card-index">03</span><h3>Demanda estruturada</h3><p>O que compradores e investidores realmente procuram vira sinal, não apenas uma sequência de cliques.</p></article>
        </div>
        <div class="intelligence-quote reveal">
          <span>IMOBIDATA PRINCIPLE</span>
          <blockquote>“Mais informação não significa uma decisão melhor. Contexto, prioridade e timing significam.”</blockquote>
        </div>
      </section>

      <section class="experience-section section-pad">
        <div class="experience-label reveal">DA BUSCA À DECISÃO</div>
        <div class="experience-steps reveal">
          <div><span>01</span><strong>Intenção</strong><p>Você define o que procura e o que importa.</p></div>
          <div><span>02</span><strong>Missão</strong><p>A necessidade ganha critérios e contexto.</p></div>
          <div><span>03</span><strong>Mercado</strong><p>Milhões de registros passam a ser matéria-prima.</p></div>
          <div><span>04</span><strong>Prioridade</strong><p>Poucas possibilidades chegam à sua atenção.</p></div>
        </div>
      </section>

      <section class="commercial-divider section-pad reveal">
        <p class="eyebrow gold">DOIS CONTEXTOS. DUAS RELAÇÕES.</p>
        <h2>A oferta chega à ImobiData<br><em>por caminhos diferentes.</em></h2>
        <p>Uma imobiliária é uma operação. Um corretor é um profissional. A ImobiData trata cada relação comercial com sua própria lógica, dados e proposta de valor.</p>
      </section>

      <section class="agency-section section-pad" id="imobiliarias">
        <div class="agency-grid">
          <div class="agency-copy reveal">
            <p class="eyebrow gold">PARA IMOBILIÁRIAS</p>
            <h2>Demanda qualificada<br><em>para uma operação inteira.</em></h2>
            <p class="commercial-lead">A imobiliária não entra como “mais um parceiro”. Ela entra como organização capaz de distribuir demanda entre equipe, carteira, regiões e especialidades.</p>
            <div class="commercial-points">
              <article><span>01</span><strong>Carteira e cobertura</strong><p>Entendemos onde sua operação tem profundidade real de oferta.</p></article>
              <article><span>02</span><strong>Equipe e distribuição</strong><p>Uma demanda pode ser encaminhada à estrutura certa, não apenas a um contato genérico.</p></article>
              <article><span>03</span><strong>Integração e recorrência</strong><p>CRM, API, SLA e histórico de resposta podem evoluir para uma relação operacional contínua.</p></article>
            </div>
          </div>

          <form id="agencyForm" class="commercial-form agency-form reveal" novalidate>
            <div class="commercial-form-head">
              <span>ACESSO INSTITUCIONAL</span>
              <h3>Posicione sua imobiliária no radar de demanda.</h3>
              <p>Cadastre a operação. A ImobiData entra em contato quando houver aderência comercial ou oportunidade de integração.</p>
            </div>
            <label><span>Imobiliária / empresa</span><input name="company" maxlength="160" required></label>
            <div class="split-fields">
              <label><span>Responsável</span><input name="name" maxlength="120" required></label>
              <label><span>Cargo <em>opcional</em></span><input name="role_title" maxlength="120" placeholder="Diretor, gestor comercial..."></label>
            </div>
            <div class="split-fields">
              <label><span>WhatsApp</span><input name="whatsapp" maxlength="40" inputmode="tel" required></label>
              <label><span>E-mail <em>opcional</em></span><input name="email" maxlength="180" type="email"></label>
            </div>
            <label><span>Região de atuação</span><input name="region" maxlength="180" required placeholder="Ex.: Joinville e litoral norte"></label>
            <label><span>Perfil da carteira <em>opcional</em></span><textarea name="portfolio_profile" rows="3" maxlength="1200" placeholder="Faixas de preço, bairros, tipologias, lançamentos, locação..."></textarea></label>
            <div class="split-fields">
              <label><span>Tamanho da equipe <em>opcional</em></span><select name="team_size"><option value="">Selecionar</option><option>1–5</option><option>6–15</option><option>16–40</option><option>41+</option></select></label>
              <label><span>Interesse <em>opcional</em></span><select name="integration_interest"><option value="">Selecionar</option><option value="demand">Receber demandas</option><option value="integration">Integração futura</option><option value="both">Ambos</option></select></label>
            </div>
            <label class="consent"><input type="checkbox" name="consent" value="1" required><span>Autorizo contato institucional da ImobiData sobre demanda e possíveis integrações.</span></label>
            <button class="button button-gold" type="submit">Cadastrar imobiliária <span>↗</span></button>
            <p id="agencyStatus" class="form-status" aria-live="polite"></p>
          </form>
        </div>
      </section>

      <section class="broker-section section-pad" id="corretores">
        <div class="broker-grid">
          <div class="broker-intro reveal">
            <p class="eyebrow">PARA CORRETORES</p>
            <h2>Seu valor não é ter<br><em>todo o mercado.</em></h2>
            <p>É saber onde você é realmente forte. Bairro, segmento, relacionamento, velocidade, produto e capacidade de conduzir uma oportunidade até o próximo passo.</p>
          </div>

          <div class="broker-positioning reveal">
            <span>PERFIL PROFISSIONAL</span>
            <blockquote>“A ImobiData não precisa de milhares de corretores iguais. Precisa saber quem chamar quando uma missão exige conhecimento específico.”</blockquote>
            <div class="broker-signals">
              <span>território</span>
              <span>especialidade</span>
              <span>faixa de preço</span>
              <span>disponibilidade</span>
              <span>colaboração</span>
            </div>
          </div>
        </div>

        <form id="brokerForm" class="broker-form reveal" novalidate>
          <div class="broker-form-head">
            <div><span>PERFIL INDIVIDUAL</span><h3>Onde você realmente consegue entregar?</h3></div>
            <p>Cadastre sua zona de força. A lógica aqui é individual: a missão chega quando seu perfil profissional fizer sentido.</p>
          </div>
          <div class="broker-fields">
            <label><span>Nome</span><input name="name" maxlength="120" required></label>
            <label><span>WhatsApp</span><input name="whatsapp" maxlength="40" inputmode="tel" required></label>
            <label><span>E-mail <em>opcional</em></span><input name="email" maxlength="180" type="email"></label>
            <label><span>CRECI <em>opcional nesta etapa</em></span><input name="creci" maxlength="60" placeholder="Ex.: 12345-F"></label>
            <label><span>Cidade principal</span><input name="city" maxlength="120" required placeholder="Ex.: Joinville"></label>
            <label><span>Bairros / regiões <em>opcional</em></span><input name="neighborhoods" maxlength="500" placeholder="América, Atiradores, Centro..."></label>
            <label><span>Segmentos <em>opcional</em></span><input name="segments" maxlength="500" placeholder="Alto padrão, lançamentos, casas, comercial..."></label>
            <label><span>Faixa de preço <em>opcional</em></span><input name="price_range" maxlength="160" placeholder="Ex.: R$ 600 mil a R$ 1,5 milhão"></label>
            <label class="wide"><span>Como você prefere colaborar? <em>opcional</em></span><textarea name="collaboration_profile" rows="3" maxlength="1200" placeholder="Ex.: atendimento de comprador, visita, co-brokerage, imóvel exclusivo em determinada região..."></textarea></label>
          </div>
          <label class="consent broker-consent"><input type="checkbox" name="consent" value="1" required><span>Autorizo contato da ImobiData sobre missões e oportunidades compatíveis com meu perfil profissional.</span></label>
          <div class="broker-submit"><button class="button button-dark" type="submit">Cadastrar perfil <span>↗</span></button><p id="brokerStatus" class="form-status" aria-live="polite"></p></div>
        </form>
      </section>

      <section class="closing-section section-pad reveal">
        <p class="eyebrow gold">IMOBIDATA</p>
        <h2>O imóvel certo pode já estar no mercado.<br><em>A diferença é saber onde olhar.</em></h2>
        <a class="button button-gold" href="#missao">Criar minha missão <span>→</span></a>
      </section>
    </main>

    <footer class="footer">
      <div class="footer-brand-block">
        <a class="brand brand-footer" href="#top"><span class="brand-word">IMOBI</span><span class="brand-gold">DATA</span></a>
        <p>Inteligência de dados aplicada ao mercado imobiliário.</p>
      </div>
      <div class="footer-company">
        <span>UMA EMPRESA</span>
        <strong>MEGAWEB SOLUTIONS</strong>
        <p>Joinville · Santa Catarina</p>
      </div>
      <p class="footer-legal">A ImobiData é uma plataforma de tecnologia e inteligência imobiliária da Megaweb Solutions. Atividades de intermediação imobiliária, quando aplicáveis, são realizadas separadamente por profissionais ou empresas legalmente habilitados.</p>
      <div class="footer-bottom">
        <span>© <?= date('Y') ?> Megaweb Solutions. Todos os direitos reservados.</span>
        <a href="#top">Voltar ao topo ↑</a>
      </div>
    </footer>
  </div>

  <script src="/assets/js/site.js?v=3" defer></script>
</body>
</html>
