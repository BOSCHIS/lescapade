<?php

use App\Utils\Lang;

$currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentLocale = Lang::getLocale();

$heroImage = $heroImage ?? '/assets/images/header/restaurant_header.webp';
$heroTitle = $heroTitle ?? "Bienvenue au<br />Restaurant L'Escapade";
$heroSubtitle = $heroSubtitle ?? "Cuisine traditionnelle<br />au plein coeur de Cahors";

$heroHeight = $heroHeight ?? '900px';
$heroObjectPosition = $heroObjectPosition ?? 'center';
$heroTitleMarginTop = $heroTitleMarginTop ?? '130px';
$heroTitleMaxWidth = $heroTitleMaxWidth ?? '390px';
$heroSubtitleMaxWidth = $heroSubtitleMaxWidth ?? '430px';

$heroTitleAlign = $heroTitleAlign ?? 'flex-start';
$heroTitleOffsetX = $heroTitleOffsetX ?? '40px';

$heroSubtitleAlign = $heroSubtitleAlign ?? 'flex-end';
$heroSubtitleOffsetX = $heroSubtitleOffsetX ?? '40px';
$heroSubtitleOffsetY = $heroSubtitleOffsetY ?? '20px';

$localeLabels = [
    'fr' => Lang::translate('lang.french'),
    'en' => Lang::translate('lang.english'),
    'es' => Lang::translate('lang.spanish'),
];

$localeFlags = [
    'fr' => '/assets/images/flags/fr.webp',
    'en' => '/assets/images/flags/gb.webp',
    'es' => '/assets/images/flags/es.webp',
];
?>

<header class="site-header">

    <nav class="navbar">
        <div class="navbar__branding">
            <a href="/" class="navbar__logo" aria-label="Retour à l'accueil">
                <img src="/assets/images/logo/logo_orange.webp" alt="Logo L'Escapade" />
            </a>

            <div class="navbar__brand-text">L'Escapade</div>
        </div>

        <button
            class="navbar__toggle"
            type="button"
            aria-label="Ouvrir le menu"
            aria-expanded="false"
            aria-controls="navbarContent">
            ☰
        </button>

        <div class="navbar__content" id="navbarContent">
            <ul class="navbar__links">
                <li><a href="/" class="<?= $currentPage === '/' ? 'active' : '' ?>"><?= htmlspecialchars(Lang::translate('nav.home'), ENT_QUOTES, 'UTF-8') ?></a></li>
                <li><a href="/menu" class="<?= $currentPage === '/menu' ? 'active' : '' ?>"><?= htmlspecialchars(Lang::translate('nav.menu'), ENT_QUOTES, 'UTF-8') ?></a></li>
                <li><a href="/plat-du-jour" class="<?= $currentPage === '/plat-du-jour' ? 'active' : '' ?>"><?= htmlspecialchars(Lang::translate('nav.day'), ENT_QUOTES, 'UTF-8') ?></a></li>
                <li><a href="/plat-du-samedi" class="<?= $currentPage === '/plat-du-samedi' ? 'active' : '' ?>"><?= htmlspecialchars(Lang::translate('nav.saturday'), ENT_QUOTES, 'UTF-8') ?></a></li>
                <li><a href="/histoire" class="<?= $currentPage === '/histoire' ? 'active' : '' ?>"><?= htmlspecialchars(Lang::translate('nav.history'), ENT_QUOTES, 'UTF-8') ?></a></li>
            </ul>

            <div class="navbar__actions">
                <div class="language-switcher">
                    <button
                        class="language-switcher__current"
                        type="button"
                        aria-label="Choisir la langue">
                        <img
                            src="<?= htmlspecialchars($localeFlags[$currentLocale], ENT_QUOTES, 'UTF-8') ?>"
                            alt="<?= htmlspecialchars($localeLabels[$currentLocale], ENT_QUOTES, 'UTF-8') ?>">
                    </button>

                    <div class="language-switcher__menu">
                        <a href="/lang?locale=fr" class="language-switcher__option<?= $currentLocale === 'fr' ? ' active' : '' ?>">
                            <img src="/assets/images/flags/fr.webp" alt="Français">
                            <span><?= htmlspecialchars(Lang::translate('lang.french'), ENT_QUOTES, 'UTF-8') ?></span>
                        </a>

                        <a href="/lang?locale=en" class="language-switcher__option<?= $currentLocale === 'en' ? ' active' : '' ?>">
                            <img src="/assets/images/flags/gb.webp" alt="English">
                            <span><?= htmlspecialchars(Lang::translate('lang.english'), ENT_QUOTES, 'UTF-8') ?></span>
                        </a>

                        <a href="/lang?locale=es" class="language-switcher__option<?= $currentLocale === 'es' ? ' active' : '' ?>">
                            <img src="/assets/images/flags/es.webp" alt="Español">
                            <span><?= htmlspecialchars(Lang::translate('lang.spanish'), ENT_QUOTES, 'UTF-8') ?></span>
                        </a>
                    </div>
                </div>

                <a href="/contact" class="navbar__cta"><?= htmlspecialchars(Lang::translate('nav.contact'), ENT_QUOTES, 'UTF-8') ?></a>
            </div>
        </div>
    </nav>

    <section
        class="hero"
        style="
            --hero-height: <?= htmlspecialchars($heroHeight, ENT_QUOTES, 'UTF-8') ?>;
            --hero-object-position: <?= htmlspecialchars($heroObjectPosition, ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-margin-top: <?= htmlspecialchars($heroTitleMarginTop = "150px", ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-max-width: <?= htmlspecialchars($heroTitleMaxWidth, ENT_QUOTES, 'UTF-8') ?>;
            --hero-subtitle-max-width: <?= htmlspecialchars($heroSubtitleMaxWidth, ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-align: <?= htmlspecialchars($heroTitleAlign, ENT_QUOTES, 'UTF-8') ?>;
            --hero-title-offset-x: <?= htmlspecialchars($heroTitleOffsetX = "160px", ENT_QUOTES, 'UTF-8') ?>;
            --hero-subtitle-align: <?= htmlspecialchars($heroSubtitleAlign, ENT_QUOTES, 'UTF-8') ?>;
            --hero-subtitle-offset-x: <?= htmlspecialchars($heroSubtitleOffsetX = "80px", ENT_QUOTES, 'UTF-8') ?>;
            --hero-subtitle-offset-y: <?= htmlspecialchars($heroSubtitleOffsetY = "180px", ENT_QUOTES, 'UTF-8') ?>;
        ">
        <img
            class="hero__bg"
            src="<?= htmlspecialchars($heroImage, ENT_QUOTES, 'UTF-8') ?>"
            alt="Photo du restaurant" fetchpriority="high" />

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