/**
 * ENSOL GROUP - Interactive JavaScript
 * Smooth animations, scroll effects, and user interactions
 */

// ========================================
// DOM ELEMENTS
// ========================================
const header = document.getElementById('header');
const hamburger = document.getElementById('hamburger');
const navLinks = document.getElementById('nav-links');
const navLinkItems = document.querySelectorAll('.nav-link');
const particlesContainer = document.getElementById('particles');

// ========================================
// HEADER SCROLL EFFECT
// ========================================
let lastScroll = 0;

function handleScroll() {
    const currentScroll = window.pageYOffset;

    // Add/remove scrolled class for styling
    if (currentScroll > 50) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }

    lastScroll = currentScroll;
}

// Throttle scroll events for performance
let scrollTicking = false;
window.addEventListener('scroll', () => {
    if (!scrollTicking) {
        window.requestAnimationFrame(() => {
            handleScroll();
            scrollTicking = false;
        });
        scrollTicking = true;
    }
});

// ========================================
// MOBILE NAVIGATION
// ========================================
hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
    document.body.style.overflow = navLinks.classList.contains('active') ? 'hidden' : '';
});

// Close mobile nav when clicking a link
navLinkItems.forEach(link => {
    link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
        document.body.style.overflow = '';
    });
});

// ========================================
// ACTIVE NAV LINK ON SCROLL
// ========================================
const sections = document.querySelectorAll('section[id]');

function highlightNavOnScroll() {
    const scrollY = window.pageYOffset;

    sections.forEach(section => {
        const sectionHeight = section.offsetHeight;
        const sectionTop = section.offsetTop - 150;
        const sectionId = section.getAttribute('id');

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            navLinkItems.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
}

window.addEventListener('scroll', highlightNavOnScroll);

// ========================================
// SCROLL REVEAL ANIMATIONS
// ========================================
const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.15
};

const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            // Optional: unobserve after animation
            // scrollObserver.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all elements with animate-on-scroll class
document.querySelectorAll('.animate-on-scroll').forEach(el => {
    scrollObserver.observe(el);
});

// ========================================
// FLOATING PARTICLES ANIMATION
// ========================================
function createParticle() {
    const particle = document.createElement('div');
    particle.classList.add('particle');

    // Random properties
    const size = Math.random() * 8 + 4;
    const left = Math.random() * 100;
    const duration = Math.random() * 10 + 10;
    const delay = Math.random() * 5;
    const opacity = Math.random() * 0.4 + 0.1;

    particle.style.cssText = `
        width: ${size}px;
        height: ${size}px;
        left: ${left}%;
        animation-duration: ${duration}s;
        animation-delay: ${delay}s;
        opacity: ${opacity};
    `;

    particlesContainer.appendChild(particle);

    // Remove particle after animation
    setTimeout(() => {
        particle.remove();
    }, (duration + delay) * 1000);
}

// Create particles continuously
function initParticles() {
    // Create initial batch
    for (let i = 0; i < 15; i++) {
        setTimeout(createParticle, i * 300);
    }

    // Create new particles periodically
    setInterval(createParticle, 2000);
}

// ========================================
// SMOOTH SCROLL FOR ANCHOR LINKS
// ========================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);

        if (targetElement) {
            const headerHeight = header.offsetHeight;
            const targetPosition = targetElement.offsetTop - headerHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});

// ========================================
// MAGNETIC BUTTON EFFECT
// ========================================
const magneticButtons = document.querySelectorAll('.btn');

magneticButtons.forEach(btn => {
    btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
    });

    btn.addEventListener('mouseleave', () => {
        btn.style.transform = 'translate(0, 0)';
    });
});

// ========================================
// TILT EFFECT FOR PARTNER CARDS
// ========================================
const partnerCards = document.querySelectorAll('.partner-card');

partnerCards.forEach(card => {
    card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const centerX = rect.width / 2;
        const centerY = rect.height / 2;

        const rotateX = (y - centerY) / 10;
        const rotateY = (centerX - x) / 10;

        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateY(0)';
    });
});

// ========================================
// HERO IMAGE PARALLAX EFFECT
// ========================================
const heroImage = document.querySelector('.hero-image');

window.addEventListener('scroll', () => {
    if (heroImage) {
        const scrolled = window.pageYOffset;
        const rate = scrolled * 0.3;

        if (scrolled < window.innerHeight) {
            heroImage.style.transform = `translateY(${rate}px)`;
        }
    }
});

// ========================================
// TEXT TYPING ANIMATION (Optional enhancement)
// ========================================
function typeWriter(element, text, speed = 50) {
    let i = 0;
    element.innerHTML = '';

    function type() {
        if (i < text.length) {
            element.innerHTML += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }

    type();
}

// ========================================
// COUNTER ANIMATION FOR STATISTICS
// ========================================
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);

    function updateCounter() {
        start += increment;
        if (start < target) {
            element.textContent = Math.floor(start);
            requestAnimationFrame(updateCounter);
        } else {
            element.textContent = target;
        }
    }

    updateCounter();
}

// ========================================
// RIPPLE EFFECT FOR BUTTONS
// ========================================
function createRipple(event) {
    const button = event.currentTarget;
    const circle = document.createElement('span');
    const diameter = Math.max(button.clientWidth, button.clientHeight);
    const radius = diameter / 2;

    circle.style.width = circle.style.height = `${diameter}px`;
    circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
    circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
    circle.classList.add('ripple');

    const ripple = button.querySelector('.ripple');
    if (ripple) {
        ripple.remove();
    }

    button.appendChild(circle);

    // Remove ripple after animation
    setTimeout(() => circle.remove(), 600);
}

// Add ripple effect to buttons
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', createRipple);
});

// ========================================
// LAZY LOADING FOR IMAGES
// ========================================
const lazyImages = document.querySelectorAll('img[data-src]');

const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.add('loaded');
            observer.unobserve(img);
        }
    });
}, {
    rootMargin: '100px'
});

lazyImages.forEach(img => imageObserver.observe(img));

// ========================================
// CURSOR TRAIL EFFECT (Subtle)
// ========================================
function createCursorTrail() {
    const trail = document.createElement('div');
    trail.style.cssText = `
        position: fixed;
        width: 10px;
        height: 10px;
        background: rgba(220, 22, 9, 0.3);
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transition: opacity 0.5s, transform 0.5s;
    `;
    document.body.appendChild(trail);

    let mouseX = 0;
    let mouseY = 0;
    let trailX = 0;
    let trailY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    function animateTrail() {
        trailX += (mouseX - trailX) * 0.1;
        trailY += (mouseY - trailY) * 0.1;

        trail.style.left = `${trailX - 5}px`;
        trail.style.top = `${trailY - 5}px`;

        requestAnimationFrame(animateTrail);
    }

    animateTrail();
}

// ========================================
// PRELOADER (Optional)
// ========================================
function hidePreloader() {
    const preloader = document.querySelector('.preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
}

// ========================================
// INITIALIZE
// ========================================
document.addEventListener('DOMContentLoaded', () => {
    // Initialize particles
    initParticles();

    // Initialize cursor trail (uncomment if desired)
    // createCursorTrail();

    // Trigger initial scroll check
    handleScroll();
    highlightNavOnScroll();

    // Add loaded class to body for initial animations
    document.body.classList.add('loaded');

    console.log('🚀 Ensol Group website initialized successfully!');
});

// Handle page load
window.addEventListener('load', () => {
    hidePreloader();

    // Force visibility check for above-fold elements
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight) {
            el.classList.add('visible');
        }
    });
});

// ========================================
// PERFORMANCE: Reduce animations if user prefers
// ========================================
if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[class*="animate"]').forEach(el => {
        el.style.animation = 'none';
        el.style.transition = 'none';
    });
}

// ========================================
// SERVICES SLIDER FUNCTIONALITY
// ========================================
function initServicesSlider() {
    const slider = document.getElementById('services-slider');
    const dotsContainer = document.getElementById('slider-dots');

    if (!slider || !dotsContainer) return;

    const cards = slider.querySelectorAll('.service-card');
    if (cards.length === 0) return;

    let currentIndex = 0;

    // Generate dots dynamically
    cards.forEach((_, index) => {
        const dot = document.createElement('span');
        dot.classList.add('slider-dot');
        dot.dataset.index = index;
        if (index === 0) dot.classList.add('active');
        dotsContainer.appendChild(dot);
    });

    const dots = dotsContainer.querySelectorAll('.slider-dot');

    // Set first card as active
    cards[0].classList.add('service-card-active');

    // Update active state based on index
    function setActiveCard(index) {
        // Remove active from all cards
        cards.forEach(card => card.classList.remove('service-card-active'));
        dots.forEach(dot => dot.classList.remove('active'));

        // Set new active
        cards[index].classList.add('service-card-active');
        dots[index].classList.add('active');
        currentIndex = index;
    }

    // Scroll to specific card
    function scrollToCard(index) {
        const card = cards[index];
        const sliderRect = slider.getBoundingClientRect();
        const cardRect = card.getBoundingClientRect();
        const scrollLeft = slider.scrollLeft + (cardRect.left - sliderRect.left) - (sliderRect.width / 2) + (cardRect.width / 2);

        slider.scrollTo({
            left: scrollLeft,
            behavior: 'smooth'
        });

        setActiveCard(index);
    }

    // Click on card to make active
    cards.forEach((card, index) => {
        card.addEventListener('click', () => {
            scrollToCard(index);
        });
    });

    // Click on dot to navigate
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            scrollToCard(index);
        });
    });

    // Update active on scroll
    let scrollTimeout;
    slider.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
            const sliderCenter = slider.scrollLeft + slider.offsetWidth / 2;

            let closestIndex = 0;
            let closestDistance = Infinity;

            cards.forEach((card, index) => {
                const cardCenter = card.offsetLeft + card.offsetWidth / 2;
                const distance = Math.abs(sliderCenter - cardCenter);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    closestIndex = index;
                }
            });

            if (closestIndex !== currentIndex) {
                setActiveCard(closestIndex);
            }
        }, 50);
    });

    // Touch/swipe support - update on touch end
    slider.addEventListener('touchend', () => {
        setTimeout(() => {
            const sliderCenter = slider.scrollLeft + slider.offsetWidth / 2;

            let closestIndex = 0;
            let closestDistance = Infinity;

            cards.forEach((card, index) => {
                const cardCenter = card.offsetLeft + card.offsetWidth / 2;
                const distance = Math.abs(sliderCenter - cardCenter);

                if (distance < closestDistance) {
                    closestDistance = distance;
                    closestIndex = index;
                }
            });

            setActiveCard(closestIndex);
        }, 100);
    });
}

// Initialize slider on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    initServicesSlider();
});

// ========================================
// BACK TO TOP BUTTON
// ========================================
const backToTopButton = document.getElementById('backToTop');

if (backToTopButton) {
    // Show/hide button based on scroll position
    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTopButton.classList.add('visible');
        } else {
            backToTopButton.classList.remove('visible');
        }
    });

    // Smooth scroll to top
    backToTopButton.addEventListener('click', (e) => {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}
