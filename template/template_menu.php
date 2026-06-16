<?php

use App\Utils\Lang;

$heroImage = '/assets/images/header/hero_menu.webp';
$heroHeight = '590px';
$heroObjectPosition = 'center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '460px';
?>

<!DOCTYPE html>
<html lang="<?= htmlspecialchars(Lang::getLocale(), ENT_QUOTES, 'UTF-8') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Lang::translate('nav.menu'), ENT_QUOTES, 'UTF-8') ?> - L'Escapade</title>
    <meta name="description" content="<?= htmlspecialchars(Lang::translate('meta.menu.description'), ENT_QUOTES, 'UTF-8') ?>">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Coming+Soon&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style/main.css?v=5000">
    <link
        rel="preload"
        as="image"
        href="<?= htmlspecialchars($heroImage, ENT_QUOTES, 'UTF-8') ?>">

    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest" />
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main class="menu-page">
        <section class="menu-page__intro">
            <div class="container">
                <span class="menu-page__subtitle"><?= htmlspecialchars(Lang::translate('menu.subtitle'), ENT_QUOTES, 'UTF-8') ?></span>
                <h1 class="menu-page__title">
                    <?= htmlspecialchars(Lang::translate('menu.title'), ENT_QUOTES, 'UTF-8') ?><br>
                    <span><?= htmlspecialchars(Lang::translate('menu.title.extra'), ENT_QUOTES, 'UTF-8') ?></span>
                </h1>
                <p class="menu-page__text">
                    <?= htmlspecialchars(Lang::translate('menu.intro'), ENT_QUOTES, 'UTF-8') ?>
                </p>
            </div>
        </section>

        <section class="menu-page__content">
            <div class="container">

                <?php if (!empty($menuByCategory)) : ?>
                    <?php foreach ($menuByCategory as $categoryName => $items) : ?>
                        <?php if (!empty($items)) : ?>
                            <section class="menu-category">
                                <div class="menu-category__header">
                                    <h2><?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8') ?></h2>
                                </div>

                                <div class="menu-category__list">
                                    <?php foreach ($items as $item) : ?>
                                        <article class="menu-entry">
                                            <div class="menu-entry__main">
                                                <div class="menu-entry__top">

                                                    <?php if (!empty($item['title_menu'])) : ?>
                                                        <h3 class="menu-entry__title">
                                                            <?= htmlspecialchars($item['title_menu'], ENT_QUOTES, 'UTF-8') ?>
                                                        </h3>
                                                    <?php endif; ?>

                                                    <?php if (!is_null($item['price_menu']) && $item['price_menu'] !== '') : ?>
                                                        <span class="menu-entry__price">
                                                            <?= number_format((float) $item['price_menu'], 2, ',', ' ') ?> €
                                                        </span>
                                                    <?php endif; ?>

                                                </div>

                                                <?php if (!empty($item['description_menu'])) : ?>
                                                    <p class="menu-entry__description">
                                                        <?= nl2br(htmlspecialchars($item['description_menu'], ENT_QUOTES, 'UTF-8')) ?>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if (!empty($item['extra_menu'])) : ?>
                                                    <div class="menu-entry__extra">
                                                        <?= nl2br(htmlspecialchars($item['extra_menu'], ENT_QUOTES, 'UTF-8')) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <section class="menu-category">
                        <div class="menu-category__header">
                            <h2><?= htmlspecialchars(Lang::translate('menu.empty.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                        </div>

                        <div class="menu-category__list">
                            <article class="menu-entry">
                                <div class="menu-entry__main">
                                    <p class="menu-entry__description">
                                        <?= htmlspecialchars(Lang::translate('menu.empty.text'), ENT_QUOTES, 'UTF-8') ?>
                                    </p>
                                </div>
                            </article>
                        </div>
                    </section>
                <?php endif; ?>

            </div>
        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/script/main.js"></script>
</body>

</html>