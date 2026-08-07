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
      successTitle: 'Sua missão está ativa.',
      successText: 'Agora existe uma demanda com contexto. A ImobiData pode continuar a busca a partir do que realmente importa para você.',
      steps: [
        { key: 'mission', prompt: 'Qual imóvel faria sentido para você agora?', hint: 'Pode escrever como falaria com uma pessoa: região, preço, quartos, prazo, restrições...', multiline: true, min: 20 },
        { key: 'name', prompt: 'Como posso chamar você?', hint: 'Seu primeiro nome já é suficiente.' },
        { key: 'whatsapp', prompt: 'Qual WhatsApp devemos usar para continuar esta missão?', hint: 'Use DDD + número.' },
        { key: 'email', prompt: 'Quer deixar um e-mail também?', hint: 'É opcional. Você pode pular esta etapa.', optional: true },
        { key: 'consent', prompt: 'Posso usar esses dados somente para continuar sua missão e enviar oportunidades relacionadas?', options: [
          { label: 'Sim, pode continuar', value: '1' },
          { label: 'Não', value: '0' }
        ], requireYes: true }
      ]
    },
    agency: {
      label: 'IMOBILIÁRIA',
      endpoint: '/api/agency.php',
      source: 'landing_agency_conversation',
      successTitle: 'Sua operação entrou no radar.',
      successText: 'A relação com imobiliárias é institucional. Entraremos em contato quando houver aderência de demanda ou oportunidade de integração.',
      steps: [
        { key: 'company', prompt: 'Qual é o nome da imobiliária?', hint: 'Razão comercial ou marca.' },
        { key: 'name', prompt: 'Com quem devemos falar nessa operação?', hint: 'Nome do responsável comercial ou institucional.' },
        { key: 'region', prompt: 'Onde a imobiliária tem cobertura real?', hint: 'Cidade, bairros, litoral, região metropolitana...' },
        { key: 'team_size', prompt: 'Qual é o tamanho aproximado da equipe comercial?', options: [
          { label: '1–5', value: '1–5' }, { label: '6–15', value: '6–15' }, { label: '16–40', value: '16–40' }, { label: '41+', value: '41+' }, { label: 'Prefiro não informar', value: '' }
        ], optional: true },
        { key: 'integration_interest', prompt: 'O que faz mais sentido para a imobiliária neste momento?', options: [
          { label: 'Receber demandas qualificadas', value: 'demand' }, { label: 'Explorar integração futura', value: 'integration' }, { label: 'Os dois', value: 'both' }
        ] },
        { key: 'whatsapp', prompt: 'Qual WhatsApp institucional devemos usar?', hint: 'Pode ser do responsável ou da operação.' },
        { key: 'consent', prompt: 'Podemos entrar em contato sobre demandas e possíveis integrações?', options: [
          { label: 'Sim, autorizo', value: '1' }, { label: 'Não', value: '0' }
        ], requireYes: true }
      ]
    },
    broker: {
      label: 'INDEXAÇÃO DE CORRETOR',
      endpoint: '/api/broker.php',
      source: 'landing_broker_index',
      successTitle: 'Suas fontes entraram na fila de indexação.',
      successText: 'A ImobiData vai analisar as fontes indicadas, identificar os imóveis disponíveis e preparar esse estoque para cruzamento com missões compatíveis. A coleta efetiva depende da disponibilidade técnica e das políticas de acesso de cada fonte.',
      steps: [
        { key: 'name', prompt: 'Como você se chama?', hint: 'Nome profissional.' },
        { key: 'creci', prompt: 'Quer informar seu CRECI?', hint: 'Opcional nesta etapa.', optional: true },
        { key: 'source_urls', prompt: 'Onde seus imóveis já estão publicados?', hint: 'Cole um ou mais links: seu perfil em portais, seu site ou sua página no site da imobiliária. Um link por linha.', multiline: true, min: 8 },
        { key: 'indexing_authorization', prompt: 'Você confirma que essas fontes são públicas e autoriza a ImobiData a analisá-las para identificar seus imóveis e cruzá-los com missões compatíveis?', options: [
          { label: 'Sim, autorizo a análise', value: '1' }, { label: 'Não', value: '0' }
        ], requireYes: true },
        { key: 'whatsapp', prompt: 'Qual WhatsApp devemos usar para falar com você quando houver uma missão compatível?', hint: 'DDD + número.' },
        { key: 'consent', prompt: 'Podemos entrar em contato sobre a indexação e oportunidades relacionadas às missões?', options: [
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
        ? 'Envie pelo menos um link completo onde seus imóveis estão publicados.'
        : 'Conte um pouco mais. Quanto melhor o contexto, melhor a missão.');
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
      showTyping(() => addMessage('assistant', 'Sem autorização eu não salvo seus dados. Você pode fechar esta conversa sem enviar nada.'));
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
      if (!result.ok) throw new Error(result.error || 'Não foi possível concluir agora.');
      conversation.innerHTML = `
        <div class="conversation-success">
          <span class="eyebrow">CONCLUÍDO</span>
          <h3>${escapeHtml(state.flow.successTitle)}</h3>
          <p>${escapeHtml(state.flow.successText)}</p>
          <button class="outline-button" type="button" id="conversationDone">Fechar conversa <b>×</b></button>
        </div>`;
      $('#conversationDone')?.addEventListener('click', closeFlow);
      stepLabel.textContent = 'CONCLUÍDO';
    } catch (error) {
      removeTyping();
      addMessage('assistant', `${error.message} Você pode tentar novamente agora.`);
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