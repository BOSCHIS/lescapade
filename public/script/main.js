document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.querySelector(".navbar__toggle");
    const navContent = document.querySelector(".navbar__content");

    if (toggleBtn && navContent) {
        toggleBtn.addEventListener("click", () => {
            navContent.classList.toggle("open");
        });
    }
});

/* =========================
      CARROUSELS MULTIPLES
   ========================= */
const carouselContainers = document.querySelectorAll(".multi-carousel-container[data-carousel]");

carouselContainers.forEach((carousel) => {
    const carouselInner = carousel.querySelector(".multi-carousel-inner");
    const prevBtn = carousel.querySelector(".multi-carousel-control-prev");
    const nextBtn = carousel.querySelector(".multi-carousel-control-next");

    if (!carouselInner || !prevBtn || !nextBtn) {
        return;
    }

    let itemsPerSlide = 3;
    let slideBy = 1;
    let isAnimating = false;
    let isDragging = false;
    let dragMoved = false;
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
        itemsPerSlide = window.innerWidth <= 992 ? 1 : 3;
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
        carouselInner.style.transition = animate ? "transform 0.5s ease" : "none";
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
            // IMPORTANT : on ne met PAS pointerEvents = "none"
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

    function getClientX(e) {
        if (e.type.includes("mouse")) return e.clientX;
        if (e.touches && e.touches[0]) return e.touches[0].clientX;
        if (e.changedTouches && e.changedTouches[0]) return e.changedTouches[0].clientX;
        return startX;
    }

    function startDrag(e) {
        if (isAnimating || getTotalItems() === 0) return;

        isDragging = true;
        dragMoved = false;
        startX = getClientX(e);
        startPosition = position;

        carousel.classList.add("dragging");
        carouselInner.style.transition = "none";
        document.body.style.cursor = "grabbing";
        document.body.style.userSelect = "none";

        registerUserActivity();
    }

    function drag(e) {
        if (!isDragging) return;

        const x = getClientX(e);
        const walk = ((x - startX) / carousel.offsetWidth) * itemsPerSlide;

        if (Math.abs(x - startX) > 8) {
            dragMoved = true;
        }

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

        const x = getClientX(e);
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

    nextBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
        next();
        registerUserActivity();
    });

    prevBtn.addEventListener("click", (e) => {
        e.preventDefault();
        e.stopPropagation();
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

    // Expose dragMoved pour la lightbox
    carousel.dataset.dragMoved = "false";

    carousel.addEventListener("mousedown", () => {
        carousel.dataset.dragMoved = "false";
    });

    carousel.addEventListener("mousemove", () => {
        if (isDragging && dragMoved) {
            carousel.dataset.dragMoved = "true";
        }
    });

    carousel.addEventListener("touchstart", () => {
        carousel.dataset.dragMoved = "false";
    });

    carousel.addEventListener("touchmove", () => {
        if (isDragging && dragMoved) {
            carousel.dataset.dragMoved = "true";
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
/* =========================
       LIGHTBOX
    ========================= */
const lightbox = document.getElementById("imageLightbox");
const lightboxImg = document.getElementById("lightboxImg");
const lightboxClose = document.querySelector(".lightbox__close");

if (lightbox && lightboxImg && lightboxClose) {
    function openLightbox(src, alt = "") {
        lightboxImg.src = src;
        lightboxImg.alt = alt;
        lightbox.classList.add("open");
        lightbox.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";
    }

    function closeLightbox() {
        lightbox.classList.remove("open");
        lightbox.setAttribute("aria-hidden", "true");
        lightboxImg.src = "";
        lightboxImg.alt = "";
        document.body.style.overflow = "";
    }

    document.addEventListener("click", (e) => {
        const img = e.target.closest(".multi-carousel-item img, .special-ticket__dish-image img");
        if (!img) return;

        const parentCarousel = img.closest(".multi-carousel-container");

        if (parentCarousel && parentCarousel.dataset.dragMoved === "true") {
            return;
        }

        e.preventDefault();
        e.stopPropagation();

        openLightbox(img.currentSrc || img.src, img.alt || "");
    });

    lightboxClose.addEventListener("click", closeLightbox);

    lightbox.addEventListener("click", (e) => {
        if (e.target === lightbox) {
            closeLightbox();
        }
    });

    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape" && lightbox.classList.contains("open")) {
            closeLightbox();
        }
    });
}
