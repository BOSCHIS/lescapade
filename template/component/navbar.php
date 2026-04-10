<header class="site-header">

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar__logo">
            <img src="/assets/images/logo/logo_orange.webp" alt="Logo L'Escapade" />
        </div>

        <button class="navbar__toggle" aria-label="Ouvrir le menu">
            ☰
        </button>

        <div class="navbar__content">
            <ul class="navbar__links">
                <li><a href="#" class="active">Accueil</a></li>
                <li><a href="#">La Carte</a></li>
                <li><a href="#">Plat du jour</a></li>
                <li><a href="#">Plat du samedi</a></li>
                <li><a href="#">Notre histoire</a></li>
            </ul>

            <a href="#" class="navbar__cta">Réserver - Nous contacter</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <img class="hero__bg" src="/assets/images/header/restaurant_header.webp" alt="Photo du restaurant" />

        <div class="hero__overlay"></div>

        <div class="hero__content">
            <div class="hero__title-box">
                <h1>Bienvenue au<br />restaurant l'Escapade</h1>
            </div>

            <div class="hero__subtitle">
                <p>Cuisine traditionnelle<br />au plein coeur de Cahors</p>
            </div>
        </div>

    </section>

</header>

<script>
    const toggleBtn = document.querySelector(".navbar__toggle");
    const navContent = document.querySelector(".navbar__content");

    toggleBtn.addEventListener("click", () => {
        navContent.classList.toggle("open");
    });
</script>