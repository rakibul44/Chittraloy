  /* Cursor */
  if (window.matchMedia('(hover:hover) and (pointer:fine)').matches) {
    const cursor = document.getElementById('cursor'), ring = document.getElementById('cursorRing');
    let mx=0,my=0,rx=0,ry=0;
    document.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; cursor.style.left=mx+'px'; cursor.style.top=my+'px'; });
    (function a(){ rx+=(mx-rx)*.12; ry+=(my-ry)*.12; ring.style.left=rx+'px'; ring.style.top=ry+'px'; requestAnimationFrame(a); })();
  }

  /* Navbar scroll */
  const nav = document.getElementById('mainNav');
  const onScroll = () => nav.classList.toggle('scrolled', scrollY > 55);
  addEventListener('scroll', onScroll, {passive:true}); onScroll();

  /* Close mobile nav on link click */
  document.querySelectorAll('#navMenu .nav-link').forEach(l => l.addEventListener('click', () => {
    const c = bootstrap.Collapse.getInstance(document.getElementById('navMenu'));
    if (c) c.hide();
  }));

  /* Scroll reveal */
  const ro = new IntersectionObserver(es => es.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); }), {threshold:.09});
  document.querySelectorAll('.reveal').forEach(r => ro.observe(r));

  /* Lightbox */
  function openLightbox(el) { document.getElementById('lightboxImg').src=el.querySelector('img').src; document.getElementById('lightbox').classList.add('open'); document.body.style.overflow='hidden'; }
  function closeLightbox() { document.getElementById('lightbox').classList.remove('open'); document.body.style.overflow=''; }
  document.getElementById('lightbox').addEventListener('click', e => { if(e.target===e.currentTarget) closeLightbox(); });
  document.addEventListener('keydown', e => { if(e.key==='Escape') closeLightbox(); });

  /* Video modal */
  const vm = document.getElementById('videoModal');
  vm.addEventListener('show.bs.modal', () => { document.getElementById('videoFrame').src='https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1'; });
  vm.addEventListener('hide.bs.modal', () => { document.getElementById('videoFrame').src=''; });

  /* Hero carousel animation reset */
  document.getElementById('heroCarousel').addEventListener('slide.bs.carousel', () => {
    document.querySelectorAll('.hero-content').forEach(c => { c.style.opacity='0'; c.style.transform='translateY(30px)'; });
  });

  /* Touch swipe on hero */
  let tx=0;
  const hc = document.getElementById('heroCarousel');
  hc.addEventListener('touchstart', e => { tx=e.changedTouches[0].screenX; }, {passive:true});
  hc.addEventListener('touchend', e => {
    const d = tx - e.changedTouches[0].screenX;
    if (Math.abs(d)>45) { const c=bootstrap.Carousel.getInstance(hc); d>0?c.next():c.prev(); }
  }, {passive:true});
