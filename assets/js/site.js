(() => {
  const $ = (s, root = document) => root.querySelector(s);
  const $$ = (s, root = document) => [...root.querySelectorAll(s)];
  const concierge = $('#concierge');
  const conversation = $('#conversation');
  const quickReplies = $('#quickReplies');
  const composer = $('#composer');
  const input = $('#composerInput');
  const sendButton = $('#composerSend');
  const contextLabel = $('#conciergeContext');
  const progress = $('#conciergeProgress');
  const stepLabel = $('#conciergeStep');
  const header = $('[data-header]');

  const flows = {
    mission: {
      label: 'CRIAR MISSÃO',
      endpoint: '/api/mission.php',
      source: 'landing_conversation',
      successTitle: 'Missão registrada.',
      successText: 'A ImobiData recebeu os critérios da busca e os dados de contato. Essas informações serão usadas para acompanhar esta missão e apresentar oportunidades relacionadas ao imóvel procurado.',
      steps: [
        {
          key: 'mission',
          prompt: 'Descreva o imóvel que está procurando.',
          hint: 'Exemplo: apartamento em Joinville, América ou Atiradores, até R$ 900 mil, 3 quartos, 2 vagas, prédio recente e sem interesse em térreo.',
          multiline: true,
          min: 20
        },
        {
          key: 'name',
          prompt: 'Qual é o seu nome?',
          hint: 'Este nome será usado para identificar a missão.'
        },
        {
          key: 'whatsapp',
          prompt: 'Qual número de WhatsApp pode receber informações sobre esta busca?',
          hint: 'Informe DDD e número.'
        },
        {
          key: 'email',
          prompt: 'Deseja informar também um e-mail?',
          hint: 'O e-mail é opcional.',
          optional: true
        },
        {
          key: 'consent',
          prompt: 'Autoriza a ImobiData a usar esses dados para acompanhar esta missão e entrar em contato quando houver informações ou imóveis relacionados à busca?',
          options: [
            { label: 'Sim, autorizo', value: '1' },
            { label: 'Não autorizo', value: '0' }
          ],
          requireYes: true
        }
      ]
    },

    agency: {
      label: 'CADASTRO DE IMOBILIÁRIA',
      endpoint: '/api/agency.php',
      source: 'landing_agency_conversation',
      successTitle: 'Imobiliária registrada.',
      successText: 'Os dados foram recebidos. A ImobiData poderá usar essas informações para identificar demandas compatíveis com a atuação da imobiliária e, quando fizer sentido, discutir uma integração com a operação.',
      steps: [
        {
          key: 'company',
          prompt: 'Qual é o nome da imobiliária?',
          hint: 'Informe o nome comercial ou a razão social.'
        },
        {
          key: 'name',
          prompt: 'Quem é a pessoa responsável por este contato?',
          hint: 'Informe o nome da pessoa que pode tratar de demandas e possíveis integrações.'
        },
        {
          key: 'region',
          prompt: 'Em qual cidade ou região a imobiliária atua?',
          hint: 'Exemplo: Joinville, litoral norte de Santa Catarina, ou bairros específicos.'
        },
        {
          key: 'team_size',
          prompt: 'Quantas pessoas trabalham diretamente na área comercial?',
          options: [
            { label: '1 a 5', value: '1–5' },
            { label: '6 a 15', value: '6–15' },
            { label: '16 a 40', value: '16–40' },
            { label: 'Mais de 40', value: '41+' },
            { label: 'Prefiro não informar', value: '' }
          ],
          optional: true
        },
        {
          key: 'integration_interest',
          prompt: 'O que a imobiliária pretende fazer primeiro com a ImobiData?',
          options: [
            { label: 'Receber demandas compatíveis com a carteira', value: 'demand' },
            { label: 'Avaliar uma integração com o estoque da imobiliária', value: 'integration' },
            { label: 'As duas opções', value: 'both' }
          ]
        },
        {
          key: 'whatsapp',
          prompt: 'Qual número de WhatsApp deve ser usado para esse contato institucional?',
          hint: 'Informe DDD e número.'
        },
        {
          key: 'consent',
          prompt: 'Autoriza a ImobiData a entrar em contato sobre demandas compatíveis e possíveis integrações com a imobiliária?',
          options: [
            { label: 'Sim, autorizo', value: '1' },
            { label: 'Não autorizo', value: '0' }
          ],
          requireYes: true
        }
      ]
    },

    broker: {
      label: 'INDEXAÇÃO DE ANÚNCIOS',
      endpoint: '/api/broker.php',
      source: 'landing_broker_index',
      successTitle: 'Fontes recebidas para análise.',
      successText: 'A ImobiData registrou os endereços informados. Cada fonte será analisada para verificar se é possível identificar os anúncios vinculados ao corretor. A indicação de uma página não garante a coleta, porque isso depende da disponibilidade técnica e das condições de acesso de cada site.',
      steps: [
        {
          key: 'name',
          prompt: 'Qual é o seu nome profissional?',
          hint: 'Informe o nome pelo qual seus clientes e parceiros identificam você.'
        },
        {
          key: 'creci',
          prompt: 'Deseja informar o número do CRECI?',
          hint: 'Esta informação é opcional nesta etapa.',
          optional: true
        },
        {
          key: 'source_urls',
          prompt: 'Em quais páginas os seus imóveis já estão publicados?',
          hint: 'Cole um ou mais links. Pode ser seu perfil em um portal, seu site próprio ou sua página no site da imobiliária. Se houver mais de um link, coloque um por linha.',
          multiline: true,
          min: 8
        },
        {
          key: 'indexing_authorization',
          prompt: 'Autoriza a ImobiData a analisar as páginas públicas informadas para identificar os anúncios vinculados ao seu perfil?',
          options: [
            { label: 'Sim, autorizo a análise', value: '1' },
            { label: 'Não autorizo', value: '0' }
          ],
          requireYes: true
        },
        {
          key: 'whatsapp',
          prompt: 'Qual número de WhatsApp pode receber contato quando uma missão for compatível com um imóvel identificado nessas fontes?',
          hint: 'Informe DDD e número.'
        },
        {
          key: 'consent',
          prompt: 'Autoriza a ImobiData a entrar em contato sobre a indexação dessas fontes e sobre missões compatíveis com os imóveis encontrados?',
          options: [
            { label: 'Sim, autorizo', value: '1' },
            { label: 'Não autorizo', value: '0' }
          ],
          requireYes: true
        }
      ]
    }
  };

  let state = null;

  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add('is-visible');
      revealObserver.unobserve(entry.target);
    });
  }, { threshold: 0.1 });

  $$('.reveal').forEach(el => revealObserver.observe(el));

  window.addEventListener('scroll', () => {
    header?.classList.toggle('is-scrolled', window.scrollY > 84);
  }, { passive: true });

  $$('[data-flow]').forEach(button => button.addEventListener('click', () => openFlow(button.dataset.flow)));
  $$('[data-close-concierge]').forEach(button => button.addEventListener('click', closeFlow));

  sendButton?.addEventListener('click', submitCurrent);

  input?.addEventListener('keydown', event => {
    if (event.key === 'Enter' && !event.shiftKey) {
      event.preventDefault();
      submitCurrent();
    }
  });

  input?.addEventListener('input', autoSize);

  document.addEventListener('keydown', event => {
    if (event.key === 'Escape' && state) closeFlow();
  });

  function openFlow(type) {
    const flow = flows[type];
    if (!flow) return;

    state = { type, flow, index: 0, data: {} };
    conversation.innerHTML = '';
    quickReplies.innerHTML = '';
    contextLabel.textContent = flow.label;
    concierge.hidden = false;
    concierge.setAttribute('aria-hidden', 'false');
    document.body.classList.add('is-locked');

    requestAnimationFrame(() => askCurrent(true));
  }

  function closeFlow() {
    if (!state) return;

    concierge.hidden = true;
    concierge.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('is-locked');
    state = null;
  }

  function askCurrent(first = false) {
    const step = currentStep();
    if (!step) return finishFlow();

    updateProgress();

    if (!first) showTyping(() => addMessage('assistant', step.prompt));
    else addMessage('assistant', step.prompt);

    configureComposer(step);
  }

  function currentStep() {
    return state?.flow.steps[state.index] || null;
  }

  function configureComposer(step) {
    quickReplies.innerHTML = '';
    input.value = '';
    input.placeholder = step.hint || 'Escreva aqui...';
    input.rows = step.multiline ? 3 : 1;
    autoSize();

    if (step.options?.length) {
      composer.classList.add('is-disabled');

      step.options.forEach(option => {
        const button = document.createElement('button');
        button.type = 'button';
        button.textContent = option.label;
        button.addEventListener('click', () => acceptAnswer(option.value, option.label));
        quickReplies.appendChild(button);
      });

      return;
    }

    composer.classList.remove('is-disabled');

    if (step.optional) {
      const skip = document.createElement('button');
      skip.type = 'button';
      skip.textContent = 'Pular esta pergunta';
      skip.addEventListener('click', () => acceptAnswer('', 'Pergunta ignorada'));
      quickReplies.appendChild(skip);
    }

    setTimeout(() => input.focus(), 80);
  }

  function submitCurrent() {
    if (!state) return;

    const step = currentStep();
    if (!step || step.options?.length) return;

    const value = input.value.trim();

    if (!value && !step.optional) {
      input.focus();
      return;
    }

    if (step.min && value.length < step.min) {
      addMessage(
        'assistant',
        state.type === 'broker' && step.key === 'source_urls'
          ? 'Informe pelo menos um endereço completo onde os imóveis estão publicados.'
          : 'A descrição ainda está muito curta para orientar a busca. Inclua, se possível, cidade ou região, faixa de preço e as características mais importantes do imóvel.'
      );
      input.focus();
      return;
    }

    acceptAnswer(value, value || 'Pergunta ignorada');
  }

  function acceptAnswer(value, visibleValue) {
    const step = currentStep();
    if (!step) return;

    if (step.requireYes && value !== '1') {
      addMessage('user', visibleValue);
      showTyping(() => addMessage('assistant', 'Os dados não serão enviados sem autorização. Esta conversa pode ser fechada sem criar nenhum registro.'));
      composer.classList.add('is-disabled');
      quickReplies.innerHTML = '';
      return;
    }

    state.data[step.key] = value;
    addMessage('user', visibleValue);
    state.index += 1;
    askCurrent();
  }

  async function finishFlow() {
    updateProgress(true);
    composer.classList.add('is-disabled');
    quickReplies.innerHTML = '';
    addTyping();

    try {
      const payload = { ...state.data, source: state.flow.source };
      const result = await send(state.flow.endpoint, payload);

      removeTyping();

      if (!result.ok) throw new Error(result.error || 'Não foi possível concluir o envio neste momento.');

      conversation.innerHTML = `
        <div class="conversation-success">
          <span class="eyebrow">CONCLUÍDO</span>
          <h3>${escapeHtml(state.flow.successTitle)}</h3>
          <p>${escapeHtml(state.flow.successText)}</p>
          <button class="outline-button" type="button" id="conversationDone">Fechar <b>×</b></button>
        </div>`;

      $('#conversationDone')?.addEventListener('click', closeFlow);
      stepLabel.textContent = 'CONCLUÍDO';
    } catch (error) {
      removeTyping();
      addMessage('assistant', error.message);

      const retry = document.createElement('button');
      retry.type = 'button';
      retry.textContent = 'Tentar novamente';
      retry.addEventListener('click', finishFlow);
      quickReplies.appendChild(retry);
    }
  }

  async function send(url, payload) {
    const response = await fetch(url, {
      method: 'POST',
      headers: { 'content-type': 'application/json', accept: 'application/json' },
      body: JSON.stringify(payload)
    });

    let data = {};

    try {
      data = await response.json();
    } catch (_) {}

    if (!response.ok && !data.error) data.error = `Erro HTTP ${response.status}`;

    return data;
  }

  function addMessage(role, text) {
    const node = document.createElement('div');
    node.className = `message ${role}`;

    if (role === 'assistant') {
      const meta = document.createElement('small');
      meta.textContent = 'IMOBIDATA';
      node.appendChild(meta);
    }

    const body = document.createElement('div');
    body.textContent = text;
    node.appendChild(body);
    conversation.appendChild(node);
    conversation.scrollTop = conversation.scrollHeight;
  }

  function showTyping(callback) {
    addTyping();

    setTimeout(() => {
      removeTyping();
      callback();
      conversation.scrollTop = conversation.scrollHeight;
    }, 320);
  }

  function addTyping() {
    removeTyping();

    const node = document.createElement('div');
    node.className = 'message assistant typing';
    node.id = 'typing';
    node.innerHTML = '<i></i><i></i><i></i>';
    conversation.appendChild(node);
    conversation.scrollTop = conversation.scrollHeight;
  }

  function removeTyping() {
    $('#typing')?.remove();
  }

  function updateProgress(done = false) {
    if (!state) return;

    const total = state.flow.steps.length;
    const current = done ? total : Math.min(state.index + 1, total);
    const pct = done ? 100 : Math.round((state.index / total) * 100);

    progress.style.width = `${pct}%`;
    stepLabel.textContent = `${String(current).padStart(2, '0')} / ${String(total).padStart(2, '0')}`;
  }

  function autoSize() {
    if (!input) return;

    input.style.height = 'auto';
    input.style.height = `${Math.min(input.scrollHeight, 150)}px`;
  }

  function escapeHtml(value) {
    return String(value).replace(/[&<>'"]/g, char => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      "'": '&#039;',
      '"': '&quot;'
    }[char]));
  }
})();