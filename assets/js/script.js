// Enhanced script.js with preserved scroll-to-top button attributes

document.addEventListener('DOMContentLoaded', function() {
    // Scroll-to-Top Button (keeping all original attributes)
    const scrollToTopBtn = document.createElement('button');
    scrollToTopBtn.textContent = '↑';
    scrollToTopBtn.style.position = 'fixed';
    scrollToTopBtn.style.bottom = '20px';
    scrollToTopBtn.style.right = '20px';
    scrollToTopBtn.style.display = 'none';
    scrollToTopBtn.style.width = '40px';
    scrollToTopBtn.style.height = '40px';
    scrollToTopBtn.style.padding = '0';
    scrollToTopBtn.style.borderRadius = '50%';
    scrollToTopBtn.style.backgroundColor = 'rgb(255, 174, 201)';
    scrollToTopBtn.style.display = 'flex';
    scrollToTopBtn.style.alignItems = 'center';
    scrollToTopBtn.style.justifyContent = 'center';
    scrollToTopBtn.style.color = 'white';
    scrollToTopBtn.style.border = 'none';
    scrollToTopBtn.style.cursor = 'pointer';
    scrollToTopBtn.style.transition = 'all 0.3s ease';
    scrollToTopBtn.style.zIndex = '1000';
    scrollToTopBtn.setAttribute('aria-label', 'Scroll to top');

    // Enhanced hover effects
    scrollToTopBtn.addEventListener('mouseover', function() {
        this.style.backgroundColor = 'rgb(233, 30, 99)';
        this.style.transform = 'scale(1.1)';
    });

    scrollToTopBtn.addEventListener('mouseout', function() {
        this.style.backgroundColor = 'rgb(255, 174, 201)';
        this.style.transform = 'scale(1)';
    });

    // Click animation
    scrollToTopBtn.addEventListener('click', function() {
        this.style.transform = 'scale(0.9)';
        window.scrollTo({ top: 0, behavior: 'smooth' });
        setTimeout(() => {
            this.style.transform = 'scale(1)';
        }, 300);
    });

    // Smooth show/hide on scroll
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.style.display = 'block';
            setTimeout(() => {
                scrollToTopBtn.style.opacity = '1';
            }, 10);
        } else {
            scrollToTopBtn.style.opacity = '0';
            setTimeout(() => {
                if (window.pageYOffset <= 300) {
                    scrollToTopBtn.style.display = 'none';
                }
            }, 300);
        }
    });

    document.body.appendChild(scrollToTopBtn);

    // Enhanced Smooth Scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.classList.add('scroll-highlight');
                setTimeout(() => target.classList.remove('scroll-highlight'), 1000);
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Add subtle hover effects to interactive elements
    const interactiveElements = document.querySelectorAll('a:not([href^="#"]), button, [role="button"], input[type="submit"]');
    interactiveElements.forEach(el => {
        el.style.transition = 'transform 0.2s ease';
        el.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        el.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
