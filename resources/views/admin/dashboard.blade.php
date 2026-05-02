@extends('layouts.admin')

@section('content')
<!-- ══════ DASHBOARD ══════ -->
<div class="content-section active" id="sec-dashboard">
<div class="stats-grid" id="statsGrid">
    <div class="stat-card"><div class="stat-icon"><i class="fas fa-images"></i></div><div class="stat-value" id="statProjects">0</div><div class="stat-label">Projects</div><div class="stat-change up"><i class="fas fa-arrow-up"></i> Active</div></div>
    <div class="stat-card"><div class="stat-icon"><i class="fas fa-camera"></i></div><div class="stat-value" id="statGallery">0</div><div class="stat-label">Gallery Photos</div><div class="stat-change up"><i class="fas fa-arrow-up"></i> Active</div></div>
    <div class="stat-card"><div class="stat-icon"><i class="fas fa-envelope"></i></div><div class="stat-value" id="statInquiries">0</div><div class="stat-label">Inquiries</div><div class="stat-change up"><i class="fas fa-arrow-up"></i> New</div></div>
    <div class="stat-card"><div class="stat-icon"><i class="fas fa-star"></i></div><div class="stat-value" id="statTestimonials">0</div><div class="stat-label">Testimonials</div><div class="stat-change up"><i class="fas fa-arrow-up"></i> Published</div></div>
</div>
<div class="panel"><div class="panel-header"><span class="panel-title">Recent Inquiries</span></div><div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="recentInquiriesTable"><thead><tr><th>Name</th><th>Email</th><th>Package</th><th>Date</th><th>Status</th></tr></thead><tbody></tbody></table></div></div></div>
</div>

<!-- ══════ HERO SLIDES ══════ -->
<div class="content-section" id="sec-hero">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Hero Carousel Slides</span><button class="btn-gold btn-sm" onclick="openModal('heroModal')"><i class="fas fa-plus"></i> Add Slide</button></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="heroTable"><thead><tr><th>Image</th><th>Tag</th><th>Title</th><th>Subtitle</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ ABOUT ══════ -->
<div class="content-section" id="sec-about">
<div class="panel">
    <div class="panel-header"><span class="panel-title">About Section Content</span></div>
    <div class="panel-body">
    <form id="aboutForm">
        <div class="form-row">
        <div class="form-group"><label class="form-label">Section Tag</label><input class="form-input" id="aboutTag" value="Our Story"/></div>
        <div class="form-group"><label class="form-label">Years of Experience</label><input class="form-input" id="aboutYears" type="number" value="12"/></div>
        </div>
        <div class="form-group"><label class="form-label">Title (HTML supported)</label><input class="form-input" id="aboutTitle" value="We Don't Just Take Photos, We Craft Moments"/></div>
        <div class="form-group"><label class="form-label">Description Paragraph 1</label><textarea class="form-textarea" id="aboutDesc1">At Lumière & Love, we believe every wedding is a unique universe of emotion.</textarea></div>
        <div class="form-group"><label class="form-label">Description Paragraph 2</label><textarea class="form-textarea" id="aboutDesc2">Based in New York, we travel worldwide for couples who deserve nothing less than extraordinary.</textarea></div>
        <div class="form-row">
        <div class="form-group"><label class="form-label">Stat 1 Value</label><input class="form-input" id="aboutStat1Val" value="850+"/></div>
        <div class="form-group"><label class="form-label">Stat 1 Label</label><input class="form-input" id="aboutStat1Lbl" value="Weddings Captured"/></div>
        </div>
        <div class="form-row">
        <div class="form-group"><label class="form-label">Stat 2 Value</label><input class="form-input" id="aboutStat2Val" value="42+"/></div>
        <div class="form-group"><label class="form-label">Stat 2 Label</label><input class="form-input" id="aboutStat2Lbl" value="Countries Visited"/></div>
        </div>
        <div class="form-row">
        <div class="form-group"><label class="form-label">Stat 3 Value</label><input class="form-input" id="aboutStat3Val" value="98%"/></div>
        <div class="form-group"><label class="form-label">Stat 3 Label</label><input class="form-input" id="aboutStat3Lbl" value="Happy Couples"/></div>
        </div>
        <div class="form-group"><label class="form-label">Main Image URL</label><input class="form-input" id="aboutImg1"/></div>
        <div class="form-group"><label class="form-label">Accent Image URL</label><input class="form-input" id="aboutImg2"/></div>
        <button type="submit" class="btn-gold"><i class="fas fa-save"></i> Save Changes</button>
    </form>
    </div>
</div>
</div>

<!-- ══════ PROJECTS ══════ -->
<div class="content-section" id="sec-projects">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Featured Projects</span><button class="btn-gold btn-sm" onclick="openModal('projectModal')"><i class="fas fa-plus"></i> Add Project</button></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="projectsTable"><thead><tr><th>Image</th><th>Couple Name</th><th>Location</th><th>Season</th><th>Size</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ GALLERY ══════ -->
<div class="content-section" id="sec-gallery">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Gallery Photos</span><button class="btn-gold btn-sm" onclick="openModal('galleryModal')"><i class="fas fa-plus"></i> Add Photo</button></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="galleryTable"><thead><tr><th>Image</th><th>Title</th><th>Category</th><th>Order</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ PACKAGES ══════ -->
<div class="content-section" id="sec-packages">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Photography Packages</span><button class="btn-gold btn-sm" onclick="openModal('packageModal')"><i class="fas fa-plus"></i> Add Package</button></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="packagesTable"><thead><tr><th>Name</th><th>Price</th><th>Featured</th><th>Features Count</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ TESTIMONIALS ══════ -->
<div class="content-section" id="sec-testimonials">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Client Testimonials</span><button class="btn-gold btn-sm" onclick="openModal('testimonialModal')"><i class="fas fa-plus"></i> Add Testimonial</button></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="testimonialsTable"><thead><tr><th>Couple</th><th>Location</th><th>Rating</th><th>Quote (Preview)</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ VIDEO ══════ -->
<div class="content-section" id="sec-video">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Video Section</span></div>
    <div class="panel-body">
    <form id="videoForm">
        <div class="form-group"><label class="form-label">Cover Image URL</label><input class="form-input" id="videoCover"/></div>
        <div class="form-group"><label class="form-label">YouTube Embed URL</label><input class="form-input" id="videoUrl" placeholder="https://www.youtube.com/embed/..."/></div>
        <div class="form-group"><label class="form-label">Title</label><input class="form-input" id="videoTitle" value="Feel the Story"/></div>
        <div class="form-group"><label class="form-label">Subtitle</label><input class="form-input" id="videoSub" value="Watch our cinematic wedding films"/></div>
        <button type="submit" class="btn-gold"><i class="fas fa-save"></i> Save Changes</button>
    </form>
    </div>
</div>
</div>

<!-- ══════ INQUIRIES ══════ -->
<div class="content-section" id="sec-inquiries">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Booking Inquiries</span></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="inquiriesTable"><thead><tr><th>Name</th><th>Partner</th><th>Email</th><th>Date</th><th>Package</th><th>Status</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ CONTACTS ══════ -->
<div class="content-section" id="sec-contacts">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Contact Messages</span></div>
    <div class="panel-body no-pad"><div class="table-responsive"><table class="data-table" id="contactsTable"><thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Date</th><th>Actions</th></tr></thead><tbody></tbody></table></div></div>
</div>
</div>

<!-- ══════ SETTINGS ══════ -->
<div class="content-section" id="sec-settings">
<div class="panel">
    <div class="panel-header"><span class="panel-title">Site Settings</span></div>
    <div class="panel-body">
    <div class="tab-bar">
        <button class="tab-btn active" data-tab="general">General</button>
        <button class="tab-btn" data-tab="social">Social Links</button>
        <button class="tab-btn" data-tab="footer">Footer</button>
    </div>
    <form id="settingsForm">
        <div id="tab-general">
        <div class="form-row">
            <div class="form-group"><label class="form-label">Site Name</label><input class="form-input" id="siteName" value="Lumière & Love"/></div>
            <div class="form-group"><label class="form-label">Email</label><input class="form-input" id="siteEmail" value="hello@lumiereandlove.com"/></div>
        </div>
        <div class="form-group"><label class="form-label">CTA Tag</label><input class="form-input" id="ctaTag" value="Let's Begin"/></div>
        <div class="form-group"><label class="form-label">CTA Title</label><input class="form-input" id="ctaTitle" value="Your Story Deserves to be Remembered"/></div>
        <div class="form-group"><label class="form-label">CTA Subtitle</label><input class="form-input" id="ctaSub" value="Limited dates available for 2025. Secure yours today."/></div>
        </div>
        <div id="tab-social" style="display:none">
        <div class="form-group"><label class="form-label">Instagram URL</label><input class="form-input" id="socialIg" placeholder="https://instagram.com/..."/></div>
        <div class="form-group"><label class="form-label">Pinterest URL</label><input class="form-input" id="socialPi" placeholder="https://pinterest.com/..."/></div>
        <div class="form-group"><label class="form-label">Facebook URL</label><input class="form-input" id="socialFb" placeholder="https://facebook.com/..."/></div>
        <div class="form-group"><label class="form-label">YouTube URL</label><input class="form-input" id="socialYt" placeholder="https://youtube.com/..."/></div>
        </div>
        <div id="tab-footer" style="display:none">
        <div class="form-group"><label class="form-label">Footer Tagline</label><input class="form-input" id="footerTagline" value="Luxury wedding photography for couples who believe their story is worth telling beautifully."/></div>
        <div class="form-group"><label class="form-label">Locations</label><input class="form-input" id="footerLocations" value="New York · Paris · Amalfi · Worldwide"/></div>
        <div class="form-group"><label class="form-label">Copyright Text</label><input class="form-input" id="footerCopy" value="© 2025 Lumière & Love Photography. All rights reserved."/></div>
        </div>
        <button type="submit" class="btn-gold" style="margin-top:10px"><i class="fas fa-save"></i> Save Settings</button>
    </form>
    </div>
</div>
</div>
@endsection

@section('modals')
<!-- Hero Modal -->
<div class="modal-overlay" id="heroModal">
  <div class="modal-box">
    <div class="modal-head"><h3 id="heroModalTitle">Add Hero Slide</h3><button class="modal-close" onclick="closeModal('heroModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body">
      <form id="heroForm">
        <input type="hidden" id="heroEditId"/>
        <div class="form-group"><label class="form-label">Tag Line</label><input class="form-input" id="heroTag" placeholder="Award Winning Photography" required/></div>
        <div class="form-group"><label class="form-label">Title (use | for line break)</label><input class="form-input" id="heroTitleInput" placeholder="Where Love | Becomes Art" required/></div>
        <div class="form-group"><label class="form-label">Subtitle</label><input class="form-input" id="heroSubtitle" placeholder="Timeless moments · Genuine emotion"/></div>
        <div class="form-group"><label class="form-label">Background Image URL</label><input class="form-input" id="heroBgUrl" placeholder="https://images.unsplash.com/..." required/></div>
        <div class="form-group"><label class="form-label">Button 1 Text</label><input class="form-input" id="heroBtn1" value="Discover More"/></div>
        <div class="form-group"><label class="form-label">Button 2 Text</label><input class="form-input" id="heroBtn2" value="Book Session"/></div>
      </form>
    </div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('heroModal')">Cancel</button><button class="btn-gold" onclick="saveHero()"><i class="fas fa-save"></i> Save</button></div>
  </div>
</div>

<!-- Project Modal -->
<div class="modal-overlay" id="projectModal">
  <div class="modal-box">
    <div class="modal-head"><h3 id="projectModalTitle">Add Project</h3><button class="modal-close" onclick="closeModal('projectModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body">
      <form id="projectForm">
        <input type="hidden" id="projectEditId"/>
        <div class="form-group"><label class="form-label">Couple Name</label><input class="form-input" id="projectCouple" placeholder="Sofia & Marcus" required/></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Location</label><input class="form-input" id="projectLocation" placeholder="Amalfi Coast, Italy"/></div>
          <div class="form-group"><label class="form-label">Season / Year</label><input class="form-input" id="projectSeason" placeholder="Summer 2024"/></div>
        </div>
        <div class="form-group"><label class="form-label">Image URL</label><input class="form-input" id="projectImgUrl" required/></div>
        <div class="form-group"><label class="form-label">Card Size</label><select class="form-select" id="projectSize"><option value="lg">Large</option><option value="sm">Small</option></select></div>
      </form>
    </div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('projectModal')">Cancel</button><button class="btn-gold" onclick="saveProject()"><i class="fas fa-save"></i> Save</button></div>
  </div>
</div>

<!-- Gallery Modal -->
<div class="modal-overlay" id="galleryModal">
  <div class="modal-box">
    <div class="modal-head"><h3 id="galleryModalTitle">Add Gallery Photo</h3><button class="modal-close" onclick="closeModal('galleryModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body">
      <form id="galleryForm">
        <input type="hidden" id="galleryEditId"/>
        <div class="form-group"><label class="form-label">Image URL</label><input class="form-input" id="galleryImgUrl" placeholder="https://images.unsplash.com/..." required/></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Title</label><input class="form-input" id="galleryTitle" placeholder="Sacred Vows"/></div>
          <div class="form-group"><label class="form-label">Alt Text</label><input class="form-input" id="galleryAlt" placeholder="Gallery 1"/></div>
        </div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Category</label><select class="form-select" id="galleryCategory"><option value="ceremony">Ceremony</option><option value="portrait">Portraits</option><option value="reception">Reception</option><option value="bridal">Bridal</option><option value="details">Details</option></select></div>
          <div class="form-group"><label class="form-label">Display Order</label><input class="form-input" id="galleryOrder" type="number" value="1"/></div>
        </div>
      </form>
    </div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('galleryModal')">Cancel</button><button class="btn-gold" onclick="saveGalleryItem()"><i class="fas fa-save"></i> Save</button></div>
  </div>
</div>

<!-- Package Modal -->
<div class="modal-overlay" id="packageModal">
  <div class="modal-box">
    <div class="modal-head"><h3 id="packageModalTitle">Add Package</h3><button class="modal-close" onclick="closeModal('packageModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body">
      <form id="packageForm">
        <input type="hidden" id="packageEditId"/>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Package Name</label><input class="form-input" id="packageName" required/></div>
          <div class="form-group"><label class="form-label">Price ($)</label><input class="form-input" id="packagePrice" type="number" required/></div>
        </div>
        <div class="form-group"><label class="form-label">Features (one per line, prefix with - for excluded)</label><textarea class="form-textarea" id="packageFeatures" placeholder="6 Hours Coverage&#10;1 Photographer&#10;-Wedding Film"></textarea></div>
        <div class="form-group"><label class="form-check"><input type="checkbox" id="packageFeatured"/> Mark as Featured (Most Popular)</label></div>
        <div class="form-group"><label class="form-label">Badge Text (optional)</label><input class="form-input" id="packageBadge" placeholder="Most Popular"/></div>
      </form>
    </div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('packageModal')">Cancel</button><button class="btn-gold" onclick="savePackage()"><i class="fas fa-save"></i> Save</button></div>
  </div>
</div>

<!-- Testimonial Modal -->
<div class="modal-overlay" id="testimonialModal">
  <div class="modal-box">
    <div class="modal-head"><h3 id="testimonialModalTitle">Add Testimonial</h3><button class="modal-close" onclick="closeModal('testimonialModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body">
      <form id="testimonialForm">
        <input type="hidden" id="testimonialEditId"/>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Couple Name</label><input class="form-input" id="testiCouple" required/></div>
          <div class="form-group"><label class="form-label">Location & Year</label><input class="form-input" id="testiLocation" placeholder="Amalfi Coast 2024"/></div>
        </div>
        <div class="form-group"><label class="form-label">Rating (1-5)</label><select class="form-select" id="testiRating"><option value="5">★★★★★ (5)</option><option value="4">★★★★☆ (4)</option><option value="3">★★★☆☆ (3)</option></select></div>
        <div class="form-group"><label class="form-label">Quote</label><textarea class="form-textarea" id="testiQuote" required></textarea></div>
      </form>
    </div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('testimonialModal')">Cancel</button><button class="btn-gold" onclick="saveTestimonial()"><i class="fas fa-save"></i> Save</button></div>
  </div>
</div>

<!-- Inquiry Detail Modal -->
<div class="modal-overlay" id="inquiryDetailModal">
  <div class="modal-box">
    <div class="modal-head"><h3>Inquiry Details</h3><button class="modal-close" onclick="closeModal('inquiryDetailModal')"><i class="fas fa-times"></i></button></div>
    <div class="modal-body" id="inquiryDetailBody"></div>
    <div class="modal-footer"><button class="btn-outline" onclick="closeModal('inquiryDetailModal')">Close</button></div>
  </div>
</div>
@endsection
