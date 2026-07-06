import Alpine from 'alpinejs';

document.documentElement.classList.add('js');

const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

// Count-up numbers when scrolled into view (usage: x-data="countUp(3500, '+')" x-text="display")
Alpine.data('countUp', (target = 0, suffix = '') => ({
    shown: 0,
    init() {
        if (reducedMotion || !('IntersectionObserver' in window)) {
            this.shown = target;
            return;
        }
        const io = new IntersectionObserver(([entry]) => {
            if (!entry.isIntersecting) return;
            io.disconnect();
            const duration = 1400;
            const start = performance.now();
            const step = (now) => {
                const p = Math.min((now - start) / duration, 1);
                this.shown = Math.round(target * (1 - Math.pow(1 - p, 3)));
                if (p < 1) requestAnimationFrame(step);
            };
            requestAnimationFrame(step);
        }, { threshold: 0.4 });
        io.observe(this.$el);
    },
    get display() {
        return this.shown.toLocaleString('en-IN') + suffix;
    },
}));

// Rotating word (usage: x-data="rotateWords(3)" — markup holds the stacked words)
Alpine.data('rotateWords', (count = 2, interval = 2800) => ({
    active: 0,
    init() {
        if (reducedMotion || count < 2) return;
        setInterval(() => { this.active = (this.active + 1) % count; }, interval);
    },
}));

window.Alpine = Alpine;
Alpine.start();

// Scroll-reveal: elements with [data-reveal] fade+rise in when they enter the viewport
if (!reducedMotion && 'IntersectionObserver' in window) {
    const revealIo = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                revealIo.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('[data-reveal]').forEach((el) => revealIo.observe(el));
} else {
    document.querySelectorAll('[data-reveal]').forEach((el) => el.classList.add('revealed'));
}
