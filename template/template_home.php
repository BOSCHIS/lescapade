<?php

use App\Utils\Lang;

$heroImage = '/assets/images/header/restaurant_header.webp';
$heroHeight = '850px';
$heroObjectPosition = 'center top';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '460px';
$heroTitle = Lang::translate('home.hero_title');
$heroSubtitle = Lang::translate('home.hero_subtitle');

$dayDateFormatted = '';
if (!empty($currentDay['date_day'])) {
    $timestamp = strtotime($currentDay['date_day']);
    $daysFr = [
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
    ];

    $dayNameEn = date('l', $timestamp);
    $dayNameFr = $daysFr[$dayNameEn] ?? $dayNameEn;
    $dayDateFormatted = $dayNameFr . ' ' . date('d/m/Y', $timestamp);
}

$saturdayDateFormatted = '';
if (!empty($currentSaturday['date_saturday'])) {
    $timestamp = strtotime($currentSaturday['date_saturday']);
    $daysFr = [
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday' => 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi',
    ];

    $dayNameEn = date('l', $timestamp);
    $dayNameFr = $daysFr[$dayNameEn] ?? $dayNameEn;
    $saturdayDateFormatted = $dayNameFr . ' ' . date('d/m/Y', $timestamp);
}
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(Lang::getLocale(), ENT_QUOTES, 'UTF-8') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Lang::translate('nav.home'), ENT_QUOTES, 'UTF-8') ?> - L'Escapade</title>

    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest" />
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main>
        <section class="page-content">

            <section class="home-specials">

                <!-- PLAT DU JOUR -->
                <article class="special-ticket special-ticket--day">
                    <div class="special-ticket__background">
                        <img src="/assets/images/deco/card2 copie.png" alt="Identité visuelle du plat du jour">
                    </div>

                    <div class="special-ticket__content">
                        <div class="special-ticket__main">
                            <span class="special-ticket__badge"><?= htmlspecialchars(Lang::translate('home.day.badge'), ENT_QUOTES, 'UTF-8') ?></span>

                            <?php if (!empty($currentDay)) : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars($currentDay['title_day'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">
                                    <?= number_format((float) $currentDay['price_day'], 2, ',', ' ') ?> €
                                </span>
                            <?php else : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars(Lang::translate('home.day.soon'), ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">—</span>
                            <?php endif; ?>
                        </div>

                        <div class="special-ticket__side">
                            <span class="special-ticket__date">
                                <?= !empty($dayDateFormatted)
                                    ? htmlspecialchars($dayDateFormatted, ENT_QUOTES, 'UTF-8')
                                    : htmlspecialchars(Lang::translate('home.day.available_soon'), ENT_QUOTES, 'UTF-8') ?>
                            </span>

                            <div class="special-ticket__dish-image">
                                <?php if (!empty($currentDay['image_day'])) : ?>
                                    <img
                                        src="<?= htmlspecialchars($currentDay['image_day'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($currentDay['title_day'], ENT_QUOTES, 'UTF-8') ?>">
                                <?php else : ?>
                                    <img src="/assets/images/deco/day_default.webp" alt="Plat du jour bientôt disponible">
                                <?php endif; ?>
                            </div>

                            <a href="/plat-du-jour" class="special-ticket__button">
                                <?= htmlspecialchars(Lang::translate('home.day.details'), ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </div>
                    </div>
                </article>

                <!-- PLAT DU SAMEDI -->
                <article class="special-ticket special-ticket--saturday">
                    <div class="special-ticket__background">
                        <img src="/assets/images/deco/card2 copie.png" alt="Identité visuelle du plat du samedi">
                    </div>

                    <div class="special-ticket__content">
                        <div class="special-ticket__main">
                            <span class="special-ticket__badge"><?= htmlspecialchars(Lang::translate('home.saturday.badge'), ENT_QUOTES, 'UTF-8') ?></span>

                            <?php if (!empty($currentSaturday)) : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars($currentSaturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">
                                    <?= number_format((float) $currentSaturday['price_saturday'], 2, ',', ' ') ?> €
                                </span>
                            <?php else : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars(Lang::translate('home.saturday.soon'), ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">—</span>
                            <?php endif; ?>
                        </div>

                        <div class="special-ticket__side">
                            <span class="special-ticket__date">
                                <?= !empty($saturdayDateFormatted)
                                    ? htmlspecialchars($saturdayDateFormatted, ENT_QUOTES, 'UTF-8')
                                    : htmlspecialchars(Lang::translate('home.saturday.available_soon'), ENT_QUOTES, 'UTF-8') ?>
                            </span>

                            <div class="special-ticket__dish-image">
                                <?php if (!empty($currentSaturday['image_saturday'])) : ?>
                                    <img
                                        src="<?= htmlspecialchars($currentSaturday['image_saturday'], ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($currentSaturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>">
                                <?php else : ?>
                                    <img src="/assets/images/deco/card2.png" alt="Plat du samedi bientôt disponible">
                                <?php endif; ?>
                            </div>

                            <a href="/plat-du-samedi" class="special-ticket__button">
                                <?= htmlspecialchars(Lang::translate('home.saturday.details'), ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        </div>
                    </div>
                </article>

            </section>

        </section>

        <!-- Carrousel avec des éléments dynamiques (exemple de plats du menu)---------------------------- -->
        <div class="container-fluid">
            <div class="multi-carousel-container" data-carousel="home-dishes">
                <h2><?= htmlspecialchars(Lang::translate('home.carousel.dishes'), ENT_QUOTES, 'UTF-8') ?></h2>
                <div class="multi-carousel-inner">
                    <div class="multi-carousel-item" data-index="0">
                        <div class="img-container">
                            <img src="/assets/images/home/1.webp" alt="Image 1">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="1">
                        <div class="img-container">
                            <img src="/assets/images/home/2.webp" alt="Image 2">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="2">
                        <div class="img-container">
                            <img src="/assets/images/home/3.webp" alt="Image 3">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="3">
                        <div class="img-container">
                            <img src="/assets/images/home/4.webp" alt="Image 4">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="4">
                        <div class="img-container">
                            <img src="/assets/images/home/5.webp" alt="Image 5">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="5">
                        <div class="img-container">
                            <img src="/assets/images/home/6.webp" alt="Image 6">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="6">
                        <div class="img-container">
                            <img src="/assets/images/home/7.webp" alt="Image 7">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="7">
                        <div class="img-container">
                            <img src="/assets/images/home/8.webp" alt="Image 8">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="8">
                        <div class="img-container">
                            <img src="/assets/images/home/9.webp" alt="Image 9">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="10">
                        <div class="img-container">
                            <img src="/assets/images/home/10.webp" alt="Image 10">
                        </div>
                    </div>
                </div>

                <button class="multi-carousel-control-prev" type="button" aria-label="Précédent">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="multi-carousel-control-next" type="button" aria-label="Suivant">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <!-- début caroussel carte -->

        <div class="multi-carousel-container" data-carousel="menu-preview">
            <h2>
                <?= htmlspecialchars(Lang::translate('home.carousel.menu'), ENT_QUOTES, 'UTF-8') ?>
                <span><?= htmlspecialchars(Lang::translate('home.carousel.menu.extra'), ENT_QUOTES, 'UTF-8') ?></span>
            </h2>
            <div class="multi-carousel-inner">

                <?php if (!empty($carouselItems)) : ?>
                    <?php foreach ($carouselItems as $index => $item) : ?>
                        <div class="multi-carousel-item" data-index="<?= (int) $index ?>">
                            <div class="menu-card-simple">
                                <?php if (!empty($item['name_category'])) : ?>
                                    <span class="menu-card-simple__category">
                                        <?= htmlspecialchars($item['name_category'], ENT_QUOTES, 'UTF-8') ?>
                                    </span>
                                <?php endif; ?>

                                <h3 class="menu-card-simple__title">
                                    <?= htmlspecialchars($item['title_menu'], ENT_QUOTES, 'UTF-8') ?>
                                </h3>

                                <?php if (!empty($item['description_menu'])) : ?>
                                    <p class="menu-card-simple__description">
                                        <?= htmlspecialchars($item['description_menu'], ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!is_null($item['price_menu'])) : ?>
                                    <span class="menu-card-simple__price">
                                        <?= number_format((float) $item['price_menu'], 2, ',', ' ') ?> €
                                    </span>
                                <?php endif; ?>
                                <div class="menu-card-simple__visual"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="multi-carousel-item" data-index="0">
                        <div class="menu-card-simple">
                            <span class="menu-card-simple__category">L'Escapade</span>
                            <h3 class="menu-card-simple__title"><?= htmlspecialchars(Lang::translate('home.carousel.empty.title'), ENT_QUOTES, 'UTF-8') ?></h3>
                            <p class="menu-card-simple__description">
                                <?= htmlspecialchars(Lang::translate('home.carousel.empty.text'), ENT_QUOTES, 'UTF-8') ?>
                            </p>
                            <div class="menu-card-simple__visual"></div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <button class="multi-carousel-control-prev" type="button" aria-label="Précédent">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>

            <button class="multi-carousel-control-next" type="button" aria-label="Suivant">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>

        <div class="button-wrapper">
            <a href="/menu" class="button_menu"><?= htmlspecialchars(Lang::translate('home.menu.button'), ENT_QUOTES, 'UTF-8') ?></a>
        </div>

        <!-- fin caroussel -->

        <!-- Carrousel photos restaurant---------------------------- -->
        <div class="container-fluid">
            <div class="multi-carousel-container" data-carousel="restaurant-photos">
                <h2><?= htmlspecialchars(Lang::translate('home.carousel.restaurant'), ENT_QUOTES, 'UTF-8') ?></h2>
                <div class="multi-carousel-inner">
                    <div class="multi-carousel-item" data-index="0">
                        <div class="img-container">
                            <img src="/assets/images/home/restaurant1.jpg" alt="Image 1">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="1">
                        <div class="img-container">
                            <img src="/assets/images/home/restaurant2.jpg" alt="Image 2">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="2">
                        <div class="img-container">
                            <img src="/assets/images/home/restaurant3.jpg" alt="Image 3">
                        </div>
                    </div>
                    <div class="multi-carousel-item" data-index="3">
                        <div class="img-container">
                            <img src="/assets/images/home/restaurant4.jpg" alt="Image 4">
                        </div>
                    </div>
                </div>
                <button class="multi-carousel-control-prev" type="button" aria-label="Précédent">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="multi-carousel-control-next" type="button" aria-label="Suivant">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <!-- philosophie -->
        <section class="home-philosophy">
            <div class="container">
                <article class="philosophy-card">
                    <div class="philosophy-card__ornament philosophy-card__ornament--top"></div>

                    <span class="philosophy-card__subtitle"><?= htmlspecialchars(Lang::translate('home.philosophy.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                    <h2><?= htmlspecialchars(Lang::translate('home.philosophy.title'), ENT_QUOTES, 'UTF-8') ?></h2>

                    <div class="philosophy-card__content">
                        <p><?= htmlspecialchars(Lang::translate('home.philosophy.p1'), ENT_QUOTES, 'UTF-8') ?></p>

                        <p><?= htmlspecialchars(Lang::translate('home.philosophy.p2'), ENT_QUOTES, 'UTF-8') ?></p>

                        <p><?= htmlspecialchars(Lang::translate('home.philosophy.p3'), ENT_QUOTES, 'UTF-8') ?></p>
                    </div>

                    <div class="philosophy-card__signature">
                        <span>Thomas et Alexandre</span>
                    </div>

                    <div class="philosophy-card__ornament philosophy-card__ornament--bottom"></div>
                </article>
            </div>
        </section>
        <!-- fin philosophie -->


    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <div class="lightbox" id="imageLightbox" aria-hidden="true">
        <button class="lightbox__close" type="button" aria-label="Fermer">&times;</button>
        <img class="lightbox__img" id="lightboxImg" src="" alt="">
    </div>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>

</body>

</html>