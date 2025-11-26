@push('scripts')
<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('active');
    });

    // Accordion
    function toggleAccordion(button) {
        const content = button.nextElementSibling;
        const icon = button.querySelector('[data-lucide="chevron-down"]');
        const isActive = content.classList.contains('active');

        document.querySelectorAll('.accordion-content').forEach(i => i.classList.remove('active'));
        document.querySelectorAll('.accordion-trigger [data-lucide="chevron-down"]').forEach(i => {
            i.style.transform = 'rotate(0deg)';
        });

        if (!isActive) {
            content.classList.add('active');
            icon.style.transform = 'rotate(180deg)';
        }
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', e => {
            e.preventDefault();

            const target = document.querySelector(anchor.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                mobileMenu?.classList.remove('active');
            }
        });
    });

    // Scroll animations
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.scroll-animate').forEach(el => observer.observe(el));
</script>
@endpush
