const element = document.querySelector("[data-magic-cursor]");

class Cursor {
    constructor(el) {
        this.el = el;
        this.bind();
    }

    bind() {
        document.addEventListener("mousemove", this.move.bind(this), false);
    }

    move(e) {
        const cursorPosition = {
            left: e.clientX,
            top: e.clientY
        };
        document.querySelectorAll("[data-magic-cursor-area]").forEach((single) => {
            const triggerDistance = single.getBoundingClientRect().width;

            const targetPosition = {
                left:
                    single.getBoundingClientRect().left +
                    single.getBoundingClientRect().width / 2,
                top:
                    single.getBoundingClientRect().top +
                    single.getBoundingClientRect().height / 2
            };
            const distance = {
                x: targetPosition.left - cursorPosition.left,
                y: targetPosition.top - cursorPosition.top
            };

            const angle = Math.atan2(distance.x, distance.y);
            const hypotenuse = Math.sqrt(
                distance.x * distance.x + distance.y * distance.y
            );
            if (hypotenuse < triggerDistance) {
                gsap.to(this.el, 0.2, {
                    left: targetPosition.left - (Math.sin(angle) * hypotenuse) / 2,
                    top: targetPosition.top - (Math.cos(angle) * hypotenuse) / 2,
                    height: single.clientHeight,
                    width: single.clientWidth
                });
                gsap.to(single.querySelector("[data-magic-cursor-target]"), 0.2, {
                    x: -((Math.sin(angle) * hypotenuse) / 2),
                    y: -((Math.cos(angle) * hypotenuse) / 2)
                });
            } else {
                gsap.to(this.el, 0.2, {
                    left: cursorPosition.left,
                    top: cursorPosition.top,
                    height: "16px",
                    width: "16px"
                });

                gsap.to(single.querySelector("[data-magic-cursor-target]"), 0.2, {
                    x: 0,
                    y: 0
                });
            }
        });
    }
}

const cursor = new Cursor(element);
