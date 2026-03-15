/* =======================================
   main.js - v4d Shared JavaScript
   ======================================= */

// Mobile nav toggle
const hamburger = document.getElementById('hamburger-btn');
const navMenu   = document.getElementById('navbar-nav');

if (hamburger && navMenu) {
  hamburger.addEventListener('click', () => {
    const open = navMenu.classList.toggle('open');
    hamburger.setAttribute('aria-expanded', open);
  });

  // Close on outside click
  document.addEventListener('click', (e) => {
    if (!hamburger.contains(e.target) && !navMenu.contains(e.target)) {
      navMenu.classList.remove('open');
      hamburger.setAttribute('aria-expanded', 'false');
    }
  });
}

// Navbar scroll shrink
window.addEventListener('scroll', () => {
  const nb = document.querySelector('.navbar');
  if (nb) {
    nb.style.background = window.scrollY > 20
      ? 'rgba(10,10,10,0.97)'
      : 'rgba(10,10,10,0.85)';
  }
});

// Animate elements on scroll (simple intersection observer)
const animItems = document.querySelectorAll('[data-anim]');
if (animItems.length) {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('anim-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  animItems.forEach(el => observer.observe(el));
}

// Flash message auto-dismiss
const flashMsg = document.querySelector('.flash-message');
if (flashMsg) {
  setTimeout(() => {
    flashMsg.style.transition = 'opacity 0.5s ease';
    flashMsg.style.opacity = '0';
    setTimeout(() => flashMsg.remove(), 500);
  }, 4000);
}

// Admin sidebar toggle
const adminToggle = document.getElementById('admin-mobile-toggle');
const adminSidebar = document.getElementById('admin-sidebar');
const adminOverlay = document.getElementById('admin-sidebar-overlay');

if (adminToggle && adminSidebar && adminOverlay) {
  adminToggle.addEventListener('click', () => {
    adminSidebar.classList.toggle('open');
    adminOverlay.classList.toggle('show');
  });

  adminOverlay.addEventListener('click', () => {
    adminSidebar.classList.remove('open');
    adminOverlay.classList.remove('show');
  });
}
