<?php
$activePage = 'contact';
$pageTitle = 'Contact Us';
$pageDescription = 'Get in touch with SCL Ghana Limited for specialized industrial solutions, integrity audits, and partnership inquiries.';
include 'includes/header.php';
?><style>
    .contact-page-wrapper {
        min-height: 100vh;
        display: flex;
        background-color: #000;
        width: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    .contact-left {
        flex: 1;
        background-color: #000;
        color: #fff;
        padding: 120px 8% 60px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        z-index: 1;
        min-height: 100vh;
    }

    .contact-left .serif-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(3rem, 6vw, 5rem);
        line-height: 1.1;
        font-weight: 400;
        margin-top: 2rem;
    }

    .contact-right {
        flex: 1;
        background-color: #F2F2F2;
        color: #000;
        padding: 120px 8% 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        z-index: 2;
        min-height: 100vh;
    }

    .serif-subtitle {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.5rem, 4vw, 3.5rem);
        margin-bottom: 3rem;
        font-weight: 400;
    }

    .glass-form {
        width: 100%;
        max-width: 550px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2.5rem 2rem;
    }

    .form-field {
        display: flex;
        flex-direction: column;
        border-bottom: 1px solid #AAA;
        padding-bottom: 0.5rem;
        transition: border-color 0.4s;
    }

    .form-field:focus-within {
        border-bottom-color: #000;
    }

    .form-field label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #666;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .form-field input, .form-field select, .form-field textarea {
        background: transparent;
        border: none;
        outline: none;
        font-family: inherit;
        font-size: 1rem;
        color: #000;
        padding: 0.5rem 0;
    }

    .form-field-full {
        grid-column: span 2;
    }

    .btn-glass-submit {
        background: none;
        border: none;
        font-size: 1.1rem;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 1rem 0;
        margin-top: 2rem;
        transition: transform 0.3s;
    }

    .btn-glass-submit:hover {
        transform: translateX(10px);
    }

    /* Circles */
    .circles-background {
        position: absolute;
        bottom: 5%;
        left: -10%;
        width: 120%;
        height: 50%;
        z-index: -1;
        pointer-events: none;
    }

    .decoration-circle {
        position: absolute;
        border: 1px dashed rgba(255,255,255,0.15);
        border-radius: 50%;
    }

    .circle-1 { width: 450px; height: 450px; bottom: -200px; left: 0; }
    .circle-2 { width: 550px; height: 550px; bottom: -250px; left: 25%; }
    .circle-3 { width: 350px; height: 350px; bottom: -150px; left: 55%; }

    .bottom-info {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        color: #888;
        width: 100%;
        padding-top: 4rem;
    }

    .contact-item {
        margin-top: 3rem;
    }

    .contact-item-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 0.5rem;
    }

    .contact-item-value {
        font-size: 1.1rem;
    }

    /* Nav Links on Right panel */
    .contact-nav-overlay {
        position: absolute;
        top: 2rem;
        right: 4rem;
        display: flex;
        gap: 2rem;
        z-index: 100;
    }

    .contact-nav-link {
        font-weight: 500;
        color: #000;
        font-size: 0.95rem;
    }
    
    .contact-nav-btn {
        border: 1px solid #000;
        padding: 0.5rem 1.2rem;
        border-radius: 5px;
    }

    @media (max-width: 1024px) {
        .contact-page-wrapper { flex-direction: column; }
        .contact-left, .contact-right { min-height: 50vh; padding: 100px 8% 60px; }
        .form-grid { grid-template-columns: 1fr; }
        .form-field-full { grid-column: span 1; }
    }
</style>

<main class="contact-page-wrapper">
    <!-- Left Section -->
    <div class="contact-left">
        <div class="circles-background">
            <div class="decoration-circle circle-1"></div>
            <div class="decoration-circle circle-2"></div>
            <div class="decoration-circle circle-3"></div>
        </div>
        
        <div class="reveal-up">
            <h1 class="serif-title">We'd love to hear from you</h1>
        </div>

        <div class="contact-left-bottom reveal-up delay-200">
            <div class="contact-item">
                <p class="contact-item-label">Email Us</p>
                <p class="contact-item-value">info@sclghana.com</p>
            </div>
            <div class="contact-item">
                <p class="contact-item-label">Visit Us</p>
                <p class="contact-item-value">Plot No. IND/116/A/18, Takoradi Industrial Area, Ghana</p>
            </div>
            
            <div class="bottom-info">
                <p>&copy; <?php echo date('Y'); ?> SCL Ghana Limited</p>
                <div style="display: flex; gap: 1.5rem;">
                    <a href="#">Privacy</a>
                    <a href="#">Instagram</a>
                    <a href="#">Facebook</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="contact-right">
        <div class="reveal-up">
            <h2 class="serif-subtitle">Contact us</h2>
        </div>

        <form class="glass-form reveal-up delay-100" id="contact-form" method="POST">
            <div class="form-grid">
                <div class="form-field">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" placeholder="John" required>
                </div>
                <div class="form-field">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" placeholder="Doe" required>
                </div>
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="john@example.com" required>
                </div>
                <div class="form-field">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter phone number">
                </div>
                <div class="form-field form-field-full">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Enter your message..." required></textarea>
                </div>
            </div>

            <button type="submit" class="btn-glass-submit" id="submit-btn">
                Submit <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <div class="reveal-up delay-300" style="margin-top: 3rem; display: flex; justify-content: flex-end; width: 100%; border-top: 1px solid #ddd; padding-top: 2rem;">
            <p style="font-size: 0.85rem; color: #888;">enquiries@sclghana.com &nbsp;&bull;&nbsp; Instagram &nbsp;&bull;&nbsp; Facebook</p>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    // GSAP for circles
    gsap.from(".decoration-circle", {
        scale: 0,
        opacity: 0,
        duration: 2,
        stagger: 0.3,
        ease: "expo.out"
    });

    document.addEventListener("mousemove", (e) => {
        const { clientX, clientY } = e;
        const xPos = (clientX / window.innerWidth - 0.5) * 40;
        const yPos = (clientY / window.innerHeight - 0.5) * 40;
        gsap.to(".circle-1", { x: xPos * 0.5, y: yPos * 0.5, duration: 1.5 });
        gsap.to(".circle-2", { x: xPos * -0.4, y: yPos * -0.4, duration: 1.5 });
        gsap.to(".circle-3", { x: xPos * 0.7, y: yPos * 0.7, duration: 1.5 });
    });

    // Reveal on scroll
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.classList.add('in-view');
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal-up').forEach(el => obs.observe(el));

    // Form Sub
    document.getElementById('contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = document.getElementById('submit-btn');
        btn.innerHTML = 'Sending...';
        btn.disabled = true;

        fetch('api/send-email.php', {
            method: 'POST',
            body: new FormData(this)
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                btn.innerHTML = 'Message Sent! <i class="fas fa-check"></i>';
                setTimeout(() => {
                    btn.innerHTML = 'Submit <i class="fas fa-arrow-right"></i>';
                    btn.disabled = false;
                    this.reset();
                }, 3000);
            } else {
                btn.innerHTML = 'Failed. Try Again';
                setTimeout(() => {
                    btn.innerHTML = 'Submit <i class="fas fa-arrow-right"></i>';
                    btn.disabled = false;
                }, 3000);
            }
        })
        .catch(err => {
            btn.innerHTML = 'Error. Try Again';
            setTimeout(() => {
                btn.innerHTML = 'Submit <i class="fas fa-arrow-right"></i>';
                btn.disabled = false;
            }, 3000);
        });
    });
</script>
<script src="script.js"></script>
</body>
</html>
