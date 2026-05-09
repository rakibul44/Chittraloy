const fs = require('fs');
const path = require('path');

function copyDir(src, dest) {
  fs.mkdirSync(dest, { recursive: true });
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const srcPath = path.join(src, entry.name);
    const destPath = path.join(dest, entry.name);
    if (entry.isDirectory()) {
      copyDir(srcPath, destPath);
    } else {
      fs.copyFileSync(srcPath, destPath);
    }
  }
}

fs.mkdirSync('dist', { recursive: true });

// Copy pre-rendered static HTML
fs.copyFileSync('gh-pages/index.html', 'dist/index.html');
fs.copyFileSync('gh-pages/gallery.html', 'dist/gallery.html');

// Copy public assets
copyDir('public/assets', 'dist/assets');
copyDir('public/build', 'dist/build');
if (fs.existsSync('public/admin_assets')) {
  copyDir('public/admin_assets', 'dist/admin_assets');
}

// Fix logo filename case
const logoSrc = 'public/assets/images/Logo.png';
const logoDest = 'dist/assets/images/logo.png';
if (fs.existsSync(logoSrc) && !fs.existsSync(logoDest)) {
  fs.copyFileSync(logoSrc, logoDest);
}

console.log('Static dist built successfully.');
