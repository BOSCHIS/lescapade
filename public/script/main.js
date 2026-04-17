document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.querySelector(".navbar__toggle");
    const navContent = document.querySelector(".navbar__content");

    if (toggleBtn && navContent) {
        toggleBtn.addEventListener("click", () => {
            navContent.classList.toggle("open");
        });
    }
});


// =========================
// CARROUSELS MULTIPLES
// =========================
const carouselContainers = document.querySelectorAll(".multi-carousel-container[data-carousel]");

carouselContainers.forEach((carousel) => {
    const carouselInner = carousel.querySelector(".multi-carousel-inner");
    const prevBtn = carousel.querySelector(".multi-carousel-control-prev");
    const nextBtn = carousel.querySelector(".multi-carousel-control-next");

    if (!carouselInner || !prevBtn || !nextBtn) {
        return;
    }

    let itemsPerSlide = window.innerWidth < 720 ? 1 : 3;
    let slideBy = 1;
    let isAnimating = false;
    let isDragging = false;
    let startX = 0;
    let startPosition = 0;
    let position = 0;
    let currentIndex = 0;
    let autoAdvanceInterval = null;
    let userActivityTimeout = null;

    function getOriginalItems() {
        return Array.from(carouselInner.querySelectorAll(".multi-carousel-item:not(.clone)"));
    }

    function getTotalItems() {
        return getOriginalItems().length;
    }

    function updateConfig() {
        itemsPerSlide = window.innerWidth < 720 ? 1 : 3;
        slideBy = 1;
    }

    function initializeClones() {
        const originalItems = getOriginalItems();

        carouselInner.querySelectorAll(".clone").forEach((clone) => clone.remove());

        if (originalItems.length === 0) {
            return;
        }

        const prependClones = originalItems
            .slice(-itemsPerSlide)
            .map((item) => {
                const clone = item.cloneNode(true);
                clone.classList.add("clone");
                return clone;
            })
            .reverse();

        prependClones.forEach((clone) => carouselInner.prepend(clone));

        const appendClones = originalItems
            .slice(0, itemsPerSlide)
            .map((item) => {
                const clone = item.cloneNode(true);
                clone.classList.add("clone");
                return clone;
            });

        appendClones.forEach((clone) => carouselInner.append(clone));
    }

    function updateCarouselPosition(animate = true) {
        if (animate) {
            carouselInner.style.transition = "transform 0.5s ease";
        } else {
            carouselInner.style.transition = "none";
        }

        const translateX = (position * -100) / itemsPerSlide;
        carouselInner.style.transform = `translateX(${translateX}%)`;
    }

    function initializeCarousel() {
        updateConfig();
        initializeClones();

        if (getTotalItems() === 0) {
            return;
        }

        position = itemsPerSlide;
        currentIndex = 0;
        updateCarouselPosition(false);

        const carouselImages = carousel.querySelectorAll("img");
        carouselImages.forEach((img) => {
            img.addEventListener("dragstart", (e) => e.preventDefault());
            img.style.pointerEvents = "none";
        });
    }

    function next() {
        if (isAnimating || getTotalItems() === 0) return;
        isAnimating = true;
        position += slideBy;
        updateCarouselPosition(true);
    }

    function prev() {
        if (isAnimating || getTotalItems() === 0) return;
        isAnimating = true;
        position -= slideBy;
        updateCarouselPosition(true);
    }

    function startAutoAdvance() {
        clearInterval(autoAdvanceInterval);
        autoAdvanceInterval = setInterval(() => {
            next();
        }, 5000);
    }

    function resetAutoAdvanceTimer() {
        clearTimeout(userActivityTimeout);
        clearInterval(autoAdvanceInterval);
        userActivityTimeout = setTimeout(() => {
            startAutoAdvance();
        }, 10000);
    }

    function registerUserActivity() {
        resetAutoAdvanceTimer();
    }

    function startDrag(e) {
        if (isAnimating || getTotalItems() === 0) return;

        isDragging = true;
        startX = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
        startPosition = position;

        carousel.classList.add("dragging");
        carouselInner.style.transition = "none";
        document.body.style.cursor = "grabbing";
        document.body.style.userSelect = "none";
        registerUserActivity();
    }

    function drag(e) {
        if (!isDragging) return;

        const x = e.type.includes("mouse") ? e.clientX : e.touches[0].clientX;
        const walk = ((x - startX) / carousel.offsetWidth) * itemsPerSlide;
        const newPosition = startPosition - walk;
        const translateX = (newPosition * -100) / itemsPerSlide;
        carouselInner.style.transform = `translateX(${translateX}%)`;
    }

    function endDrag(e) {
        if (!isDragging) return;

        isDragging = false;
        carousel.classList.remove("dragging");
        document.body.style.cursor = "";
        document.body.style.userSelect = "";
        carouselInner.style.transition = "transform 0.5s ease";

        const x = e.type?.includes("mouse")
            ? e.clientX
            : e.changedTouches
                ? e.changedTouches[0].clientX
                : startX;

        const walk = ((x - startX) / carousel.offsetWidth) * itemsPerSlide;

        if (walk > 0.2) {
            prev();
        } else if (walk < -0.2) {
            next();
        } else {
            updateCarouselPosition(true);
        }

        registerUserActivity();
    }

    carouselInner.addEventListener("transitionend", () => {
        const totalItems = getTotalItems();
        isAnimating = false;

        if (totalItems === 0) {
            return;
        }

        if (position >= totalItems + itemsPerSlide) {
            position = itemsPerSlide + (position - (totalItems + itemsPerSlide));
            updateCarouselPosition(false);
        } else if (position < itemsPerSlide) {
            position = totalItems + position;
            updateCarouselPosition(false);
        }

        currentIndex = ((position - itemsPerSlide) % totalItems + totalItems) % totalItems;
    });

    nextBtn.addEventListener("click", () => {
        next();
        registerUserActivity();
    });

    prevBtn.addEventListener("click", () => {
        prev();
        registerUserActivity();
    });

    carousel.addEventListener("mousedown", startDrag);
    carousel.addEventListener("touchstart", startDrag, { passive: true });

    carousel.addEventListener("mousemove", drag);
    carousel.addEventListener("touchmove", drag, { passive: true });

    carousel.addEventListener("mouseup", endDrag);
    carousel.addEventListener("touchend", endDrag);
    carousel.addEventListener("mouseleave", endDrag);

    carousel.addEventListener("mouseenter", () => {
        clearInterval(autoAdvanceInterval);
    });

    carousel.addEventListener("mouseleave", () => {
        resetAutoAdvanceTimer();
    });

    carousel.addEventListener("click", registerUserActivity);
    carousel.addEventListener("wheel", registerUserActivity);

    document.addEventListener("keydown", (e) => {
        if (carousel.offsetParent === null) return;

        if (
            document.activeElement.tagName === "INPUT" ||
            document.activeElement.tagName === "TEXTAREA" ||
            document.activeElement.isContentEditable
        ) {
            return;
        }

        if (e.key === "ArrowLeft") {
            e.preventDefault();
            prev();
            registerUserActivity();
        }

        if (e.key === "ArrowRight") {
            e.preventDefault();
            next();
            registerUserActivity();
        }
    });

    initializeCarousel();
    startAutoAdvance();

    window.addEventListener("resize", () => {
        const wasMobile = itemsPerSlide === 1;
        updateConfig();
        const isMobile = itemsPerSlide === 1;

        if (wasMobile !== isMobile) {
            initializeCarousel();
        } else {
            updateCarouselPosition(false);
        }
    });
});

// Scroll to top button
const scrollTopBtn = document.getElementById("scrollTopBtn");

if (scrollTopBtn) {
    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            scrollTopBtn.classList.add("show");
        } else {
            scrollTopBtn.classList.remove("show");
        }
    });

    scrollTopBtn.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
}

// Menu burger
const navbarToggle = document.querySelector(".navbar__toggle");
const navbarContent = document.querySelector(".navbar__content");

if (navbarToggle && navbarContent) {
    navbarToggle.addEventListener("click", () => {
        const isOpen = navbarContent.classList.toggle("open");
        navbarToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    const navbarLinks = navbarContent.querySelectorAll("a");

    navbarLinks.forEach((link) => {
        link.addEventListener("click", () => {
            if (window.innerWidth <= 980) {
                navbarContent.classList.remove("open");
                navbarToggle.setAttribute("aria-expanded", "false");
            }
        });
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth > 980) {
            navbarContent.classList.remove("open");
            navbarToggle.setAttribute("aria-expanded", "false");
        }
    });
}