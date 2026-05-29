<?php

use App\Utils\Lang;

$heroImage = '/assets/images/header/hero_history.webp';
$heroHeight = '780px';
$heroObjectPosition = 'center center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '520px';
$heroTitle = "";
$heroSubtitle = "";
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(Lang::getLocale(), ENT_QUOTES, 'UTF-8') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Lang::translate('nav.history'), ENT_QUOTES, 'UTF-8') ?> - L'Escapade</title>
    <meta name="description" content="<?= htmlspecialchars(Lang::translate('meta.history.description'), ENT_QUOTES, 'UTF-8') ?>">
    <link
        rel="preload"
        as="image"
        href="<?= htmlspecialchars($heroImage, ENT_QUOTES, 'UTF-8') ?>">
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

            <section class="home-philosophy">
                <div class="container">
                    <h1><?= htmlspecialchars(Lang::translate('history.heading'), ENT_QUOTES, 'UTF-8') ?></h1>

                    <article class="philosophy-card">
                        <div class="philosophy-card__ornament philosophy-card__ornament--top"></div>

                        <span class="philosophy-card__subtitle"><?= htmlspecialchars(Lang::translate('history.philosophy.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h2><?= htmlspecialchars(Lang::translate('history.philosophy.title'), ENT_QUOTES, 'UTF-8') ?></h2>

                        <div class="philosophy-card__content">
                            <p><?= htmlspecialchars(Lang::translate('history.philosophy.p1'), ENT_QUOTES, 'UTF-8') ?></p>

                            <p><?= htmlspecialchars(Lang::translate('history.philosophy.p2'), ENT_QUOTES, 'UTF-8') ?></p>

                            <p><?= htmlspecialchars(Lang::translate('history.philosophy.p3'), ENT_QUOTES, 'UTF-8') ?></p>
                        </div>

                        <div class="philosophy-card__signature">
                            <span><?= htmlspecialchars(Lang::translate('history.signature'), ENT_QUOTES, 'UTF-8') ?></span>
                        </div>

                        <div class="philosophy-card__ornament philosophy-card__ornament--bottom"></div>
                    </article>
                </div>
            </section>

            <section class="history-values">
                <div class="container">
                    <div class="history-values__grid">

                        <article class="history-values__card">
                            <span class="history-values__subtitle"><?= htmlspecialchars(Lang::translate('history.values.product.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                            <h2><?= htmlspecialchars(Lang::translate('history.values.product.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                            <p><?= htmlspecialchars(Lang::translate('history.values.product.p1'), ENT_QUOTES, 'UTF-8') ?></p>
                            <p><?= htmlspecialchars(Lang::translate('history.values.product.p2'), ENT_QUOTES, 'UTF-8') ?></p>
                        </article>

                        <article class="history-values__card">
                            <span class="history-values__subtitle"><?= htmlspecialchars(Lang::translate('history.values.producers.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                            <h2><?= htmlspecialchars(Lang::translate('history.values.producers.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                            <p><?= htmlspecialchars(Lang::translate('history.values.producers.p1'), ENT_QUOTES, 'UTF-8') ?></p>
                            <p><?= htmlspecialchars(Lang::translate('history.values.producers.p2'), ENT_QUOTES, 'UTF-8') ?></p>
                        </article>

                        <article class="history-values__card">
                            <span class="history-values__subtitle"><?= htmlspecialchars(Lang::translate('history.values.experience.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                            <h2><?= htmlspecialchars(Lang::translate('history.values.experience.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                            <p><?= htmlspecialchars(Lang::translate('history.values.experience.p1'), ENT_QUOTES, 'UTF-8') ?></p>
                            <p><?= htmlspecialchars(Lang::translate('history.values.experience.p2'), ENT_QUOTES, 'UTF-8') ?></p>
                        </article>

                    </div>
                </div>
            </section>

        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/script/main.js"></script>
</body>

</html>