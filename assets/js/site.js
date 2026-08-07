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
      label: 'MISSÃO IMOBIDATA',
      endpoint: '/api/mission.php',
      source: 'landing_conversation',
      successTitle: 'Missão registrada.',
      successText: 'Os critérios da busca foram salvos. O contato informado será usado para esta missão e oportunidades relacionadas.',
      steps: [
        { key: 'mission', prompt: 'Qual imóvel está procurando?', hint: 'Informe cidade ou região, faixa de preço, características, prazo e restrições relevantes.', multiline: true, min: 20 },
        { key: 'name', prompt: 'Qual é o seu nome?', hint: 'Nome para identificação da missão.' },
        { key: 'whatsapp', prompt: 'Qual WhatsApp deve receber as atualizações desta missão?', hint: 'DDD + número.' },
        { key: 'email', prompt: 'Deseja informar um e-mail?', hint: 'Opcional.', optional: true },
        { key: 'consent', prompt: 'Autoriza o uso desses dados para esta missão e oportunidades relacionadas?', options: [
          { label: 'Sim, autorizo', value: '1' },
          { label: 'Não', value: '0' }
        ], requireYes: true }
      ]
    },
    agency: {
      label: 'IMOBILIÁRIA',
      endpoint: '/api/agency.php',
      source: 'landing_agency_conversation',
      successTitle: 'Imobiliária registrada.',
      successText: 'Os dados institucionais foram salvos para análise de demanda, cobertura e possíveis integrações.',
      steps: [
        { key: 'company', prompt: 'Qual é o nome da imobiliária?', hint: 'Nome comercial ou razão social.' },
        { key: 'name', prompt: 'Quem responde por este contato?', hint: 'Nome do responsável.' },
        { key: 'region', prompt: 'Qual região a operação atende?', hint: 'Cidade, bairros ou área de cobertura.' },
        { key: 'team_size', prompt: 'Qual é o tamanho da equipe comercial?', options: [
          { label: '1–5', value: '1–5' }, { label: '6–15', value: '6–15' }, { label: '16–40', value: '16–40' }, { label: '41+', value: '41+' }, { label: 'Não informar', value: '' }
        ], optional: true },
        { key: 'integration_interest', prompt: 'Qual relação interessa neste momento?', options: [
          { label: 'Receber demandas', value: 'demand' }, { label: 'Avaliar integração', value: 'integration' }, { label: 'Ambas', value: 'both' }
        ] },
        { key: 'whatsapp', prompt: 'Qual WhatsApp deve receber o contato institucional?', hint: 'DDD + número.' },
        { key: 'consent', prompt: 'Autoriza contato sobre demandas e possíveis integrações?', options: [
          { label: 'Sim, autorizo', value: '1' }, { label: 'Não', value: '0' }
        ], requireYes: true }
      ]
    },
    broker: {
      label: 'INDEXAÇÃO DE CORRETOR',
      endpoint: '/api/broker.php',
      source: 'landing_broker_index',
      successTitle: 'Fontes recebidas.',
      successText: 'Os endereços informados foram registrados para análise. A indexação efetiva depende da disponibilidade técnica e das condições de acesso de cada fonte.',
      steps: [
        { key: 'name', prompt: 'Qual é o seu nome?', hint: 'Nome profissional.' },
        { key: 'creci', prompt: 'Deseja informar o CRECI?', hint: 'Opcional.', optional: true },
        { key: 'source_urls', prompt: 'Em quais endereços seus imóveis são publicados?', hint: 'Cole um ou mais links: perfil em portal, site próprio ou página no site da imobiliária. Um link por linha.', multiline: true, min: 8 },
        { key: 'indexing_authorization', prompt: 'Autoriza a ImobiData a analisar essas fontes públicas para identificar os anúncios vinculados ao seu perfil?', options: [
          { label: 'Sim, autorizo', value: '1' }, { label: 'Não', value: '0' }
        ], requireYes: true },
        { key: 'whatsapp', prompt: 'Qual WhatsApp deve receber contatos sobre missões compatíveis?', hint: 'DDD + número.' },
        { key: 'consent', prompt: 'Autoriza contato sobre a indexação e missões relacionadas?', options: [
          { label: 'Sim, autorizo', value: '1' }, { label: 'Não', value: '0' }
        ], requireYes: true }
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
      skip.textContent = 'Pular';
      skip.addEventListener('click', () => acceptAnswer('', 'Pular'));
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
      addMessage('assistant', state.type === 'broker' && step.key === 'source_urls'
        ? 'Informe pelo menos um endereço válido onde os imóveis são publicados.'
        : 'A descrição está curta. Inclua cidade ou região, faixa de preço ou características essenciais.');
      input.focus();
      return;
    }
    acceptAnswer(value, value || 'Pular');
  }

  function acceptAnswer(value, visibleValue) {
    const step = currentStep();
    if (!step) return;
    if (step.requireYes && value !== '1') {
      addMessage('user', visibleValue);
      showTyping(() => addMessage('assistant', 'Sem autorização, os dados não serão enviados. A conversa pode ser fechada sem registro.'));
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
      if (!result.ok) throw new Error(result.error || 'Não foi possível concluir o envio.');
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
    try { data = await response.json(); } catch (_) {}
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
    return String(value).replace(/[&<>'"]/g, char => ({ '&':'&amp;', '<':'&lt;', '>':'&gt;', "'":'&#039;', '"':'&quot;' }[char]));
  }
})();