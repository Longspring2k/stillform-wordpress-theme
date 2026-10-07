(() => {
  const button = document.querySelector('.nav-toggle');
  const nav = document.querySelector('.primary-nav');
  const header = document.querySelector('[data-header]');
  if (button && nav) {
    const close = () => { button.setAttribute('aria-expanded', 'false'); nav.classList.remove('is-open'); document.body.classList.remove('menu-open'); };
    button.addEventListener('click', () => {
      const open = button.getAttribute('aria-expanded') !== 'true';
      button.setAttribute('aria-expanded', String(open));
      nav.classList.toggle('is-open', open);
      document.body.classList.toggle('menu-open', open);
    });
    nav.querySelectorAll('a').forEach(link => link.addEventListener('click', close));
    document.addEventListener('keydown', event => { if (event.key === 'Escape') { close(); button.focus(); } });
  }
  let previous = window.scrollY;
  window.addEventListener('scroll', () => {
    const current = window.scrollY;
    header?.classList.toggle('is-compact', current > 48);
    header?.classList.toggle('is-hidden', current > previous && current > 240 && !document.body.classList.contains('menu-open'));
    previous = current;
  }, { passive: true });
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(entries => entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('is-visible'); observer.unobserve(entry.target); }
    }), { threshold: .12 });
    document.querySelectorAll('.image-reveal, .reveal').forEach(el => observer.observe(el));
  }
})();
