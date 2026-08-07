(() => {
  const qs = (s, root = document) => root.querySelector(s);
  const qsa = (s, root = document) => [...root.querySelectorAll(s)];
  const header = qs('[data-header]');
  const missionForm = qs('#missionForm');
  const contactForm = qs('#contactForm');
  const partnerForm = qs('#partnerForm');
  const missionText = qs('#missionText');
  const missionPreview = qs('#missionPreview');
  const missionSuccess = qs('#missionSuccess');
  const missionStatus = qs('#missionStatus');
  const partnerStatus = qs('#partnerStatus');
  const stepLabel = qs('[data-step="1"]');
  let mission = '';

  const revealObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        revealObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12 });
  qsa('.reveal').forEach(el => revealObserver.observe(el));

  window.addEventListener('scroll', () => {
    header?.classList.toggle('is-scrolled', window.scrollY > 80);
  }, { passive: true });

  qsa('[data-example]').forEach(button => {
    button.addEventListener('click', () => {
      missionText.value = button.dataset.example || '';
      missionText.focus();
    });
  });

  missionForm?.addEventListener('submit', event => {
    event.preventDefault();
    mission = missionText.value.trim();
    if (mission.length < 20) {
      missionText.setCustomValidity('Descreva um pouco mais a sua busca.');
      missionText.reportValidity();
      missionText.setCustomValidity('');
      return;
    }
    missionPreview.textContent = mission;
    missionForm.classList.add('is-hidden');
    contactForm.classList.remove('is-hidden');
    if (stepLabel) stepLabel.textContent = '02';
    qs('input[name="name"]', contactForm)?.focus();
  });

  qs('#editMission')?.addEventListener('click', () => {
    contactForm.classList.add('is-hidden');
    missionForm.classList.remove('is-hidden');
    if (stepLabel) stepLabel.textContent = '01';
    missionText.focus();
  });

  qs('#newMission')?.addEventListener('click', () => {
    mission = '';
    missionText.value = '';
    contactForm.reset();
    missionSuccess.classList.add('is-hidden');
    missionForm.classList.remove('is-hidden');
    if (stepLabel) stepLabel.textContent = '01';
    missionText.focus();
  });

  contactForm?.addEventListener('submit', async event => {
    event.preventDefault();
    if (!contactForm.reportValidity()) return;
    const button = qs('button[type="submit"]', contactForm);
    const payload = Object.fromEntries(new FormData(contactForm).entries());
    payload.mission = mission;
    payload.source = 'landing';
    setBusy(button, true, 'Ativando...');
    missionStatus.textContent = '';
    try {
      const response = await send('/api/mission.php', payload);
      if (!response.ok) throw new Error(response.error || 'Não foi possível ativar a missão.');
      contactForm.classList.add('is-hidden');
      missionSuccess.classList.remove('is-hidden');
    } catch (error) {
      missionStatus.textContent = error.message;
    } finally {
      setBusy(button, false, 'Ativar missão');
    }
  });

  partnerForm?.addEventListener('submit', async event => {
    event.preventDefault();
    if (!partnerForm.reportValidity()) return;
    const button = qs('button[type="submit"]', partnerForm);
    const payload = Object.fromEntries(new FormData(partnerForm).entries());
    payload.source = 'landing_partner';
    setBusy(button, true, 'Enviando...');
    partnerStatus.textContent = '';
    try {
      const response = await send('/api/partner.php', payload);
      if (!response.ok) throw new Error(response.error || 'Não foi possível enviar agora.');
      partnerForm.reset();
      partnerStatus.textContent = 'Recebido. Sua empresa entrou no radar de parcerias da ImobiData.';
    } catch (error) {
      partnerStatus.textContent = error.message;
    } finally {
      setBusy(button, false, 'Entrar no radar');
    }
  });

  async function send(url, payload) {
    const response = await fetch(url, {
      method: 'POST',
      headers: { 'content-type': 'application/json', 'accept': 'application/json' },
      body: JSON.stringify(payload)
    });
    let data = {};
    try { data = await response.json(); } catch (_) {}
    if (!response.ok && !data.error) data.error = `Erro HTTP ${response.status}`;
    return data;
  }

  function setBusy(button, busy, label) {
    if (!button) return;
    button.disabled = busy;
    button.style.opacity = busy ? '.65' : '1';
    const arrow = busy ? '' : ' <span>→</span>';
    button.innerHTML = label + arrow;
  }
})();
