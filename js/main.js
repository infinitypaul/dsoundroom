/**
 * The Soundroom - Main JavaScript
 * Handles animations, interactions, and UI behaviors
 */

document.addEventListener('DOMContentLoaded', () => {
  // Initialize all modules
  initLoader();
  initHeader();
  initMobileNav();
  initRevealAnimations();
  initFilterGrid();
  initForms();
});

/**
 * Page Loader
 */
function initLoader() {
  const loader = document.getElementById('loader');
  if (!loader) return;

  // Hide loader after page load
  window.addEventListener('load', () => {
    setTimeout(() => {
      loader.classList.add('hidden');
      // Remove from DOM after transition
      setTimeout(() => {
        loader.style.display = 'none';
      }, 500);
    }, 800);
  });
}

/**
 * Header scroll behavior
 */
function initHeader() {
  const header = document.getElementById('header');
  if (!header) return;

  let lastScroll = 0;
  const scrollThreshold = 50;

  function handleScroll() {
    const currentScroll = window.pageYOffset;
    
    // Add scrolled class when past threshold
    if (currentScroll > scrollThreshold) {
      header.classList.add('header--scrolled');
    } else {
      header.classList.remove('header--scrolled');
    }

    lastScroll = currentScroll;
  }

  // Throttle scroll event
  let ticking = false;
  window.addEventListener('scroll', () => {
    if (!ticking) {
      window.requestAnimationFrame(() => {
        handleScroll();
        ticking = false;
      });
      ticking = true;
    }
  });

  // Initial check
  handleScroll();
}

/**
 * Mobile Navigation
 */
function initMobileNav() {
  const menuToggle = document.getElementById('menuToggle');
  const mobileNav = document.getElementById('mobileNav');
  
  if (!menuToggle || !mobileNav) return;

  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    mobileNav.classList.toggle('active');
    document.body.style.overflow = mobileNav.classList.contains('active') ? 'hidden' : '';
  });

  // Close mobile nav when clicking a link
  const mobileLinks = mobileNav.querySelectorAll('.mobile-nav__link');
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      menuToggle.classList.remove('active');
      mobileNav.classList.remove('active');
      document.body.style.overflow = '';
    });
  });

  // Close on escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && mobileNav.classList.contains('active')) {
      menuToggle.classList.remove('active');
      mobileNav.classList.remove('active');
      document.body.style.overflow = '';
    }
  });
}

/**
 * Reveal animations on scroll
 */
function initRevealAnimations() {
  const reveals = document.querySelectorAll('.reveal');
  
  if (!reveals.length) return;

  const observerOptions = {
    root: null,
    rootMargin: '0px 0px -50px 0px',
    threshold: 0.1
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, index) => {
      if (entry.isIntersecting) {
        // Add staggered delay for grid items
        const parent = entry.target.parentElement;
        if (parent && parent.classList.contains('artists-grid')) {
          const siblings = Array.from(parent.querySelectorAll('.reveal'));
          const siblingIndex = siblings.indexOf(entry.target);
          entry.target.style.transitionDelay = `${siblingIndex * 0.1}s`;
        }
        
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  reveals.forEach(reveal => observer.observe(reveal));
}

/**
 * Filter grid with infinite scroll for sessions page
 */
function initFilterGrid() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const artistsGrid = document.getElementById('artistsGrid');
  const infiniteLoader = document.getElementById('infiniteLoader');
  const infiniteEnd = document.getElementById('infiniteEnd');
  const infiniteEmpty = document.getElementById('infiniteEmpty');
  
  if (!filterBtns.length || !artistsGrid) return;
  
  let currentPage = 1;
  let currentFilter = 'all';
  let maxPages = parseInt(artistsGrid.dataset.maxPages) || 1;
  let isLoading = false;
  let hasMore = currentPage < maxPages;
  
  // Intersection Observer for infinite scroll
  const loadMoreObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting && hasMore && !isLoading) {
        loadMoreSessions();
      }
    });
  }, {
    root: null,
    rootMargin: '200px',
    threshold: 0
  });
  
  // Observe the loader element
  if (infiniteLoader) {
    loadMoreObserver.observe(infiniteLoader);
  }
  
  // Update status visibility
  function updateStatus() {
    const cards = artistsGrid.querySelectorAll('.artist-card');
    
    if (infiniteLoader) infiniteLoader.style.display = isLoading ? 'flex' : 'none';
    if (infiniteEnd) infiniteEnd.style.display = (!isLoading && !hasMore && cards.length > 0) ? 'block' : 'none';
    if (infiniteEmpty) infiniteEmpty.style.display = (!isLoading && cards.length === 0) ? 'block' : 'none';
  }
  
  // Load more sessions via AJAX
  function loadMoreSessions() {
    if (isLoading || !hasMore) return;
    
    isLoading = true;
    currentPage++;
    updateStatus();
    
    const formData = new FormData();
    formData.append('action', 'soundroom_load_more');
    formData.append('page', currentPage);
    formData.append('filter', currentFilter);
    
    fetch(window.soundroom?.ajax_url || '/wp-admin/admin-ajax.php', {
      method: 'POST',
      body: formData,
      credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
      isLoading = false;
      
      if (data.success && data.data.html) {
        // Create temp container to parse HTML
        const temp = document.createElement('div');
        temp.innerHTML = data.data.html;
        
        // Add each card with animation
        const newCards = temp.querySelectorAll('.artist-card');
        newCards.forEach((card, index) => {
          card.style.transitionDelay = `${index * 0.1}s`;
          artistsGrid.appendChild(card);
          // Trigger reveal animation
          setTimeout(() => card.classList.add('visible'), 50);
        });
        
        maxPages = data.data.max_pages;
        hasMore = data.data.has_more;
      } else {
        hasMore = false;
      }
      
      updateStatus();
    })
    .catch(error => {
      console.error('Load more failed:', error);
      isLoading = false;
      updateStatus();
    });
  }
  
  // Filter button click handlers
  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const newFilter = btn.dataset.filter;
      
      // Don't reload if same filter
      if (newFilter === currentFilter) return;
      
      // Update active state
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      // Reset and reload with new filter
      currentFilter = newFilter;
      currentPage = 0; // Will be incremented to 1 in loadMoreSessions
      hasMore = true;
      
      // Clear current grid
      artistsGrid.innerHTML = '';
      
      // Load first page with filter
      loadMoreSessions();
    });
  });
  
  // Initial status update
  updateStatus();
}

/**
 * Form handling
 */
function initForms() {
  // Newsletter form
  const newsletterForms = document.querySelectorAll('.newsletter__form');
  newsletterForms.forEach(form => {
    form.addEventListener('submit', handleNewsletterSubmit);
  });

  // Contact form
  const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', handleContactSubmit);
  }

  // Submit form
  const submitForm = document.getElementById('submitForm');
  if (submitForm) {
    submitForm.addEventListener('submit', handleArtistSubmit);
  }
}

function handleNewsletterSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const email = form.querySelector('input[type="email"]').value;
  
  // Simulate submission
  const button = form.querySelector('button');
  const originalText = button.textContent;
  button.textContent = 'Joining...';
  button.disabled = true;

  setTimeout(() => {
    button.textContent = 'Welcome!';
    form.querySelector('input').value = '';
    
    setTimeout(() => {
      button.textContent = originalText;
      button.disabled = false;
    }, 2000);
  }, 1000);
}

function handleContactSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const button = form.querySelector('button[type="submit"]');
  const originalText = button.textContent;
  
  button.textContent = 'Sending...';
  button.disabled = true;

  setTimeout(() => {
    button.textContent = 'Message Sent!';
    form.reset();
    
    setTimeout(() => {
      button.textContent = originalText;
      button.disabled = false;
    }, 3000);
  }, 1500);
}

function handleArtistSubmit(e) {
  e.preventDefault();
  const form = e.target;
  const button = form.querySelector('button[type="submit"]');
  const originalText = button.textContent;
  
  button.textContent = 'Submitting...';
  button.disabled = true;

  setTimeout(() => {
    button.textContent = 'Application Received!';
    form.reset();
    
    // Scroll to top of form
    form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    
    setTimeout(() => {
      button.textContent = originalText;
      button.disabled = false;
    }, 4000);
  }, 2000);
}

/**
 * Smooth scroll for anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href === '#') return;
    
    e.preventDefault();
    const target = document.querySelector(href);
    if (target) {
      target.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }
  });
});

/**
 * Parallax effect for hero background (subtle)
 */
const heroSection = document.querySelector('.hero');
if (heroSection) {
  const heroBg = heroSection.querySelector('.hero__bg-image');
  if (heroBg) {
    window.addEventListener('scroll', () => {
      const scrolled = window.pageYOffset;
      const rate = scrolled * 0.3;
      heroBg.style.transform = `translateY(${rate}px)`;
    });
  }
}

/**
 * Preload critical images
 */
function preloadImages() {
  const images = [
    'assets/logo-white.svg',
    'assets/images/hero-bg.jpg'
  ];
  
  images.forEach(src => {
    const img = new Image();
    img.src = src;
  });
}

// Run preload
preloadImages();
