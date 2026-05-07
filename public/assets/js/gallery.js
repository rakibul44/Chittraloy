/* ═══════════════════════════════════════════════════════
   GALLERY PAGE — Dynamic from Admin Dashboard
   Reads images from localStorage (admin_gallery)
   ═══════════════════════════════════════════════════════ */

/* ────────────── DEFAULT DATA (fallback) ───────────────── */
const defaultPhotos = [
  {id:1, img:'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&q=80', cat:'ceremony', title:'Sacred Vows', tag:'Ceremony'},
  {id:2, img:'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&q=80', cat:'portrait', title:'Golden Hour Kiss', tag:'Portraits'},
  {id:3, img:'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&q=80', cat:'bridal', title:'Bridal Radiance', tag:'Bridal'},
  {id:4, img:'https://images.unsplash.com/photo-1460978812857-470ed1c77af0?w=900&q=80', cat:'reception', title:'First Dance', tag:'Reception'},
  {id:5, img:'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&q=80', cat:'details', title:'Floral Elegance', tag:'Details'},
  {id:6, img:'https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=900&q=80', cat:'portrait', title:'Forever Begins', tag:'Portraits'},
  {id:7, img:'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=900&q=80', cat:'ceremony', title:'Walking the Aisle', tag:'Ceremony'},
  {id:8, img:'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=900&q=80', cat:'reception', title:'Candid Joy', tag:'Reception'},
  {id:9, img:'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=900&q=80', cat:'bridal', title:'Veil of Dreams', tag:'Bridal'},
  {id:10,img:'https://images.unsplash.com/photo-1561486462-89834a03cb72?w=900&q=80', cat:'details', title:'Ring Ceremony', tag:'Details'},
  {id:11,img:'https://images.unsplash.com/photo-1543736959-29af8bb44c91?w=900&q=80', cat:'portrait', title:'Intimate Moment', tag:'Portraits'},
  {id:12,img:'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=600&q=80', cat:'ceremony', title:'Altar Kiss', tag:'Ceremony'},
];

/* ────────────── LOAD FROM SERVER ──────────────────────── */
function loadGalleryData(){
  if (typeof window.serverPhotos !== 'undefined' && window.serverPhotos.length > 0) {
      return window.serverPhotos;
  }
  return defaultPhotos;
}

/* ────────────── GALLERY STATE ───────────────────────── */
let activeFilter = 'all';
let currentPhotos = loadGalleryData();
const PER_PAGE = 12;
let visibleCount = PER_PAGE;

/* ────────────── BUILD CARD ──────────────────────────── */
function buildCard(p, realIdx) {
  const div = document.createElement('div');
  div.className = 'gallery-item reveal';
  div.setAttribute('role','button');
  div.setAttribute('tabindex','0');
  div.setAttribute('aria-label', `Open ${p.title}`);
  div.innerHTML = `
    <img src="${p.img}" alt="${p.title}" loading="lazy"/>
    <div class="gallery-overlay" aria-hidden="true">
      <span class="overlay-tag">${p.tag}</span>
      <span class="overlay-title">${p.title}</span>
      <span class="overlay-icon"><i class="fas fa-expand"></i></span>
    </div>`;
  div.addEventListener('click', () => openLightbox(realIdx));
  div.addEventListener('keydown', e => { if(e.key==='Enter'||e.key===' ') openLightbox(realIdx); });
  return div;
}

/* ────────────── RENDER ──────────────────────────────── */
function renderGallery(filter) {
  const grid = document.getElementById('galleryGrid');
  grid.innerHTML = '';
  const filtered = currentPhotos.filter(p => filter === 'all' || p.cat === filter);
  const toShow = filtered.slice(0, visibleCount);
  toShow.forEach((p, i) => {
    const realIdx = currentPhotos.indexOf(p);
    const card = buildCard(p, realIdx);
    setTimeout(() => {
      grid.appendChild(card);
      requestAnimationFrame(() => card.classList.add('visible'));
    }, i * 38);
  });
  // Update load more button
  const btn = document.getElementById('loadMore');
  if(filtered.length <= visibleCount){
    btn.textContent = 'All Memories Loaded';
    btn.style.opacity = '.38';
    btn.style.pointerEvents = 'none';
  } else {
    btn.textContent = 'Load More Memories';
    btn.style.opacity = '1';
    btn.style.pointerEvents = 'auto';
  }
}

/* ────────────── FILTER ──────────────────────────────── */
document.getElementById('filterBar').addEventListener('click', e => {
  const btn = e.target.closest('.filter-btn');
  if (!btn) return;
  document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  activeFilter = btn.dataset.filter;
  visibleCount = PER_PAGE;
  renderGallery(activeFilter);
  addRipple(e, btn);
});

/* ────────────── LOAD MORE ──────────────────────────── */
document.getElementById('loadMore').addEventListener('click', e => {
  addRipple(e, e.currentTarget);
  visibleCount += PER_PAGE;
  renderGallery(activeFilter);
});

/* ────────────── LIGHTBOX ────────────────────────────── */
let currentLBIdx = 0;
let touchStartX  = 0;
let touchStartY  = 0;

function openLightbox(idx) {
  currentLBIdx = idx;
  updateLightbox();
  const lb = document.getElementById('lightbox');
  lb.classList.add('open');
  document.body.style.overflow = 'hidden';
  document.getElementById('lightboxClose').focus();
}
function closeLightbox() {
  document.getElementById('lightbox').classList.remove('open');
  document.body.style.overflow = '';
}
function prevPhoto() {
  currentLBIdx = (currentLBIdx - 1 + currentPhotos.length) % currentPhotos.length;
  updateLightbox();
}
function nextPhoto() {
  currentLBIdx = (currentLBIdx + 1) % currentPhotos.length;
  updateLightbox();
}
function updateLightbox() {
  const p = currentPhotos[currentLBIdx];
  const img = document.getElementById('lightboxImg');
  img.style.opacity = '0';
  img.src = p.img;
  img.alt = p.title;
  img.onload = () => { img.style.transition='opacity .3s'; img.style.opacity='1'; };
  const tagEl = document.getElementById('lightboxTag');
  if (tagEl) tagEl.textContent = p.tag;
  const titleEl = document.getElementById('lightboxTitle');
  if (titleEl) titleEl.textContent = p.title;
  const counterEl = document.getElementById('lightboxCounter');
  if (counterEl) counterEl.textContent = `${currentLBIdx + 1} / ${currentPhotos.length}`;
}

const lbClose = document.getElementById('lightboxClose');
if (lbClose) lbClose.addEventListener('click', closeLightbox);
const lbPrev = document.getElementById('lightboxPrev');
if (lbPrev) lbPrev.addEventListener('click', prevPhoto);
const lbNext = document.getElementById('lightboxNext');
if (lbNext) lbNext.addEventListener('click', nextPhoto);

document.addEventListener('keydown', e => {
  if (!document.getElementById('lightbox').classList.contains('open')) return;
  if (e.key === 'ArrowRight') nextPhoto();
  if (e.key === 'ArrowLeft')  prevPhoto();
  if (e.key === 'Escape')     closeLightbox();
});

document.getElementById('lightbox').addEventListener('click', e => {
  if (e.target === document.getElementById('lightbox')) closeLightbox();
});

const lb = document.getElementById('lightbox');
lb.addEventListener('touchstart', e => {
  touchStartX = e.changedTouches[0].clientX;
  touchStartY = e.changedTouches[0].clientY;
}, {passive:true});
lb.addEventListener('touchend', e => {
  const dx = e.changedTouches[0].clientX - touchStartX;
  const dy = e.changedTouches[0].clientY - touchStartY;
  if (Math.abs(dx) > 50 && Math.abs(dx) > Math.abs(dy)) {
    if (dx < 0) nextPhoto(); else prevPhoto();
  }
}, {passive:true});



/* ────────────── NAVBAR SCROLL ───────────────────────── */
window.addEventListener('scroll', () => {
  const nav = document.getElementById('mainNav');
  if (nav) nav.classList.toggle('scrolled', window.scrollY > 50);
}, {passive:true});

/* ────────────── SCROLL REVEAL ───────────────────────── */
const revealObserver = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('visible'); });
}, {threshold:.09, rootMargin:'0px 0px -30px 0px'});
function observeReveals() {
  document.querySelectorAll('.reveal:not(.visible)').forEach(el => revealObserver.observe(el));
}
const mutationObserver = new MutationObserver(observeReveals);
mutationObserver.observe(document.getElementById('galleryGrid'), {childList:true});

/* ────────────── COUNT-UP ────────────────────────────── */
const countObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (!entry.isIntersecting) return;
    const el = entry.target, target = +el.dataset.count;
    let n = 0;
    const step = Math.ceil(target / 60);
    const t = setInterval(() => {
      n = Math.min(n + step, target);
      el.textContent = n < target ? n : target + '+';
      if (n >= target) clearInterval(t);
    }, 26);
    countObserver.unobserve(el);
  });
}, {threshold:.5});
document.querySelectorAll('[data-count]').forEach(el => countObserver.observe(el));

/* ────────────── MARQUEE ─────────────────────────────── */
const marqueeEl = document.getElementById('marquee');
marqueeEl.innerHTML += marqueeEl.innerHTML;
marqueeEl.addEventListener('mouseenter', () => marqueeEl.style.animationPlayState = 'paused');
marqueeEl.addEventListener('mouseleave', () => marqueeEl.style.animationPlayState = 'running');

/* ────────────── RIPPLE ──────────────────────────────── */
function addRipple(e, el) {
  if (!el) return;
  const rect = el.getBoundingClientRect();
  const r = document.createElement('span');
  r.className = 'ripple';
  const size = Math.max(rect.width, rect.height);
  const cx = e.clientX ?? (rect.left + rect.width/2);
  const cy = e.clientY ?? (rect.top  + rect.height/2);
  r.style.cssText = `width:${size}px;height:${size}px;left:${cx-rect.left-size/2}px;top:${cy-rect.top-size/2}px`;
  el.appendChild(r);
  r.addEventListener('animationend', () => r.remove());
}
document.querySelectorAll('.filter-btn,.load-more-btn').forEach(el => {
  el.addEventListener('pointerdown', e => addRipple(e, el));
});

/* ────────────── CUSTOM CURSOR ───────────────────────── */
if (matchMedia('(pointer:fine)').matches) {
  const cur  = document.getElementById('cursor');
  const ring = document.getElementById('cursorRing');
  document.addEventListener('mousemove', e => {
    cur.style.left  = e.clientX + 'px';
    cur.style.top   = e.clientY + 'px';
    setTimeout(() => { ring.style.left = e.clientX + 'px'; ring.style.top = e.clientY + 'px'; }, 80);
  });
  document.querySelectorAll('a,button,.gallery-item').forEach(el => {
    el.addEventListener('mouseenter', () => {
      cur.style.width=cur.style.height='18px';
      ring.style.width=ring.style.height='52px';
    });
    el.addEventListener('mouseleave', () => {
      cur.style.width=cur.style.height='10px';
      ring.style.width=ring.style.height='36px';
    });
  });
}

/* ────────────── INIT ────────────────────────────────── */
renderGallery('all');
setTimeout(observeReveals, 150);