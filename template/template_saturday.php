<?php

use App\Utils\Lang;

$heroImage = '/assets/images/header/hero_saturday.webp';
$heroHeight = '830px';
$heroObjectPosition = 'center center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '520px';
$heroTitle = "";
$heroSubtitle = "";

$locale = Lang::getLocale();

$dateLocales = [
    'fr' => 'fr_FR',
    'en' => 'en_GB',
    'es' => 'es_ES',
];

$intlLocale = $dateLocales[$locale] ?? 'fr_FR';
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars($locale, ENT_QUOTES, 'UTF-8') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Lang::translate('nav.saturday'), ENT_QUOTES, 'UTF-8') ?> - L'Escapade</title>
    <meta name="description" content="<?= htmlspecialchars(Lang::translate('meta.saturday.description'), ENT_QUOTES, 'UTF-8') ?>">
    <link
        rel="preload"
        as="image"
        href="<?= htmlspecialchars($heroImage, ENT_QUOTES, 'UTF-8') ?>">
    <link rel="stylesheet" href="/style/main.css">

    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest" />
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main class="menu-page">
        <section class="day-page">
            <div class="day-page__container">

                <?php if (!empty($saturdays)) : ?>
                    <div class="day-list">
                        <?php foreach ($saturdays as $saturday) : ?>
                            <?php
                            $timestamp = !empty($saturday['date_saturday']) ? strtotime($saturday['date_saturday']) : false;
                            $dateFormatted = '';

                            if ($timestamp) {
                                $date = new DateTime($saturday['date_saturday']);
                                $formatter = new IntlDateFormatter(
                                    $intlLocale,
                                    IntlDateFormatter::FULL,
                                    IntlDateFormatter::NONE,
                                    'Europe/Paris',
                                    IntlDateFormatter::GREGORIAN,
                                    'EEEE dd/MM/yyyy'
                                );

                                $formattedDate = $formatter->format($date);
                                $dateFormatted = $formattedDate !== false ? ucfirst($formattedDate) : '';
                            }
                            ?>
                            <article class="day-feature-card day-feature-card--list saturday-feature-card">
                                <div class="day-feature-card__visual">
                                    <?php if (!empty($saturday['image_saturday'])) : ?>
                                        <img
                                            src="<?= htmlspecialchars($saturday['image_saturday'], ENT_QUOTES, 'UTF-8') ?>"
                                            alt="<?= htmlspecialchars($saturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>">
                                    <?php else : ?>
                                        <div class="day-feature-card__visual-placeholder">
                                            <?= htmlspecialchars(Lang::translate('saturday.image_fallback_text'), ENT_QUOTES, 'UTF-8') ?>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="day-feature-card__content">
                                    <span class="day-feature-card__badge saturday-feature-card__badge"><?= htmlspecialchars(Lang::translate('saturday.badge'), ENT_QUOTES, 'UTF-8') ?></span>

                                    <?php if (!empty($dateFormatted)) : ?>
                                        <div class="day-feature-card__meta">
                                            <span class="day-feature-card__date">
                                                <?= htmlspecialchars($dateFormatted, ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <h1 class="day-feature-card__title">
                                        <?= htmlspecialchars($saturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>
                                    </h1>

                                    <?php if (!empty($saturday['description_saturday'])) : ?>
                                        <div class="day-feature-card__description">
                                            <p><?= nl2br(htmlspecialchars($saturday['description_saturday'], ENT_QUOTES, 'UTF-8')) ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="day-feature-card__footer">
                                        <span class="day-feature-card__price">
                                            <?= number_format((float) $saturday['price_saturday'], 2, ',', ' ') ?> €
                                        </span>

                                        <a href="/contact" class="day-feature-card__button saturday-feature-card__button">
                                            <?= htmlspecialchars(Lang::translate('saturday.book'), ENT_QUOTES, 'UTF-8') ?>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <section class="day-empty-state">
                        <span class="day-empty-state__badge"><?= htmlspecialchars(Lang::translate('saturday.badge'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h1><?= htmlspecialchars(Lang::translate('saturday.empty.title'), ENT_QUOTES, 'UTF-8') ?></h1>
                        <p><?= htmlspecialchars(Lang::translate('saturday.empty.text'), ENT_QUOTES, 'UTF-8') ?></p>
                        <a href="/menu" class="day-feature-card__button"><?= htmlspecialchars(Lang::translate('saturday.empty.button'), ENT_QUOTES, 'UTF-8') ?></a>
                    </section>
                <?php endif; ?>

            </div>
        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/script/main.js"></script>
</body>

</html>