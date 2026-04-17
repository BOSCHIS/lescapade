<?php
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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver - Nous contacter - L'Escapade</title>

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
        <section class="contact-page">
            <div class="contact-page__container">

                <section class="contact-intro-card">
                    <div class="contact-intro-card__content">
                        <span class="contact-intro-card__badge">Réserver votre table</span>
                        <h1>Contactez-nous directement</h1>
                        <p>
                            Pour réserver une table, obtenir un renseignement ou préparer votre venue,
                            nous vous invitons à nous appeler directement. Nous serons ravis de vous répondre.
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
                                <span class="contact-pets-card__badge">Animaux de compagnie 🐾</span>
                                <h2>Vos compagnons sont les bienvenus</h2>

                                <p>
                                    Chez L’Escapade, nous acceptons avec plaisir les animaux de compagnie.
                                    Les chiens calmes et tenus à proximité de votre table sont les bienvenus.
                                </p>

                                <p>
                                    🐾 N’hésitez pas à nous le préciser lors de votre réservation afin
                                    que nous puissions vous installer au mieux.
                                </p>
                            </div>
                        </section>

                    </div>
                </section>

                <section class="contact-grid">
                    <article class="contact-info-card">
                        <span class="contact-info-card__label">Adresse</span>
                        <h2>Nous trouver</h2>
                        <p>
                            227 Rue Président Wilson<br>
                            46000 Cahors
                        </p>

                        <a
                            href="https://maps.google.com/?q=227 Rue Président Wilson 46000 Cahors"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="contact-info-card__button">
                            📍 Voir l’itinéraire
                        </a>
                    </article>

                    <article class="contact-info-card">
                        <span class="contact-info-card__label">Horaires</span>
                        <h2>Horaires d’ouverture</h2>

                        <div class="contact-hours">
                            <div class="contact-hours__row">
                                <span>Lundi au jeudi</span>
                                <span>11h45 – 14h30</span>
                            </div>

                            <div class="contact-hours__row">
                                <span>Vendredi</span>
                                <span>11h45 – 14h30<br>19h00 – 21h00</span>
                            </div>

                            <div class="contact-hours__row">
                                <span>Samedi</span>
                                <span>12h00 – 14h30</span>
                            </div>

                            <div class="contact-hours__row">
                                <span>Dimanche</span>
                                <span>Fermé</span>
                            </div>
                        </div>
                    </article>
                </section>

                <section class="contact-grid">
                    <article class="contact-info-card">
                        <span class="contact-info-card__label">Stationnement</span>
                        <h2>Stationnement gratuit</h2>
                        <p>
                            Le stationnement est gratuit à proximité du restaurant sur certaines plages horaires.
                        </p>

                        <ul class="contact-list">
                            <li>Entre 12h30 et 14h (30 minutes gratuites)</li>
                            <li>À partir de 18h30</li>
                            <li>Toute la journée le dimanche</li>
                        </ul>

                        <p>
                            Des places sont disponibles Rue Président Wilson et dans les rues adjacentes,
                            à quelques mètres du restaurant.
                        </p>

                    </article>

                    <article class="contact-info-card">
                        <span class="contact-info-card__label">Groupes & événements</span>
                        <h2>Repas de groupe</h2>
                        <p>
                            Nous accueillons également vos repas de groupe, anniversaires,
                            repas d’entreprise et moments de convivialité.
                        </p>

                        <p>
                            Pour toute demande particulière, le plus simple est de nous contacter par téléphone.
                        </p>

                        <a href="tel:+33565221152" class="contact-info-card__button">
                            📞 Réserver maintenant
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