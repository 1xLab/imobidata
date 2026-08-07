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

    // Se a cena for maior que a área útil, não prendemos o usuário.
    // Ele percorre o conteúdo normalmente e só troca de cena ao chegar à borda.
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

  refreshAnchors();
  window.addEventListener('wheel', onWheel, { passive: false });
  window.addEventListener('resize', refreshAnchors, { passive: true });
})();
