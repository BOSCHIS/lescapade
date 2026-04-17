<?php
$heroImage = '/assets/images/header/hero_day.webp';
$heroHeight = '720px';
$heroObjectPosition = 'center center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '420px';
$heroSubtitleMaxWidth = '460px';
$heroTitle = "";
$heroSubtitle = "";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plat du jour - L'Escapade</title>

    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">

    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest" />
</head>

<body>

    <?php include __DIR__ . '/component/navbar.php'; ?>

    <main>
        <section class="day-page">
            <div class="day-page__container">

                <?php if (!empty($days)) : ?>
                    <div class="day-list">
                        <?php foreach ($days as $day) : ?>
                            <?php
                            $timestamp = !empty($day['date_day']) ? strtotime($day['date_day']) : false;
                            $dayDateFormatted = '';

                            if ($timestamp) {
                                $date = new DateTime($day['date_day']);
                                $formatter = new IntlDateFormatter(
                                    'fr_FR',
                                    IntlDateFormatter::FULL,
                                    IntlDateFormatter::NONE,
                                    'Europe/Paris',
                                    IntlDateFormatter::GREGORIAN,
                                    'EEEE dd/MM/yyyy'
                                );

                                $dayDateFormatted = ucfirst($formatter->format($date));
                            }
                            ?>

                            <article class="day-feature-card day-feature-card--list">
                                <div class="day-feature-card__visual">
                                    <?php if (!empty($day['image_day'])) : ?>
                                        <img
                                            src="<?= htmlspecialchars($day['image_day'], ENT_QUOTES, 'UTF-8') ?>"
                                            alt="<?= htmlspecialchars($day['title_day'], ENT_QUOTES, 'UTF-8') ?>">
                                    <?php else : ?>
                                        <div class="day-feature-card__visual-placeholder">
                                            <source>
                                            <img src="/assets/images/deco/day_default.webp" alt="Plat du jour bientôt disponible">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="day-feature-card__content">
                                    <span class="day-feature-card__badge">Le plat du jour</span>

                                    <?php if (!empty($dayDateFormatted)) : ?>
                                        <div class="day-feature-card__meta">
                                            <span class="day-feature-card__date">
                                                <?= htmlspecialchars($dayDateFormatted, ENT_QUOTES, 'UTF-8') ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>

                                    <h1 class="day-feature-card__title">
                                        <?= htmlspecialchars($day['title_day'], ENT_QUOTES, 'UTF-8') ?>
                                    </h1>

                                    <?php if (!empty($day['description_day'])) : ?>
                                        <div class="day-feature-card__description">
                                            <p><?= nl2br(htmlspecialchars($day['description_day'], ENT_QUOTES, 'UTF-8')) ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <div class="day-feature-card__footer">
                                        <span class="day-feature-card__price">
                                            <?= number_format((float) $day['price_day'], 2, ',', ' ') ?> €
                                        </span>

                                        <a href="/contact" class="day-feature-card__button">
                                            Réserver
                                        </a>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <section class="day-empty-state">
                        <span class="day-empty-state__badge">Le plat du jour</span>
                        <h1>Aucun plat du jour n’est disponible pour le moment</h1>
                        <p>Notre suggestion du jour sera bientôt mise en ligne.</p>
                        <a href="/menu" class="day-feature-card__button">Voir la carte</a>
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