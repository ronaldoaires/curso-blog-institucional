document.addEventListener("DOMContentLoaded", () => {
    const menuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const hamburgerIcon = document.getElementById("hamburger-icon");
    const closeIcon = document.getElementById("close-icon");
    const mobileNavLinks = document.querySelectorAll(".mobile-nav-link");
    if (!menuBtn || !mobileMenu) return;
    const toggleMenu = () => {
        const isExpanded = menuBtn.getAttribute("aria-expanded") === "true";
        const nextState = !isExpanded;
        menuBtn.setAttribute("aria-expanded", String(nextState));
        mobileMenu.classList.toggle("hidden", !nextState);
        if (hamburgerIcon && closeIcon) {
            hamburgerIcon.classList.toggle("hidden", nextState);
            closeIcon.classList.toggle("hidden", !nextState);
        }
    };
    const closeMenu = () => {
        menuBtn.setAttribute("aria-expanded", "false");
        mobileMenu.classList.add("hidden");
        if (hamburgerIcon && closeIcon) {
            hamburgerIcon.classList.remove("hidden");
            closeIcon.classList.add("hidden");
        }
    };
    menuBtn.addEventListener("click", toggleMenu);
    mobileNavLinks.forEach((link) => {
        link.addEventListener("click", closeMenu);
    });
});
