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

    <?php
    $heroImage = '/assets/images/header/hero_menu.webp';
    $heroHeight = '600px';
    $heroObjectPosition = 'center center';
    $heroTitleMarginTop = '90px';
    $heroTitle = "";
    $heroSubtitle = "";
    ?>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main class="page-carte">
        <section class="carte-section container">

            <div class="section-title">
                <span>Restaurant L'Escapade</span>
                <h2>Notre carte</h2>
            </div>

            <?php if (!empty($menuByCategory)) : ?>
                <?php foreach ($menuByCategory as $categoryName => $items) : ?>
                    <section class="carte-category">
                        <h3><?= htmlspecialchars($categoryName, ENT_QUOTES, 'UTF-8') ?></h3>

                        <div class="carte-items">
                            <?php foreach ($items as $item) : ?>
                                <article class="carte-item">
                                    <div class="carte-item__left">
                                        <h4>
                                            <?= htmlspecialchars($item['title_menu'], ENT_QUOTES, 'UTF-8') ?>
                                        </h4>

                                        <?php if (!empty($item['description_menu'])) : ?>
                                            <p>
                                                <?= htmlspecialchars($item['description_menu'], ENT_QUOTES, 'UTF-8') ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (!is_null($item['price_menu'])) : ?>
                                        <span class="carte-item__price">
                                            <?= number_format((float) $item['price_menu'], 2, ',', ' ') ?> €
                                        </span>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="carte-empty">La carte sera bientôt disponible.</p>
            <?php endif; ?>

        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>