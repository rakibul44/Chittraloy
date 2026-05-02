/* ═══ Chittraloy Admin Dashboard JS ═══ */
const API_BASE = '/api';
const LS = key => JSON.parse(localStorage.getItem('admin_'+key) || '[]');
const SS = (key,val) => localStorage.setItem('admin_'+key, JSON.stringify(val));

/* ── Default Data ── */
function initDefaults(){
  if(!localStorage.getItem('admin_hero')){
    SS('hero',[
      {id:1,tag:'Award Winning Photography',title:'Where Love|Becomes Art',subtitle:'Timeless moments · Genuine emotion · Eternal memories',bg:'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=1800&q=80',btn1:'Discover More',btn2:'Book Session'},
      {id:2,tag:'Luxury Wedding Photography',title:'Every Frame|Tells a Story',subtitle:'Capturing the in-between · The laughs · The tears',bg:'https://images.unsplash.com/photo-1519741497674-611481863552?w=1800&q=80',btn1:'View Gallery',btn2:'Book Session'},
      {id:3,tag:'Your Day · Your Story',title:'Begin Your|Forever Here',subtitle:'Photography & Cinematography for discerning couples',bg:'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=1800&q=80',btn1:'See Packages',btn2:'Book Session'}
    ]);
  }
  if(!localStorage.getItem('admin_projects')){
    SS('projects',[
      {id:1,couple:'Sofia & Marcus',location:'Amalfi Coast, Italy',season:'Summer 2024',img:'https://images.unsplash.com/photo-1550005809-91ad75fb315f?w=900&q=80',size:'lg'},
      {id:2,couple:'Amara & James',location:'Santorini, Greece',season:'Spring 2024',img:'https://images.unsplash.com/photo-1591604466107-ec97de577aff?w=900&q=80',size:'sm'},
      {id:3,couple:'Chloe & Rafael',location:'Tuscany, Italy',season:'Autumn 2023',img:'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?w=900&q=80',size:'sm'}
    ]);
  }
  if(!localStorage.getItem('admin_gallery')){
    SS('gallery',[
      {id:1,img:'https://images.unsplash.com/photo-1519741497674-611481863552?w=900&q=80',alt:'Gallery 1',title:'Sacred Vows',category:'ceremony',tag:'Ceremony',order:1},
      {id:2,img:'https://images.unsplash.com/photo-1583939003579-730e3918a45a?w=600&q=80',alt:'Gallery 2',title:'Golden Hour Kiss',category:'portrait',tag:'Portraits',order:2},
      {id:3,img:'https://images.unsplash.com/photo-1606216794074-735e91aa2c92?w=600&q=80',alt:'Gallery 3',title:'Bridal Radiance',category:'bridal',tag:'Bridal',order:3},
      {id:4,img:'https://images.unsplash.com/photo-1460978812857-470ed1c77af0?w=900&q=80',alt:'Gallery 4',title:'First Dance',category:'reception',tag:'Reception',order:4},
      {id:5,img:'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&q=80',alt:'Gallery 5',title:'Floral Elegance',category:'details',tag:'Details',order:5},
      {id:6,img:'https://images.unsplash.com/photo-1537633552985-df8429e8048b?w=900&q=80',alt:'Gallery 6',title:'Forever Begins',category:'portrait',tag:'Portraits',order:6}
    ]);
  }
  if(!localStorage.getItem('admin_packages')){
    SS('packages',[
      {id:1,name:'Essence',price:1800,featured:false,badge:'',features:'6 Hours Coverage\n1 Photographer\n300+ Edited Photos\nOnline Gallery\nUSB Delivery\n-Engagement Session\n-Wedding Film'},
      {id:2,name:'Lumière',price:3200,featured:true,badge:'Most Popular',features:'Full Day (10 hrs)\n2 Photographers\n600+ Edited Photos\nPrivate Gallery\nFine Art Album\nEngagement Session\n-Wedding Film'},
      {id:3,name:'Forever',price:5500,featured:false,badge:'',features:'Full Day + Rehearsal\n2 Photographers + Videographer\nUnlimited Edited Photos\nPrivate Gallery\nLuxury Heirloom Album\nEngagement Session\nCinematic Wedding Film'}
    ]);
  }
  if(!localStorage.getItem('admin_testimonials')){
    SS('testimonials',[
      {id:1,couple:'Sofia & Marcus',location:'Amalfi Coast 2024',rating:5,quote:'They captured moments we didn\'t even know were happening. Every photo made us cry happy tears.'},
      {id:2,couple:'Amara & James',location:'Santorini 2024',rating:5,quote:'From first consultation to delivery, the experience was flawless. The photos look like scenes from a movie.'},
      {id:3,couple:'Chloe & Rafael',location:'Tuscany 2023',rating:5,quote:'The most talented photographers we\'ve encountered. They made us feel at ease and the results are breathtaking.'}
    ]);
  }
  if(!localStorage.getItem('admin_inquiries')){
    SS('inquiries',[
      {id:1,name:'Elena',partner:'David',email:'elena@example.com',phone:'+1 555-0101',date:'2025-06-15',package:'Lumière – $3,200',venue:'Central Park',message:'We are so excited!',status:'pending',created:'2025-04-28'},
      {id:2,name:'Sarah',partner:'Michael',email:'sarah@example.com',phone:'+1 555-0202',date:'2025-09-20',package:'Forever – $5,500',venue:'Tuscany Villa',message:'Dream destination wedding',status:'pending',created:'2025-04-30'},
      {id:3,name:'Priya',partner:'Arjun',email:'priya@example.com',phone:'+1 555-0303',date:'2025-08-10',package:'Essence – $1,800',venue:'Botanical Garden',message:'Intimate ceremony',status:'pending',created:'2025-05-01'}
    ]);
  }
  if(!localStorage.getItem('admin_contacts')){
    SS('contacts',[
      {id:1,name:'John Doe',email:'john@test.com',subject:'Availability',message:'Are you available for Dec 2025?',created:'2025-04-29'}
    ]);
  }
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

/* ── Next ID ── */
function nextId(arr){ return arr.length ? Math.max(...arr.map(i=>i.id))+1 : 1; }

/* ═══ RENDER FUNCTIONS ═══ */
function renderDashboard(){
  document.getElementById('statProjects').textContent = LS('projects').length;
  document.getElementById('statGallery').textContent = LS('gallery').length;
  document.getElementById('statInquiries').textContent = LS('inquiries').length;
  document.getElementById('statTestimonials').textContent = LS('testimonials').length;
  const ib = document.getElementById('inquiryBadge');
  const pending = LS('inquiries').filter(i=>i.status==='pending').length;
  ib.textContent = pending; ib.style.display = pending?'inline':'none';
  // Recent inquiries
  const tbody = document.querySelector('#recentInquiriesTable tbody');
  tbody.innerHTML = '';
  LS('inquiries').slice(0,5).forEach(i=>{
    tbody.innerHTML += `<tr><td>${i.name}</td><td>${i.email}</td><td>${i.package||'—'}</td><td>${i.date||'—'}</td><td><span class="status status-${i.status==='replied'?'active':i.status==='pending'?'pending':'inactive'}">${i.status}</span></td></tr>`;
  });
  if(!LS('inquiries').length) tbody.innerHTML='<tr><td colspan="5" style="text-align:center;color:var(--text-muted)">No inquiries yet</td></tr>';
}

function renderHero(){
  const tbody = document.querySelector('#heroTable tbody'); tbody.innerHTML='';
  LS('hero').forEach(h=>{
    tbody.innerHTML += `<tr>
      <td><img src="${h.bg}" class="table-img" alt="slide"/></td>
      <td>${h.tag}</td><td>${h.title.replace(/\|/g,' ')}</td><td>${h.subtitle}</td>
      <td><div class="table-actions"><button onclick="editHero(${h.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('hero',${h.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderProjects(){
  const tbody = document.querySelector('#projectsTable tbody'); tbody.innerHTML='';
  LS('projects').forEach(p=>{
    tbody.innerHTML += `<tr>
      <td><img src="${p.img}" class="table-img" alt="project"/></td>
      <td>${p.couple}</td><td>${p.location}</td><td>${p.season}</td><td><span class="feature-tag">${p.size}</span></td>
      <td><div class="table-actions"><button onclick="editProject(${p.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('projects',${p.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderGallery(){
  const tbody = document.querySelector('#galleryTable tbody'); tbody.innerHTML='';
  LS('gallery').sort((a,b)=>a.order-b.order).forEach(g=>{
    const catLabel = g.category ? g.category.charAt(0).toUpperCase()+g.category.slice(1) : '—';
    tbody.innerHTML += `<tr>
      <td><img src="${g.img}" class="table-img" alt="gallery"/></td>
      <td>${g.title||g.alt||'—'}</td><td><span class="feature-tag">${catLabel}</span></td><td>${g.order}</td>
      <td><div class="table-actions"><button onclick="editGalleryItem(${g.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('gallery',${g.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderPackages(){
  const tbody = document.querySelector('#packagesTable tbody'); tbody.innerHTML='';
  LS('packages').forEach(p=>{
    const fc = (p.features||'').split('\n').filter(f=>f.trim()).length;
    tbody.innerHTML += `<tr>
      <td>${p.name}</td><td>$${Number(p.price).toLocaleString()}</td>
      <td>${p.featured?'<span class="status status-active">Yes</span>':'<span class="status status-inactive">No</span>'}</td>
      <td>${fc} features</td>
      <td><div class="table-actions"><button onclick="editPackage(${p.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('packages',${p.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderTestimonials(){
  const tbody = document.querySelector('#testimonialsTable tbody'); tbody.innerHTML='';
  LS('testimonials').forEach(t=>{
    tbody.innerHTML += `<tr>
      <td>${t.couple}</td><td>${t.location}</td><td>${'★'.repeat(t.rating)+'☆'.repeat(5-t.rating)}</td>
      <td>${t.quote.substring(0,60)}...</td>
      <td><div class="table-actions"><button onclick="editTestimonial(${t.id})" title="Edit"><i class="fas fa-pen"></i></button><button class="delete" onclick="deleteItem('testimonials',${t.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderInquiries(){
  const tbody = document.querySelector('#inquiriesTable tbody'); tbody.innerHTML='';
  LS('inquiries').forEach(i=>{
    tbody.innerHTML += `<tr>
      <td>${i.name}</td><td>${i.partner||'—'}</td><td>${i.email}</td><td>${i.date||'—'}</td>
      <td>${i.package||'—'}</td>
      <td><span class="status status-${i.status==='replied'?'active':i.status==='pending'?'pending':'inactive'}">${i.status}</span></td>
      <td><div class="table-actions"><button onclick="viewInquiry(${i.id})" title="View"><i class="fas fa-eye"></i></button><button onclick="toggleInquiryStatus(${i.id})" title="Toggle Status"><i class="fas fa-check"></i></button><button class="delete" onclick="deleteItem('inquiries',${i.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

function renderContacts(){
  const tbody = document.querySelector('#contactsTable tbody'); tbody.innerHTML='';
  LS('contacts').forEach(c=>{
    tbody.innerHTML += `<tr>
      <td>${c.name}</td><td>${c.email}</td><td>${c.subject}</td>
      <td>${(c.message||'').substring(0,50)}...</td><td>${c.created||'—'}</td>
      <td><div class="table-actions"><button class="delete" onclick="deleteItem('contacts',${c.id})" title="Delete"><i class="fas fa-trash"></i></button></div></td></tr>`;
  });
}

/* ═══ CRUD ═══ */
function deleteItem(key, id){
  if(!confirm('Are you sure you want to delete this item?')) return;
  SS(key, LS(key).filter(i=>i.id!==id));
  renderAll(); toast('Item deleted','success');
}

// Hero
function saveHero(){
  const data = LS('hero'), eid = document.getElementById('heroEditId').value;
  const obj = { tag:document.getElementById('heroTag').value, title:document.getElementById('heroTitleInput').value, subtitle:document.getElementById('heroSubtitle').value, bg:document.getElementById('heroBgUrl').value, btn1:document.getElementById('heroBtn1').value, btn2:document.getElementById('heroBtn2').value };
  if(eid){ const idx=data.findIndex(i=>i.id==eid); if(idx>-1){data[idx]={...data[idx],...obj};} }
  else { obj.id=nextId(data); data.push(obj); }
  SS('hero',data); closeModal('heroModal'); renderAll(); toast('Hero slide saved');
  document.getElementById('heroForm').reset(); document.getElementById('heroEditId').value='';
}
function editHero(id){
  const h=LS('hero').find(i=>i.id===id); if(!h)return;
  document.getElementById('heroEditId').value=h.id;
  document.getElementById('heroTag').value=h.tag;
  document.getElementById('heroTitleInput').value=h.title;
  document.getElementById('heroSubtitle').value=h.subtitle;
  document.getElementById('heroBgUrl').value=h.bg;
  document.getElementById('heroBtn1').value=h.btn1||'';
  document.getElementById('heroBtn2').value=h.btn2||'';
  document.getElementById('heroModalTitle').textContent='Edit Hero Slide';
  openModal('heroModal');
}

// Projects
function saveProject(){
  const data=LS('projects'), eid=document.getElementById('projectEditId').value;
  const obj={couple:document.getElementById('projectCouple').value,location:document.getElementById('projectLocation').value,season:document.getElementById('projectSeason').value,img:document.getElementById('projectImgUrl').value,size:document.getElementById('projectSize').value};
  if(eid){const idx=data.findIndex(i=>i.id==eid);if(idx>-1)data[idx]={...data[idx],...obj};}
  else{obj.id=nextId(data);data.push(obj);}
  SS('projects',data);closeModal('projectModal');renderAll();toast('Project saved');
  document.getElementById('projectForm').reset();document.getElementById('projectEditId').value='';
}
function editProject(id){
  const p=LS('projects').find(i=>i.id===id);if(!p)return;
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
function saveGalleryItem(){
  const data=LS('gallery'),eid=document.getElementById('galleryEditId').value;
  const cat=document.getElementById('galleryCategory').value;
  const obj={img:document.getElementById('galleryImgUrl').value,alt:document.getElementById('galleryAlt').value,title:document.getElementById('galleryTitle').value,category:cat,tag:cat.charAt(0).toUpperCase()+cat.slice(1),order:parseInt(document.getElementById('galleryOrder').value)||1};
  if(eid){const idx=data.findIndex(i=>i.id==eid);if(idx>-1)data[idx]={...data[idx],...obj};}
  else{obj.id=nextId(data);data.push(obj);}
  SS('gallery',data);closeModal('galleryModal');renderAll();toast('Gallery photo saved — visible on website & gallery page');
  document.getElementById('galleryForm').reset();document.getElementById('galleryEditId').value='';
}
function editGalleryItem(id){
  const g=LS('gallery').find(i=>i.id===id);if(!g)return;
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
function savePackage(){
  const data=LS('packages'),eid=document.getElementById('packageEditId').value;
  const obj={name:document.getElementById('packageName').value,price:document.getElementById('packagePrice').value,features:document.getElementById('packageFeatures').value,featured:document.getElementById('packageFeatured').checked,badge:document.getElementById('packageBadge').value};
  if(eid){const idx=data.findIndex(i=>i.id==eid);if(idx>-1)data[idx]={...data[idx],...obj};}
  else{obj.id=nextId(data);data.push(obj);}
  SS('packages',data);closeModal('packageModal');renderAll();toast('Package saved');
  document.getElementById('packageForm').reset();document.getElementById('packageEditId').value='';
}
function editPackage(id){
  const p=LS('packages').find(i=>i.id===id);if(!p)return;
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
function saveTestimonial(){
  const data=LS('testimonials'),eid=document.getElementById('testimonialEditId').value;
  const obj={couple:document.getElementById('testiCouple').value,location:document.getElementById('testiLocation').value,rating:parseInt(document.getElementById('testiRating').value),quote:document.getElementById('testiQuote').value};
  if(eid){const idx=data.findIndex(i=>i.id==eid);if(idx>-1)data[idx]={...data[idx],...obj};}
  else{obj.id=nextId(data);data.push(obj);}
  SS('testimonials',data);closeModal('testimonialModal');renderAll();toast('Testimonial saved');
  document.getElementById('testimonialForm').reset();document.getElementById('testimonialEditId').value='';
}
function editTestimonial(id){
  const t=LS('testimonials').find(i=>i.id===id);if(!t)return;
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
  const i=LS('inquiries').find(x=>x.id===id);if(!i)return;
  document.getElementById('inquiryDetailBody').innerHTML=`
    <div class="form-row"><div class="form-group"><label class="form-label">Name</label><p style="color:var(--cream)">${i.name}</p></div><div class="form-group"><label class="form-label">Partner</label><p style="color:var(--cream)">${i.partner||'—'}</p></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Email</label><p style="color:var(--cream)">${i.email}</p></div><div class="form-group"><label class="form-label">Phone</label><p style="color:var(--cream)">${i.phone||'—'}</p></div></div>
    <div class="form-row"><div class="form-group"><label class="form-label">Wedding Date</label><p style="color:var(--cream)">${i.date||'—'}</p></div><div class="form-group"><label class="form-label">Package</label><p style="color:var(--cream)">${i.package||'—'}</p></div></div>
    <div class="form-group"><label class="form-label">Venue</label><p style="color:var(--cream)">${i.venue||'—'}</p></div>
    <div class="form-group"><label class="form-label">Message</label><p style="color:var(--text-secondary)">${i.message||'—'}</p></div>
    <div class="form-group"><label class="form-label">Status</label><span class="status status-${i.status==='replied'?'active':'pending'}">${i.status}</span></div>`;
  openModal('inquiryDetailModal');
}
function toggleInquiryStatus(id){
  const data=LS('inquiries'),idx=data.findIndex(i=>i.id===id);
  if(idx>-1){data[idx].status=data[idx].status==='pending'?'replied':'pending';SS('inquiries',data);renderAll();toast('Status updated');}
}

// Forms
function initForms(){
  document.getElementById('aboutForm').addEventListener('submit',e=>{e.preventDefault();toast('About section saved');});
  document.getElementById('videoForm').addEventListener('submit',e=>{e.preventDefault();toast('Video section saved');});
  document.getElementById('settingsForm').addEventListener('submit',e=>{e.preventDefault();toast('Settings saved');});
}

/* ═══ RENDER ALL ═══ */
function renderAll(){
  renderDashboard();renderHero();renderProjects();renderGallery();
  renderPackages();renderTestimonials();renderInquiries();renderContacts();
}

/* ═══ INIT ═══ */
document.addEventListener('DOMContentLoaded',()=>{
  initDefaults();initNav();initMobile();initTabs();initForms();renderAll();
});
