export const wrapLines = (elems, wrapType, wrapClass) => {
    elems.forEach(char => {
        // add a wrap for every char (overflow hidden)
        const wrapEl = document.createElement(wrapType);
        wrapEl.classList = wrapClass;
        char.parentNode.appendChild(wrapEl);
        wrapEl.appendChild(char);
    });
}

export function setupSplits(container = document) {
    const lines = container.querySelectorAll(".js-reveal-lines");

    lines.forEach(line => {
        const SplitTypeInstance = new SplitType(line, {types: 'lines'});
        // wrap the lines (div with class .oh)
        // the inner child will be the one animating the transform
        wrapLines(SplitTypeInstance.lines, 'div', 'oh');

        // Set up the anim
        line.anim = gsap.from(SplitTypeInstance.lines, {
            scrollTrigger: {
                trigger: line,
                // toggleActions: "restart pause resume reverse",
                start: "50% 97%",
                // markers: true,
            },
            duration: 2,
            ease: "expo",
            yPercent: 150,
            rotate: 15,
            stagger: 0.04,
            delay: line.dataset.revealDelay || 0,
        });
    });

    const els = container.querySelectorAll(".js-reveal-el");

    els.forEach(el => {
        ScrollTrigger.batch(el, {
            onEnter: elements => {
                gsap.from(elements, {
                    autoAlpha: 0,
                    yPercent: 100,
                    stagger: 0.08,
                    duration: 2,
                    ease: "power3",
                    delay: el.dataset.revealDelay || 0,
                });
            },
            once: true,
        });
    })
}

export function getClipPath(e, size = '0%') {
    const {height, width} = e.currentTarget.getBoundingClientRect();

    const x = e.offsetX;
    const y = e.offsetY;

    const xPercent = Math.round((x / width) * 100);
    const yPercent = Math.round((y / height) * 100);

    return `circle(${size} at ${xPercent}% ${yPercent}%)`;
}
