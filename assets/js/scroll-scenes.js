(() => {
  const desktopPointer = window.matchMedia('(min-width: 900px) and (hover: hover) and (pointer: fine)');
  const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
  const header = document.querySelector('[data-header]');

  let anchors = [];
  let locked = false;
  let unlockTimer = 0;

  const refreshAnchors = () => {
    anchors = [...document.querySelectorAll('[data-snap]')];
  };

  const headerHeight = () => header?.getBoundingClientRect().height || 0;

  const anchorTop = element => {
    const rawTop = window.scrollY + element.getBoundingClientRect().top;
    return Math.max(0, Math.round(rawTop - headerHeight()));
  };

  const currentAnchorIndex = () => {
    if (!anchors.length) return -1;
    const probe = window.scrollY + headerHeight() + Math.min(window.innerHeight * 0.24, 190);
    let index = 0;

    anchors.forEach((anchor, candidate) => {
      const top = window.scrollY + anchor.getBoundingClientRect().top;
      if (top <= probe) index = candidate;
    });

    return index;
  };

  const needsNativeScroll = (section, direction) => {
    if (!section) return true;

    const viewport = window.innerHeight - headerHeight();
    const sectionTop = anchorTop(section);
    const sectionBottom = sectionTop + section.offsetHeight;
    const y = window.scrollY;
    const tolerance = 28;

    if (section.offsetHeight > viewport + 90) {
      if (direction > 0 && y + viewport < sectionBottom - tolerance) return true;
      if (direction < 0 && y > sectionTop + tolerance) return true;
    }

    return false;
  };

  const snapTo = index => {
    const target = anchors[index];
    if (!target) return;

    locked = true;
    document.documentElement.classList.add('is-scene-moving');
    window.scrollTo({ top: anchorTop(target), behavior: 'smooth' });

    window.clearTimeout(unlockTimer);
    unlockTimer = window.setTimeout(() => {
      locked = false;
      document.documentElement.classList.remove('is-scene-moving');
    }, 760);
  };

  const onWheel = event => {
    if (!desktopPointer.matches || reducedMotion.matches) return;
    if (document.body.classList.contains('is-locked')) return;
    if (event.ctrlKey || Math.abs(event.deltaY) < 8 || Math.abs(event.deltaX) > Math.abs(event.deltaY)) return;
    if (event.target.closest('.concierge,[data-native-scroll]')) return;

    if (locked) {
      event.preventDefault();
      return;
    }

    const index = currentAnchorIndex();
    if (index < 0) return;

    const direction = event.deltaY > 0 ? 1 : -1;
    const current = anchors[index];

    if (needsNativeScroll(current, direction)) return;

    const destination = index + direction;
    if (destination < 0 || destination >= anchors.length) return;

    event.preventDefault();
    snapTo(destination);
  };

  const installHeroChat = () => {
    const hero = document.querySelector('.hero');
    const heroGrid = hero?.querySelector('.hero-grid');
    if (!hero || !heroGrid || hero.querySelector('.hero-chat')) return;

    hero.classList.add('has-start-chat');
    hero.querySelector('.hero-actions')?.remove();

    const chat = document.createElement('section');
    chat.className = 'hero-chat';
    chat.setAttribute('data-native-scroll', '');
    chat.setAttribute('aria-label', 'Iniciar uma busca de imóvel');
    chat.innerHTML = `
      <div class="hero-chat-head">
        <span>INICIE SUA BUSCA</span>
        <strong>Que imóvel você está procurando?</strong>
      </div>
      <div class="hero-chat-composer">
        <textarea id="heroMissionInput" rows="2" maxlength="2200" aria-label="Descreva o imóvel que procura" placeholder="Ex.: Procuro um apartamento na cidade XXX, no bairro YYY, até R$ 900 mil, com três quartos e duas vagas."></textarea>
        <button class="hero-chat-send" id="heroMissionSend" type="button" aria-label="Continuar a conversa">↑</button>
      </div>
      <div class="hero-chat-meta">
        <span>Escreva como falaria com uma pessoa. Pressione Enter para continuar.</span>
        <a href="#conceito">Entender como funciona ↓</a>
      </div>
      <p class="hero-chat-error" id="heroMissionError" role="alert">Descreva um pouco mais o imóvel para iniciar a busca.</p>
    `;

    heroGrid.insertAdjacentElement('afterend', chat);

    const textarea = chat.querySelector('#heroMissionInput');
    const send = chat.querySelector('#heroMissionSend');
    const error = chat.querySelector('#heroMissionError');

    const autoSize = () => {
      textarea.style.height = 'auto';
      textarea.style.height = `${Math.min(textarea.scrollHeight, 132)}px`;
    };

    const showError = message => {
      error.textContent = message;
      error.classList.add('is-visible');
      textarea.focus();
    };

    const handoffToMission = value => {
      const missionTrigger = document.querySelector('.header [data-flow="mission"]') || document.querySelector('[data-flow="mission"]');
      if (!missionTrigger) {
        showError('Não foi possível abrir a conversa neste momento.');
        return;
      }

      missionTrigger.click();
      let attempts = 0;

      const transfer = () => {
        const concierge = document.querySelector('#concierge');
        const conversation = document.querySelector('#conversation');
        const composerInput = document.querySelector('#composerInput');
        const composerSend = document.querySelector('#composerSend');
        const ready = concierge && !concierge.hidden && conversation?.querySelector('.message.assistant') && composerInput && composerSend;

        if (ready) {
          composerInput.value = value;
          composerInput.dispatchEvent(new Event('input', { bubbles: true }));
          requestAnimationFrame(() => composerSend.click());
          return;
        }

        attempts += 1;
        if (attempts < 30) {
          window.setTimeout(transfer, 25);
          return;
        }

        showError('A conversa não abriu corretamente. Tente novamente.');
      };

      transfer();
    };

    const submit = () => {
      const value = textarea.value.trim();
      if (value.length < 20) {
        showError('Descreva um pouco mais o imóvel para iniciar a busca.');
        return;
      }

      error.classList.remove('is-visible');
      handoffToMission(value);
    };

    textarea.addEventListener('input', () => {
      error.classList.remove('is-visible');
      autoSize();
    });

    textarea.addEventListener('keydown', event => {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        submit();
      }
    });

    send.addEventListener('click', submit);
    autoSize();
  };

  installHeroChat();
  refreshAnchors();
  window.addEventListener('wheel', onWheel, { passive: false });
  window.addEventListener('resize', refreshAnchors, { passive: true });
})();
