<?php
$heroImage = $heroImage ?? '/assets/images/header/restaurant_header.webp';
$heroTitle = $heroTitle ?? "Bienvenue au<br />restaurant l'Escapade";
$heroSubtitle = $heroSubtitle ?? "Cuisine traditionnelle<br />au plein coeur de Cahors";

$heroHeight = $heroHeight ?? '900px';
$heroObjectPosition = $heroObjectPosition ?? 'center';
$heroTitleMarginTop = $heroTitleMarginTop ?? '130px';
$heroTitleMaxWidth = $heroTitleMaxWidth ?? '390px';
$heroSubtitleMaxWidth = $heroSubtitleMaxWidth ?? '430px';
?>

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
                <li><a href="/">Accueil</a></li>
                <li><a href="/menu">La Carte</a></li>
                <li><a href="/plat-du-jour">Plat du jour</a></li>
                <li><a href="/plat-du-samedi">Plat du samedi</a></li>
                <li><a href="/histoire">Notre histoire</a></li>
            </ul>

            <a href="#" class="navbar__cta">Réserver - Nous contacter</a>
        </div>
    </nav>

    <!-- HERO -->
    <section
        class="hero"
        style="
            --hero-height: <?= htmlspecialchars($heroHeight, ENT_QUOTES, 'UTF-8') ?>;
            --hero-object-position: <?= htmlspecialchars($heroObjectPosition, ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-margin-top: <?= htmlspecialchars($heroTitleMarginTop, ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-max-width: <?= htmlspecialchars($heroTitleMaxWidth, ENT_QUOTES, 'UTF-8') ?>;
            --hero-subtitle-max-width: <?= htmlspecialchars($heroSubtitleMaxWidth, ENT_QUOTES, 'UTF-8') ?>;
        ">
        <img
            class="hero__bg"
            src="<?= htmlspecialchars($heroImage, ENT_QUOTES, 'UTF-8') ?>"
            alt="Photo du restaurant" />

        <div class="hero__overlay"></div>

        <div class="hero__content">
            <?php if (!empty($heroTitle)) : ?>
                <div class="hero__title-box">
                    <h1><?= $heroTitle ?></h1>
                </div>
            <?php endif; ?>

            <?php if (!empty($heroSubtitle)) : ?>
                <div class="hero__subtitle">
                    <p><?= $heroSubtitle ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

</header>

<script>
    const toggleBtn = document.querySelector(".navbar__toggle");
    const navContent = document.querySelector(".navbar__content");

    if (toggleBtn && navContent) {
        toggleBtn.addEventListener("click", () => {
            navContent.classList.toggle("open");
        });
    }
</script>