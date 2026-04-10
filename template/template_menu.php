<?php
$heroImage = '/assets/images/header/hero_menu.webp';
$heroHeight = '590px';
$heroObjectPosition = 'center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '460px';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Carte - L'Escapade</title>

    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main class="menu-page">
        <section class="menu-page__intro">
            <div class="container">
                <span class="menu-page__subtitle">Restaurant L'Escapade</span>
                <h1 class="menu-page__title">Notre carte</h1>
                <p class="menu-page__text">
                    Découvrez une cuisine bistrot généreuse, des produits du terroir
                    et des assiettes pensées pour le plaisir, le partage et la convivialité.
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
                            <h2>La carte arrive bientôt</h2>
                        </div>

                        <div class="menu-category__list">
                            <article class="menu-entry">
                                <div class="menu-entry__main">
                                    <p class="menu-entry__description">
                                        Notre carte est en cours de préparation.
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

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>