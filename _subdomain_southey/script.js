/* _subdomain_southey/script.js */
document.addEventListener('DOMContentLoaded', () => {
    
    // Header Scroll Effect
    const header = document.querySelector('.header');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Sliding Nav Pill Logic
    const individualNavLinks = document.querySelectorAll('.nav-link');
    const dynamicIsland = document.querySelector('.dynamic-island');
    const indicator = document.querySelector('.nav-pill-indicator');
    
    if (dynamicIsland && individualNavLinks.length > 0 && indicator) {
        const movePill = (target, immediate = false) => {
            const rect = target.getBoundingClientRect();
            const navRect = dynamicIsland.getBoundingClientRect();
            
            if (immediate) {
                indicator.style.transition = 'none';
            } else {
                indicator.style.transition = 'all 0.4s cubic-bezier(0.23, 1, 0.32, 1)';
            }
            
            indicator.style.width = `${rect.width}px`;
            indicator.style.height = `${rect.height}px`;
            indicator.style.left = `${rect.left - navRect.left}px`;
            indicator.style.top = `${rect.top - navRect.top}px`;
            indicator.style.opacity = '1';

            if (immediate) {
                // Force layout and restore transition
                indicator.offsetHeight; 
                indicator.style.transition = 'all 0.4s cubic-bezier(0.23, 1, 0.32, 1)';
            }
        };

        const activeNavItem = document.querySelector('.nav-link.active');
        if (activeNavItem) {
            // Position immediately on the active item
            movePill(activeNavItem, true);
        }

        individualNavLinks.forEach(link => {
            link.addEventListener('mouseenter', (e) => {
                movePill(e.currentTarget);
            });
        });

        dynamicIsland.addEventListener('mouseleave', () => {
            const currentActive = document.querySelector('.nav-link.active');
            if (currentActive) {
                movePill(currentActive);
            } else {
                indicator.style.opacity = '0';
            }
        });

        // Handle window resizing
        window.addEventListener('resize', () => {
            const currentActive = document.querySelector('.nav-link.active');
            if (currentActive) movePill(currentActive, true);
        });
    }



    // === LENIS SMOOTH SCROLLING ===
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        direction: 'vertical',
        gestureDirection: 'vertical',
        smooth: true,
        mouseMultiplier: 1,
        smoothTouch: false,
        touchMultiplier: 2,
        infinite: false,
    });

    function raf(time) {
        lenis.raf(time);
        requestAnimationFrame(raf);
    }
    requestAnimationFrame(raf);

    // === GSAP INTEGRATION ===
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        // Update Lenis context for ScrollTrigger
        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time)=>{
          lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);

        // Reveal Up Animations
        const revealElements = document.querySelectorAll('.reveal-up');
        if (revealElements.length > 0) {
            revealElements.forEach(el => {
                let delay = 0;
                if (el.classList.contains('delay-100')) delay = 0.1;
                if (el.classList.contains('delay-200')) delay = 0.2;
                if (el.classList.contains('delay-300')) delay = 0.3;
                if (el.classList.contains('delay-400')) delay = 0.4;
                
                // Remove CSS transition to avoid conflict with GSAP
                el.style.transition = 'none';
                
                gsap.fromTo(el, 
                    { y: 60, opacity: 0 },
                    {
                        y: 0, 
                        opacity: 1,
                        duration: 1.2,
                        delay: delay,
                        ease: "power4.out",
                        scrollTrigger: {
                            trigger: el,
                            start: "top 85%",
                            toggleActions: "play none none none"
                        }
                    }
                );
            });
        }

        // Stagger Reveals for Children
        const staggerGroups = document.querySelectorAll('.stagger-group');
        staggerGroups.forEach(group => {
            const children = group.children;
            Array.from(children).forEach(child => {
                child.style.transition = 'none';
            });
            gsap.fromTo(children, 
                { y: 50, opacity: 0 },
                {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    stagger: 0.15,
                    ease: "power3.out",
                    scrollTrigger: {
                        trigger: group,
                        start: "top 80%",
                        toggleActions: "play none none none"
                    }
                }
            );
        });

        // Parallax Images
        gsap.utils.toArray('.parallax-img').forEach(img => {
            gsap.to(img, {
                yPercent: 15,
                ease: "none",
                scrollTrigger: {
                    trigger: img.parentElement,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });
        
        // Parallax Backgrounds
        gsap.utils.toArray('.parallax-bg').forEach(bg => {
            gsap.to(bg, {
                yPercent: 30,
                ease: "none",
                scrollTrigger: {
                    trigger: bg.parentElement,
                    start: "top bottom",
                    end: "bottom top",
                    scrub: true
                }
            });
        });
    }

    // === GSAP HOVER INTERACTIONS ===
    const hoverElements = document.querySelectorAll('.hover-interaction, .service-item-card, .vm-card, .standard-card, .advantage-card, .service-preview-card, .contact-card, .form-group input, .form-group textarea, .form-group select');
    hoverElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            const isServiceCard = el.classList.contains('service-preview-card') || el.classList.contains('service-item-card');
            
            gsap.to(el, {
                y: -15,
                scale: 1.025,
                borderColor: isServiceCard ? "rgba(220, 22, 9, 0.4)" : "rgba(0,0,0,0.1)",
                boxShadow: isServiceCard ? "0 25px 50px rgba(220, 22, 9, 0.15), 0 0 15px rgba(220, 22, 9, 0.1)" : "0 25px 50px rgba(0,0,0,0.1)",
                duration: 0.6,
                ease: "power2.out"
            });
            
            // Red Outline/Glow Effect - Only for Services
            if (isServiceCard) {
                el.style.outline = "2px solid var(--brand-red)";
                el.style.outlineOffset = "4px";
            }

            const icon = el.querySelector('i');
            if (icon) {
                gsap.to(icon, {
                    scale: 1.25,
                    rotation: 8,
                    color: "var(--brand-red)",
                    duration: 0.4,
                    ease: "back.out(2)"
                });
            }
        });
        
        el.addEventListener('mouseleave', () => {
            gsap.to(el, {
                y: 0,
                scale: 1,
                borderColor: "rgba(0,0,0,0.08)",
                boxShadow: "0 10px 40px rgba(0,0,0,0.05)",
                duration: 0.6,
                ease: "power4.out"
            });
            
            el.style.outline = "none";

            const icon = el.querySelector('i');
            if (icon) {
                gsap.to(icon, {
                    scale: 1,
                    rotation: 0,
                    color: "inherit",
                    duration: 0.4,
                    ease: "power2.out"
                });
            }
        });
    });

    // === MAGNETIC BUTTONS ===
    const magneticBtns = document.querySelectorAll('.btn-primary, .btn-ghost, .btn-contact, .carousel-btn, .scroll-item, .service-preview-card, .industry-home-card, .contact-info-item');
    magneticBtns.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const isCard = btn.classList.contains('service-preview-card') || btn.classList.contains('industry-home-card');
            const factor = isCard ? 0.05 : 0.2; 
            
            const xModifier = x * factor;
            const yModifier = y * factor;
            
            btn.style.transform = `translate(${xModifier}px, ${yModifier}px)`;
        });
        
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = 'translate(0px, 0px)';
        });
    });

    // Interactive Scroll List (Aligned. Flexible.)
    const scrollItems = document.querySelectorAll('.scroll-item');
    if (scrollItems.length > 0) {
        // Handle click expanding
        scrollItems.forEach(item => {
            item.addEventListener('click', () => {
                scrollItems.forEach(i => i.classList.remove('active'));
                item.classList.add('active');
            });
        });

        // Optional: Auto-scroll spy effect could be added here
        // where scrolling the page automatically activates the next item
        let lastScrollY = window.scrollY;
        window.addEventListener('scroll', () => {
            // Very simplified scroll spy implementation
            const listRect = document.querySelector('.scroll-list-right').getBoundingClientRect();
            if (listRect.top < window.innerHeight / 2 && listRect.bottom > window.innerHeight / 2) {
                // Determine which item is most central
                let closestItem = scrollItems[0];
                let minDistance = Infinity;

                scrollItems.forEach(item => {
                    const rect = item.getBoundingClientRect();
                    const distance = Math.abs(rect.top - window.innerHeight / 3);
                    if (distance < minDistance) {
                        minDistance = distance;
                        closestItem = item;
                    }
                });

                // Only change if not manually clicked recently (can be optimized)
                scrollItems.forEach(i => i.classList.remove('active'));
                closestItem.classList.add('active');
            }
        });
    }

    // Horizontal Carousel Logic
    const carouselContainer = document.querySelector('.carousel-container');
    const progressBar = document.querySelector('.carousel-progress-bar');
    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');

    if (carouselContainer) {
        const updateProgress = () => {
            const scrollLeft = carouselContainer.scrollLeft;
            const scrollWidth = carouselContainer.scrollWidth - carouselContainer.clientWidth;
            const progress = (scrollLeft / scrollWidth) * 100;
            if (progressBar) {
                progressBar.style.width = `${Math.max(25, progress)}%`;
            }
        };

        carouselContainer.addEventListener('scroll', updateProgress);

        if (nextBtn && prevBtn) {
            nextBtn.addEventListener('click', () => {
                const cardWidth = document.querySelector('.portfolio-card').offsetWidth;
                carouselContainer.scrollBy({ left: cardWidth + 32, behavior: 'smooth' });
            });

            prevBtn.addEventListener('click', () => {
                const cardWidth = document.querySelector('.portfolio-card').offsetWidth;
                carouselContainer.scrollBy({ left: -(cardWidth + 32), behavior: 'smooth' });
            });
        }
    }

    // Services Dropdown Logic
    const serviceSelect = document.getElementById('service-select');
    if (serviceSelect) {
        serviceSelect.addEventListener('change', (e) => {
            const targetId = e.target.value;
            document.querySelectorAll('.service-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            const targetTab = document.getElementById(`tab-${targetId}`);
            if (targetTab) {
                targetTab.classList.add('active');
            }
        });
    }

    // Mobile Menu Toggle
    const menuToggle = document.getElementById('menu-toggle');
    const mobileOverlay = document.getElementById('mobile-nav-overlay');
    const mobileClose = document.getElementById('mobile-nav-close');

    if (menuToggle && mobileOverlay && mobileClose) {
        menuToggle.addEventListener('click', () => {
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });

        mobileClose.addEventListener('click', () => {
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
    }

    // === SCROLL PROGRESS BAR ===
    const scrollProgressBar = document.createElement('div');
    scrollProgressBar.classList.add('scroll-progress-bar');
    document.body.prepend(scrollProgressBar);

    window.addEventListener('scroll', () => {
        const scrollTop = window.scrollY;
        const docHeight = document.documentElement.scrollHeight - window.innerHeight;
        if (docHeight > 0) {
            scrollProgressBar.style.width = ((scrollTop / docHeight) * 100) + '%';
        }
    }, { passive: true });

    // === ANIMATED STAT COUNTERS ===
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
        document.querySelectorAll('.count-up').forEach(el => {
            const target = parseFloat(el.dataset.target);
            const suffix = el.dataset.suffix || '';
            const isFloat = el.dataset.float === 'true';
            let triggered = false;

            ScrollTrigger.create({
                trigger: el,
                start: 'top 80%',
                onEnter: () => {
                    if (triggered) return;
                    triggered = true;
                    const obj = { val: 0 };
                    gsap.to(obj, {
                        val: target,
                        duration: 2.2,
                        ease: 'power2.out',
                        onUpdate: () => {
                            el.textContent = (isFloat ? obj.val.toFixed(1) : Math.round(obj.val)) + suffix;
                        }
                    });
                }
            });
        });
    }

    // === 3D CARD TILT ===
    if (typeof gsap !== 'undefined') {
        document.querySelectorAll('.industry-solution-card').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width  - 0.5;
                const y = (e.clientY - rect.top)  / rect.height - 0.5;
                gsap.to(card, {
                    rotateX: -y * 9,
                    rotateY:  x * 9,
                    duration: 0.5,
                    ease: 'power2.out',
                    transformPerspective: 900
                });
            });
            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    rotateX: 0,
                    rotateY: 0,
                    duration: 0.8,
                    ease: 'power4.out'
                });
            });
        });
    }

    // === FLOAT ANIMATION ON ICONS ===
    // Applied after a short delay so GSAP reveal animations don't conflict
    setTimeout(() => {
        document.querySelectorAll('.trust-badge-icon, .service-preview-icon, .vm-icon, .standard-icon, .advantage-icon').forEach((icon, i) => {
            icon.style.animationDelay = `${(i % 5) * 0.4}s`;
            icon.classList.add('float-anim');
        });
    }, 800);
});
