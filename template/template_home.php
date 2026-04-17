<?php
$heroImage = '/assets/images/header/restaurant_header.webp';
$heroHeight = '850px';
$heroObjectPosition = 'center top';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '460px';
$heroTitle = "Bienvenue au<br />restaurant l'Escapade";
$heroSubtitle = "Cuisine traditionnelle au <br />plein coeur de Cahors";

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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - L'Escapade</title>

    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main>
        <section class="page-content">

            <section class="home-specials">

                <!-- PLAT DU JOUR -->
                <article class="special-ticket special-ticket--day">
                    <div class="special-ticket__background">
                        <img src="/assets/images/deco/card2.png" alt="Identité visuelle du plat du jour">
                    </div>

                    <div class="special-ticket__content">
                        <div class="special-ticket__main">
                            <span class="special-ticket__badge">Le plat du jour</span>

                            <?php if (!empty($currentDay)) : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars($currentDay['title_day'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">
                                    <?= number_format((float) $currentDay['price_day'], 2, ',', ' ') ?> €
                                </span>
                            <?php else : ?>
                                <h2 class="special-ticket__title">
                                    Le plat du jour arrive bientôt
                                </h2>

                                <span class="special-ticket__price">—</span>
                            <?php endif; ?>
                        </div>

                        <div class="special-ticket__side">
                            <span class="special-ticket__date">
                                <?= !empty($dayDateFormatted)
                                    ? htmlspecialchars($dayDateFormatted, ENT_QUOTES, 'UTF-8')
                                    : 'Bientôt disponible' ?>
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
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </article>

                <!-- PLAT DU SAMEDI -->
                <article class="special-ticket special-ticket--saturday">
                    <div class="special-ticket__background">
                        <img src="/assets/images/deco/card2.png" alt="Identité visuelle du plat du samedi">
                    </div>

                    <div class="special-ticket__content">
                        <div class="special-ticket__main">
                            <span class="special-ticket__badge">Le plat du samedi</span>

                            <?php if (!empty($currentSaturday)) : ?>
                                <h2 class="special-ticket__title">
                                    <?= htmlspecialchars($currentSaturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>
                                </h2>

                                <span class="special-ticket__price">
                                    <?= number_format((float) $currentSaturday['price_saturday'], 2, ',', ' ') ?> €
                                </span>
                            <?php else : ?>
                                <h2 class="special-ticket__title">
                                    Le plat du samedi arrive bientôt
                                </h2>

                                <span class="special-ticket__price">—</span>
                            <?php endif; ?>
                        </div>

                        <div class="special-ticket__side">
                            <span class="special-ticket__date">
                                <?= !empty($saturdayDateFormatted)
                                    ? htmlspecialchars($saturdayDateFormatted, ENT_QUOTES, 'UTF-8')
                                    : 'Bientôt disponible' ?>
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
                                Voir les détails
                            </a>
                        </div>
                    </div>
                </article>

            </section>

        </section>

        <!-- Carrousel avec des éléments dynamiques (exemple de plats du menu)---------------------------- -->
        <div class="container-fluid">

            <div class="multi-carousel-container" id="multiCarousel">
                <h2>À découvrir dans nos assiettes 🍴</h2>
                <div class="multi-carousel-inner" id="carouselInner">
                    <!-- Original items only -->
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

                <button class="multi-carousel-control-prev" id="prevBtn">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="multi-carousel-control-next" id="nextBtn">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>


        <!-- début caroussel carte -->

        <div class="multi-carousel-container" id="multiCarousel">
            <h2>Aperçu de la carte🍴</h2>
            <div class="multi-carousel-inner" id="carouselInner">

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
                            <h3 class="menu-card-simple__title">La carte arrive bientôt</h3>
                            <p class="menu-card-simple__description">
                                Nos suggestions gourmandes seront bientôt affichées ici.
                            </p>
                            <div class="menu-card-simple__visual"></div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <button class="multi-carousel-control-prev" id="prevBtn" type="button">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>

            <button class="multi-carousel-control-next" id="nextBtn" type="button">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>

        <div class="button-wrapper">
            <a href="/menu" class="button_menu">Voir la carte</a>
        </div>

        <!-- fin caroussel -->

        <!-- Carrousel photos restaurant---------------------------- -->
        <div class="container-fluid">

            <div class="multi-carousel-container" id="multiCarousel">
                <h2>Le restaurant L'Escapade</h2>
                <div class="multi-carousel-inner" id="carouselInner">
                    <!-- Original items only -->
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

                <button class="multi-carousel-control-prev" id="prevBtn">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="multi-carousel-control-next" id="nextBtn">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
        </div>

        <!-- philosophie -->
        <section class="home-philosophy">
            <div class="container">
                <article class="philosophy-card">
                    <div class="philosophy-card__ornament philosophy-card__ornament--top"></div>

                    <span class="philosophy-card__subtitle">L’âme de L’Escapade</span>
                    <h2>Notre philosophie</h2>

                    <div class="philosophy-card__content">
                        <p>
                            Fiers de nos racines cadurciennes, nous avons repris cette emblématique adresse
                            dans le but de faire perdurer l’histoire de ce lieu. Nous nous efforcerons de mettre
                            en avant des produits de notre territoire dans l’esprit bistrot.
                        </p>

                        <p>
                            Favoriser les circuits courts, aller à la rencontre de nos artisans, de nos éleveurs
                            et de nos viticulteurs, telle est notre philosophie.
                        </p>

                        <p>
                            La cuisine est un moment de convivialité au sein de notre famille, c’est ce que nous
                            souhaitons partager avec vous.
                        </p>
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

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>