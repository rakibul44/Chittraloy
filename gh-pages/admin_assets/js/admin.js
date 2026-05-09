/* ═══ Chittraloy Admin Dashboard JS ═══ */
const API_BASE = '/api/admin';
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

let adminData = {
  hero: [], projects: [], gallery: [], packages: [], testimonials: [], inquiries: [], contacts: [], settings: {}
};

/* ── API Helpers ── */
async function apiGet(endpoint) {
  const res = await fetch(API_BASE + endpoint);
  return await res.json();
}

async function apiPost(endpoint, data) {
  const isFormData = data instanceof FormData;
  const options = {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    body: isFormData ? data : JSON.stringify(data)
  };
  
  if (!isFormData) {
    options.headers['Content-Type'] = 'application/json';
  }

  const res = await fetch(API_BASE + endpoint, options);
  return await res.json();
}

async function apiDelete(endpoint) {
  const res = await fetch(API_BASE + endpoint, {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': csrfToken
    }
  });
  return await res.json();
}

/* ── Sidebar Navigation ── */
function initNav(){
  document.querySelectorAll('.nav-item[data-section]').forEach(btn=>{
    btn.addEventListener('click',()=>{
      document.querySelectorAll('.nav-item').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      document.querySelectorAll('.content-section').forEach(s=>s.classList.remove('active'));
      const sec = document.getElementById('sec-'+btn.dataset.section);
      if(sec) sec.classList.add('active');
      document.getElementById('pageTitle').textContent = btn.textContent.trim().replace(/\d+$/,'').trim();
      // close mobile sidebar
      document.getElementById('sidebar').classList.remove('open');
      document.getElementById('sidebarOverlay').classList.remove('open');
    });
  });
}

/* ── Mobile Sidebar ── */
function initMobile(){
  const btn=document.getElementById('hamburgerBtn'), sb=document.getElementById('sidebar'), ov=document.getElementById('sidebarOverlay');
  btn.addEventListener('click',()=>{ sb.classList.toggle('open'); ov.classList.toggle('open'); });
  ov.addEventListener('click',()=>{ sb.classList.remove('open'); ov.classList.remove('open'); });
}

/* ── Tabs ── */
function initTabs(){
  document.querySelectorAll('.tab-btn').forEach(btn=>{
    btn.addEventListener('click',()=>{
      document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      ['general','social','footer'].forEach(t=>{
        const el=document.getElementById('tab-'+t);
        if(el) el.style.display = t===btn.dataset.tab?'block':'none';
      });
    });
  });
}

/* ── Toast ── */
function toast(msg, type='success'){
  const c=document.getElementById('toastContainer');
  const t=document.createElement('div');
  t.className='toast '+type;
  t.innerHTML=`<i class="fas fa-${type==='success'?'check-circle':'exclamation-circle'}" style="color:var(--${type==='success'?'success':'danger'})"></i> ${msg}`;
  c.appendChild(t);
  setTimeout(()=>{ t.style.opacity='0'; t.style.transform='translateX(40px)'; setTimeout(()=>t.remove(),300); },3000);
}

/* ── Modal ── */
function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }

/* ═══ RENDER FUNCTIONS ═══ */
function renderDashboard(){
  document.getElementById('statProjects').textContent = adminData.projects.length;
  document.getElementById('statGallery').textContent = adminData.gallery.length;
  document.getElementById('statInquiries').textContent = adminData.inquiries.length;
  document.getElementById('statTestimonials').textContent = adminData.testimonials.length;
  const ib = document.getElementById('inquiryBadge');
  const pending = adminData.inquiries.filter(i=>i.status==='pending').length;
  ib.textContent = pending; ib.style.display = pending?'inline':'none';
  // Recent inquiries
  const tbody = document.querySelector('#recentInquiriesTable tbody');
  tbody.innerHTML = '';
  adminData.inquiries.slice(0,5).forEach(i=>{
    tbody.innerHTML += `<tr><td>${i.name}</td><td>${i.email}</td><td>${i.package||'—'}</td><td>${i.date||'—'}</td><td><span class="status status-${i.status==='replied'?'active':i.status==='pending'?'pending':'inactive'}">${i.status}</span></td></tr>`;
  });
  if(!adminData.inquiries.length) tbody.innerHTML='<tr><td colspan="5" style="text-align:center;color:var(--text-muted)">No inquiries yet</td></tr>';
}

function renderHero(){
  const tbody = document.querySelector('#heroTable tbody'); tbody.innerHTML='';
  adminData.hero.forEach(h=>{
    tbody.innerHTML += `<tr>
      <td><img src="${h.bg}" class="table-img" alt="slide"/></td>
      <td>${h.tag}</td><td>${h.title.replace(/\|/g,' ')}</td><td>${h.subtitle}</td>
      <td><div class="table-actions"><button onclick="editHero(${h.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('hero',${h.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderProjects(){
  const tbody = document.querySelector('#projectsTable tbody'); tbody.innerHTML='';
  adminData.projects.forEach(p=>{
    tbody.innerHTML += `<tr>
      <td><img src="${p.img}" class="table-img" alt="project"/></td>
      <td>${p.couple}</td><td>${p.location}</td><td>${p.season}</td><td><span class="feature-tag">${p.size}</span></td>
      <td><div class="table-actions"><button onclick="editProject(${p.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('projects',${p.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderGallery(){
  const tbody = document.querySelector('#galleryTable tbody'); tbody.innerHTML='';
  adminData.gallery.sort((a,b)=>a.order-b.order).forEach(g=>{
    const catLabel = g.category ? g.category.charAt(0).toUpperCase()+g.category.slice(1) : '—';
    tbody.innerHTML += `<tr>
      <td><img src="${g.img}" class="table-img" alt="gallery"/></td>
      <td>${g.title||g.alt||'—'}</td><td><span class="feature-tag">${catLabel}</span></td><td>${g.order}</td>
      <td><div class="table-actions"><button onclick="editGalleryItem(${g.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('gallery',${g.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderPackages(){
  const tbody = document.querySelector('#packagesTable tbody'); tbody.innerHTML='';
  adminData.packages.forEach(p=>{
    const fc = (p.features||'').split('\n').filter(f=>f.trim()).length;
    tbody.innerHTML += `<tr>
      <td>${p.name}</td><td>৳${Number(p.price).toLocaleString()}</td>
      <td>${p.featured?'<span class="status status-active">Yes</span>':'<span class="status status-inactive">No</span>'}</td>
      <td>${fc} features</td>
      <td><div class="table-actions"><button onclick="editPackage(${p.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('packages',${p.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderTestimonials(){
  const tbody = document.querySelector('#testimonialsTable tbody'); tbody.innerHTML='';
  adminData.testimonials.forEach(t=>{
    tbody.innerHTML += `<tr>
      <td>${t.couple}</td><td>${t.location}</td><td>${'★'.repeat(t.rating)+'☆'.repeat(5-t.rating)}</td>
      <td>${t.quote.substring(0,60)}...</td>
      <td><div class="table-actions"><button onclick="editTestimonial(${t.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('testimonials',${t.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderInquiries(){
  const tbody = document.querySelector('#inquiriesTable tbody'); tbody.innerHTML='';
  adminData.inquiries.forEach(i=>{
    tbody.innerHTML += `<tr>
      <td>${i.name}</td><td>${i.partner||'—'}</td><td>${i.email}</td><td>${i.date||'—'}</td>
      <td>${i.package||'—'}</td>
      <td><span class="status status-${i.status==='replied'?'active':i.status==='pending'?'pending':'inactive'}">${i.status}</span></td>
      <td><div class="table-actions"><button onclick="viewInquiry(${i.id})" title="View"><i class="fas fa-eye"></i></button><button onclick="toggleInquiryStatus(${i.id})" title="Toggle Status"><i class="fas fa-check"></i></button><button class="delete" onclick="deleteItem('inquiries',${i.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderContacts(){
  const tbody = document.querySelector('#contactsTable tbody'); tbody.innerHTML='';
  adminData.contacts.forEach(c=>{
    tbody.innerHTML += `<tr>
      <td>${c.name}</td><td>${c.email}</td><td>${c.subject}</td>
      <td>${(c.message||'').substring(0,50)}...</td><td>${c.created_at?c.created_at.substring(0,10):'—'}</td>
      <td><div class="table-actions"><button class="delete" onclick="deleteItem('contacts',${c.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderSettings() {
  const s = adminData.settings;
  const fields = [
    'aboutTag','aboutYears','aboutTitle','aboutDesc1','aboutDesc2',
    'aboutStat1Val','aboutStat1Lbl','aboutStat2Val','aboutStat2Lbl',
    'aboutStat3Val','aboutStat3Lbl','aboutImg1','aboutImg2',
    'videoCover','videoUrl','videoTitle','videoSub',
    'siteName','siteEmail','ctaTag','ctaTitle','ctaSub',
    'socialIg','socialPi','socialFb','socialYt',
    'footerTagline','footerLocations','footerCopy'
  ];
  fields.forEach(f => {
    const el = document.getElementById(f);
    if(el && s[f] !== undefined) el.value = s[f];
  });
}

/* ═══ DATA FETCH ═══ */
async function loadData() {
  try {
    const data = await apiGet('/data');
    adminData = data;
    renderAll();
  } catch (error) {
    console.error('Error loading data:', error);
    toast('Error loading data from server', 'danger');
  }
}

/* ═══ CRUD ═══ */
async function deleteItem(model, id){
  if(!confirm('Are you sure you want to delete this item?')) return;
  try {
    await apiDelete(`/${model}/${id}`);
    toast('Item deleted','success');
    await loadData();
  } catch (error) {
    toast('Error deleting item', 'danger');
  }
}

// Hero
async function saveHero(){
  const eid = document.getElementById('heroEditId').value;
  const formData = new FormData();
  
  if(eid) formData.append('id', eid);
  formData.append('tag', document.getElementById('heroTag').value);
  formData.append('title', document.getElementById('heroTitleInput').value);
  formData.append('subtitle', document.getElementById('heroSubtitle').value);
  formData.append('btn1', document.getElementById('heroBtn1').value);
  formData.append('btn2', document.getElementById('heroBtn2').value);
  formData.append('bg_url', document.getElementById('heroBgUrl').value); // Send existing URL if any
  
  const fileInput = document.getElementById('heroBgFile');
  if(fileInput.files.length > 0) {
    formData.append('bg_file', fileInput.files[0]);
  }

  try {
    const res = await apiPost('/hero', formData);
    if(res.error) throw new Error(res.error);
    
    closeModal('heroModal');
    toast('Hero slide saved');
    document.getElementById('heroForm').reset();
    document.getElementById('heroEditId').value='';
    await loadData();
  } catch (error) {
    console.error(error);
    toast(error.message || 'Error saving hero', 'danger');
  }
}
function editHero(id){
  const h=adminData.hero.find(i=>i.id===id); if(!h)return;
  document.getElementById('heroEditId').value=h.id;
  document.getElementById('heroTag').value=h.tag;
  document.getElementById('heroTitleInput').value=h.title;
  document.getElementById('heroSubtitle').value=h.subtitle;
  document.getElementById('heroBgUrl').value=h.bg;
  document.getElementById('heroBgFile').value=''; // Reset file input
  document.getElementById('heroBtn1').value=h.btn1||'';
  document.getElementById('heroBtn2').value=h.btn2||'';
  document.getElementById('heroModalTitle').textContent='Edit Hero Slide';
  openModal('heroModal');
}

// Projects
async function saveProject(){
  const eid=document.getElementById('projectEditId').value;
  const obj={couple:document.getElementById('projectCouple').value,location:document.getElementById('projectLocation').value,season:document.getElementById('projectSeason').value,img:document.getElementById('projectImgUrl').value,size:document.getElementById('projectSize').value};
  if(eid) obj.id = eid;

  try {
    await apiPost('/projects', obj);
    closeModal('projectModal');
    toast('Project saved');
    document.getElementById('projectForm').reset();
    document.getElementById('projectEditId').value='';
    await loadData();
  } catch (error) {
    toast('Error saving project', 'danger');
  }
}
function editProject(id){
  const p=adminData.projects.find(i=>i.id===id);if(!p)return;
  document.getElementById('projectEditId').value=p.id;
  document.getElementById('projectCouple').value=p.couple;
  document.getElementById('projectLocation').value=p.location;
  document.getElementById('projectSeason').value=p.season;
  document.getElementById('projectImgUrl').value=p.img;
  document.getElementById('projectSize').value=p.size;
  document.getElementById('projectModalTitle').textContent='Edit Project';
  openModal('projectModal');
}

// Gallery
async function saveGalleryItem(){
  const eid=document.getElementById('galleryEditId').value;
  const cat=document.getElementById('galleryCategory').value;
  const obj={img:document.getElementById('galleryImgUrl').value,alt:document.getElementById('galleryAlt').value,title:document.getElementById('galleryTitle').value,category:cat,tag:cat.charAt(0).toUpperCase()+cat.slice(1),order:parseInt(document.getElementById('galleryOrder').value)||1};
  if(eid) obj.id = eid;

  try {
    await apiPost('/gallery', obj);
    closeModal('galleryModal');
    toast('Gallery photo saved — visible on website & gallery page');
    document.getElementById('galleryForm').reset();
    document.getElementById('galleryEditId').value='';
    await loadData();
  } catch (error) {
    toast('Error saving gallery item', 'danger');
  }
}
function editGalleryItem(id){
  const g=adminData.gallery.find(i=>i.id===id);if(!g)return;
  document.getElementById('galleryEditId').value=g.id;
  document.getElementById('galleryImgUrl').value=g.img;
  document.getElementById('galleryAlt').value=g.alt||'';
  document.getElementById('galleryTitle').value=g.title||'';
  document.getElementById('galleryCategory').value=g.category||'ceremony';
  document.getElementById('galleryOrder').value=g.order;
  document.getElementById('galleryModalTitle').textContent='Edit Gallery Photo';
  openModal('galleryModal');
}

// Packages
async function savePackage(){
  const eid=document.getElementById('packageEditId').value;
  const obj={name:document.getElementById('packageName').value,price:document.getElementById('packagePrice').value,features:document.getElementById('packageFeatures').value,featured:document.getElementById('packageFeatured').checked,badge:document.getElementById('packageBadge').value};
  if(eid) obj.id = eid;

  try {
    await apiPost('/packages', obj);
    closeModal('packageModal');
    toast('Package saved');
    document.getElementById('packageForm').reset();
    document.getElementById('packageEditId').value='';
    await loadData();
  } catch (error) {
    toast('Error saving package', 'danger');
  }
}
function editPackage(id){
  const p=adminData.packages.find(i=>i.id===id);if(!p)return;
  document.getElementById('packageEditId').value=p.id;
  document.getElementById('packageName').value=p.name;
  document.getElementById('packagePrice').value=p.price;
  document.getElementById('packageFeatures').value=p.features;
  document.getElementById('packageFeatured').checked=p.featured;
  document.getElementById('packageBadge').value=p.badge||'';
  document.getElementById('packageModalTitle').textContent='Edit Package';
  openModal('packageModal');
}

// Testimonials
async function saveTestimonial(){
  const eid=document.getElementById('testimonialEditId').value;
  const obj={couple:document.getElementById('testiCouple').value,location:document.getElementById('testiLocation').value,rating:parseInt(document.getElementById('testiRating').value),quote:document.getElementById('testiQuote').value};
  if(eid) obj.id = eid;

  try {
    await apiPost('/testimonials', obj);
    closeModal('testimonialModal');
    toast('Testimonial saved');
    document.getElementById('testimonialForm').reset();
    document.getElementById('testimonialEditId').value='';
    await loadData();
  } catch (error) {
    toast('Error saving testimonial', 'danger');
  }
}
function editTestimonial(id){
  const t=adminData.testimonials.find(i=>i.id===id);if(!t)return;
  document.getElementById('testimonialEditId').value=t.id;
  document.getElementById('testiCouple').value=t.couple;
  document.getElementById('testiLocation').value=t.location;
  document.getElementById('testiRating').value=t.rating;
  document.getElementById('testiQuote').value=t.quote;
  document.getElementById('testimonialModalTitle').textContent='Edit Testimonial';
  openModal('testimonialModal');
}

// Inquiries
function viewInquiry(id){
  const i=adminData.inquiries.find(x=>x.id===id);if(!i)return;
  document.getElementById('inquiryDetailBody').innerHTML=`
    <div class="form-row"><div class="form-group"><label class="form-label">Name</label><p style="color:var(--cream)">${i.name}</p></div><div class="form-group"><label class="form-label">Partner</label><p style="color:var(--cream)">${i.partner||'—'}</p></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Email</label><p style="color:var(--cream)">${i.email}</p></div><div class="form-group"><label class="form-label">Phone</label><p style="color:var(--cream)">${i.phone||'—'}</p></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Wedding Date</label><p style="color:var(--cream)">${i.date||'—'}</p></div><div class="form-group"><label class="form-label">Package</label><p style="color:var(--cream)">${i.package||'—'}</p></div></div>
    <div class="form-group"><label class="form-label">Venue</label><p style="color:var(--cream)">${i.venue||'—'}</p></div>
    <div class="form-group"><label class="form-label">Message</label><p style="color:var(--text-secondary)">${i.message||'—'}</p></div>
    <div class="form-group"><label class="form-label">Status</label><span class="status status-${i.status==='replied'?'active':'pending'}">${i.status}</span></div>`;
  openModal('inquiryDetailModal');
}
async function toggleInquiryStatus(id){
  try {
    await apiPost(`/inquiries/${id}/status`, {});
    toast('Status updated');
    await loadData();
  } catch (error) {
    toast('Error updating status', 'danger');
  }
}

async function saveSettingsSection(fields) {
  const obj = {};
  fields.forEach(f => {
    const el = document.getElementById(f);
    if (el) obj[f] = el.value;
  });
  
  try {
    await apiPost('/settings', obj);
    toast('Settings saved');
    await loadData();
  } catch (error) {
    toast('Error saving settings', 'danger');
  }
}

// Forms
function initForms(){
  document.getElementById('aboutForm').addEventListener('submit',e=>{
    e.preventDefault();
    saveSettingsSection(['aboutTag','aboutYears','aboutTitle','aboutDesc1','aboutDesc2','aboutStat1Val','aboutStat1Lbl','aboutStat2Val','aboutStat2Lbl','aboutStat3Val','aboutStat3Lbl','aboutImg1','aboutImg2']);
  });
  document.getElementById('videoForm').addEventListener('submit',e=>{
    e.preventDefault();
    saveSettingsSection(['videoCover','videoUrl','videoTitle','videoSub']);
  });
  document.getElementById('settingsForm').addEventListener('submit',e=>{
    e.preventDefault();
    saveSettingsSection(['siteName','siteEmail','ctaTag','ctaTitle','ctaSub','socialIg','socialPi','socialFb','socialYt','footerTagline','footerLocations','footerCopy']);
  });
}

/* ═══ RENDER ALL ═══ */
function renderAll(){
  renderDashboard();renderHero();renderProjects();renderGallery();
  renderPackages();renderTestimonials();renderInquiries();renderContacts();
  renderSettings();
}

/* ═══ INIT ═══ */
document.addEventListener('DOMContentLoaded',()=>{
  initNav();initMobile();initTabs();initForms();
  loadData();
});
