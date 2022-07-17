import Alpine from 'alpinejs'
import { FastAverageColor } from 'fast-average-color';
import FormsAlpinePlugin from '../../vendor/filament/forms/dist/module.esm'
import {getClipPath, setupSplits} from './utils'
import './magic-button'
import './magic-cursor'

Alpine.plugin(FormsAlpinePlugin)

document.addEventListener('livewire:load', function () {
    Alpine.data('Main', () => ({
        menu: false,
        init() {
            const body = document.querySelector('body');

            this.$nextTick(() => {
                body.classList.replace('opacity-0', 'opacity-100');

                setupSplits();

                // Delayed Sections
                const delSections = document.querySelectorAll(".js-delayed-section");

                delSections.forEach(section => {
                    const containerAnim = gsap.to(section.querySelector(".js-delayed-container"), {
                        y: "100vh",
                        ease: "none"
                    });

                    const imageAnim = gsap.to(section.querySelector(".js-delayed-img"), {
                        y: "-100vh",
                        ease: "none",
                        paused: true
                    });

                    const scrub = gsap.to(imageAnim, {
                        progress: 1,
                        paused: true,
                        ease: "power3",
                        duration: parseFloat(section.dataset.scrub) || 0.1,
                        overwrite: true
                    });

                    ScrollTrigger.create({
                        animation: containerAnim,
                        scrub: true,
                        trigger: section,
                        start: "top bottom",
                        end: "bottom top",
                        onUpdate: self => {
                            scrub.vars.progress = self.progress;
                            scrub.invalidate().restart();
                        }
                    });
                });
            });

            this.$watch('menu', value => {
                if (value) {
                    body.classList.add('overflow-hidden');
                    setupSplits(document.querySelector('.js-menu'));
                } else {
                    body.classList.remove('overflow-hidden');
                }
            });
        }
    }));
})

window.Alpine = Alpine

window.getClipPath = getClipPath

Alpine.start()

window.FastAverageColor = FastAverageColor
