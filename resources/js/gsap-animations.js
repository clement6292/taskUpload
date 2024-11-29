gsap.registerPlugin(ScrollTrigger);
gsap.to(".logout" ,{
    scrollTrigger: ".site",
    scale: 0.7,
    repeat: -1,
    yoyo: true,
    ease: "power5", 
});

// gsap.to(".point" ,{
//     scrollTrigger: ".point",
//     scale: 0.7,
//     repeat: -1,
//     yoyo: true,
//     ease: "power2",
// });