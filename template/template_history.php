<?php
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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre histoire - L'Escapade</title>

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

            <section class="home-philosophy">
                <div class="container">
                    <h1>Entre transmission, territoire et convivialité...</h1>
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
            <section class="history-values">
                <div class="container">
                    <div class="history-values__grid">

                        <article class="history-values__card">
                            <span class="history-values__subtitle">Le produit avant tout</span>
                            <h2>Une cuisine guidée par la saison et le terroir</h2>
                            <p>
                                Notre cuisine commence toujours par le produit. Nous travaillons au rythme des saisons,
                                en privilégiant des ingrédients frais, simples et sincères, qui ont du goût et une histoire.
                                Ici, pas de détour inutile : nous cherchons avant tout à respecter ce que la nature nous offre.
                            </p>
                            <p>
                                Le Sud-Ouest est une terre généreuse. Entre le Lot, le Quercy et les environs,
                                nous avons la chance d’être entourés de producteurs passionnés, dont le travail mérite
                                d’être mis en valeur dans chaque assiette.
                            </p>
                        </article>

                        <article class="history-values__card">
                            <span class="history-values__subtitle">Les producteurs</span>
                            <h2>Des rencontres qui donnent du sens à notre cuisine</h2>
                            <p>
                                Nous attachons une importance particulière aux circuits courts et aux relations humaines.
                                Derrière chaque produit, il y a un visage, un savoir-faire, une exigence. C’est cette proximité
                                avec les producteurs qui nourrit notre cuisine au quotidien.
                            </p>
                            <p>
                                Éleveurs, maraîchers, artisans ou viticulteurs… nous aimons aller à leur rencontre,
                                comprendre leur travail et partager avec eux une même vision : celle d’une cuisine vraie,
                                respectueuse et profondément ancrée dans son territoire.
                            </p>
                        </article>

                        <article class="history-values__card">
                            <span class="history-values__subtitle">L’expérience</span>
                            <h2>Un moment simple, chaleureux et sincère</h2>
                            <p>
                                L’Escapade, c’est avant tout un lieu de vie. Nous souhaitons que chacun puisse s’y sentir bien,
                                comme à la maison, autour d’un bon repas. La convivialité fait partie intégrante de notre identité,
                                aussi importante que ce que l’on retrouve dans l’assiette.
                            </p>
                            <p>
                                Que ce soit pour un déjeuner rapide ou un moment plus long entre amis ou en famille,
                                nous mettons tout en œuvre pour vous offrir une expérience simple, chaleureuse et authentique,
                                fidèle à l’esprit bistrot que nous défendons.
                            </p>
                        </article>

                    </div>
                </div>
            </section>

        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>