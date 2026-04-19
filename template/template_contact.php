<?php

use App\Utils\Lang;

$heroImage = '/assets/images/header/restaurant_header.webp';
$heroHeight = '720px';
$heroObjectPosition = 'center center';
$heroTitleMarginTop = '90px';
$heroTitleMaxWidth = '520px';
$heroSubtitleMaxWidth = '620px';
$heroTitle = "";
$heroSubtitle = "";
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars(Lang::getLocale(), ENT_QUOTES, 'UTF-8') ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(Lang::translate('nav.contact'), ENT_QUOTES, 'UTF-8') ?> - L'Escapade</title>

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

    <main class="menu-page">
        <section class="contact-page">
            <div class="contact-page__container">

                <section class="contact-intro-card">
                    <div class="contact-intro-card__content">
                        <span class="contact-intro-card__badge"><?= htmlspecialchars(Lang::translate('contact.badge'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h1><?= htmlspecialchars(Lang::translate('contact.title'), ENT_QUOTES, 'UTF-8') ?></h1>
                        <p>
                            <?= htmlspecialchars(Lang::translate('contact.intro'), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <div class="contact-intro-card__actions">
                            <a href="tel:+33565221152" class="contact-intro-card__phone">
                                📞 05 65 22 11 52
                            </a>

                            <a href="mailto:lescapade46@outlook.fr" class="contact-intro-card__mail">
                                ✉️ lescapade46@outlook.fr
                            </a>
                        </div>

                        <section class="contact-pets-card">
                            <div class="contact-pets-card__content">
                                <span class="contact-pets-card__badge"><?= htmlspecialchars(Lang::translate('contact.pets.badge'), ENT_QUOTES, 'UTF-8') ?></span>
                                <h2><?= htmlspecialchars(Lang::translate('contact.pets.title'), ENT_QUOTES, 'UTF-8') ?></h2>

                                <p>
                                    <?= htmlspecialchars(Lang::translate('contact.pets.p1'), ENT_QUOTES, 'UTF-8') ?>
                                </p>

                                <p>
                                    <?= htmlspecialchars(Lang::translate('contact.pets.p2'), ENT_QUOTES, 'UTF-8') ?>
                                </p>
                            </div>
                        </section>

                    </div>
                </section>

                <section class="contact-grid">
                    <article class="contact-info-card">
                        <span class="contact-info-card__label"><?= htmlspecialchars(Lang::translate('contact.address.label'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h2><?= htmlspecialchars(Lang::translate('contact.address.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                        <p>
                            227 Rue Président Wilson<br>
                            46000 Cahors
                        </p>

                        <a
                            href="https://maps.google.com/?q=227 Rue Président Wilson 46000 Cahors"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-info-card__button">
                            <?= htmlspecialchars(Lang::translate('contact.address.button'), ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </article>

                    <article class="contact-info-card">
                        <span class="contact-info-card__label"><?= htmlspecialchars(Lang::translate('contact.hours.label'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h2><?= htmlspecialchars(Lang::translate('contact.hours.title'), ENT_QUOTES, 'UTF-8') ?></h2>

                        <div class="contact-hours">
                            <div class="contact-hours__row">
                                <span><?= htmlspecialchars(Lang::translate('contact.hours.mon_thu'), ENT_QUOTES, 'UTF-8') ?></span>
                                <span>11h45 – 14h30</span>
                            </div>

                            <div class="contact-hours__row">
                                <span><?= htmlspecialchars(Lang::translate('contact.hours.friday'), ENT_QUOTES, 'UTF-8') ?></span>
                                <span>11h45 – 14h30<br>19h00 – 21h00</span>
                            </div>

                            <div class="contact-hours__row">
                                <span><?= htmlspecialchars(Lang::translate('contact.hours.saturday'), ENT_QUOTES, 'UTF-8') ?></span>
                                <span>12h00 – 14h30</span>
                            </div>

                            <div class="contact-hours__row">
                                <span><?= htmlspecialchars(Lang::translate('contact.hours.sunday'), ENT_QUOTES, 'UTF-8') ?></span>
                                <span><?= htmlspecialchars(Lang::translate('contact.hours.closed'), ENT_QUOTES, 'UTF-8') ?></span>
                            </div>
                        </div>
                    </article>
                </section>

                <section class="contact-grid">
                    <article class="contact-info-card">
                        <span class="contact-info-card__label"><?= htmlspecialchars(Lang::translate('contact.parking.label'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h2><?= htmlspecialchars(Lang::translate('contact.parking.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                        <p>
                            <?= htmlspecialchars(Lang::translate('contact.parking.p1'), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <ul class="contact-list">
                            <li><?= htmlspecialchars(Lang::translate('contact.parking.li1'), ENT_QUOTES, 'UTF-8') ?></li>
                            <li><?= htmlspecialchars(Lang::translate('contact.parking.li2'), ENT_QUOTES, 'UTF-8') ?></li>
                            <li><?= htmlspecialchars(Lang::translate('contact.parking.li3'), ENT_QUOTES, 'UTF-8') ?></li>
                        </ul>

                        <p>
                            <?= htmlspecialchars(Lang::translate('contact.parking.p2'), ENT_QUOTES, 'UTF-8') ?>
                        </p>
                    </article>

                    <article class="contact-info-card">
                        <span class="contact-info-card__label"><?= htmlspecialchars(Lang::translate('contact.groups.label'), ENT_QUOTES, 'UTF-8') ?></span>
                        <h2><?= htmlspecialchars(Lang::translate('contact.groups.title'), ENT_QUOTES, 'UTF-8') ?></h2>
                        <p>
                            <?= htmlspecialchars(Lang::translate('contact.groups.p1'), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <p>
                            <?= htmlspecialchars(Lang::translate('contact.groups.p2'), ENT_QUOTES, 'UTF-8') ?>
                        </p>

                        <a href="tel:+33565221152" class="contact-info-card__button">
                            <?= htmlspecialchars(Lang::translate('contact.groups.button'), ENT_QUOTES, 'UTF-8') ?>
                        </a>
                    </article>
                </section>

            </div>
        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>