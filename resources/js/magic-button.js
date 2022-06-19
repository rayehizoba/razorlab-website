document.addEventListener('alpine:init', () => {
    setTimeout(function () {
        const mWrap = document.querySelectorAll("[data-magic-button]");

        function parallaxIt(e, wrap, movement = 1) {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const boundingRect = wrap.mArea.getBoundingClientRect();
            const halfDiff = Math.abs(boundingRect.width - boundingRect.height) / 2;
            const relX = e.pageX - boundingRect.left - halfDiff;
            const relY = e.pageY - boundingRect.top;

            gsap.to(wrap.mContent, {
                x: (relX - boundingRect.width / 4) / boundingRect.width * movement,
                y: (relY - boundingRect.height / 2 - scrollTop) / boundingRect.height * movement,
                ease: "power1",
                duration: 0.6
            });
        }

        mWrap.forEach(function (wrap) {
            wrap.mContent = wrap.querySelector("[data-magic-button-content]");
            wrap.mArea = wrap.querySelector("[data-magic-button-area]");

            wrap.mArea.addEventListener("mousemove", function (e) {
                parallaxIt(e, wrap, 80);
            });

            wrap.mArea.addEventListener("mouseleave", function (e) {
                gsap.to(wrap.mContent, {
                    scale: 1,
                    x: 0,
                    y: 0,
                    ease: "power3",
                    duration: 0.6
                });
            });
        });
    }, 500);
});
