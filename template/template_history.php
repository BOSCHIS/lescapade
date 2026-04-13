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

        </section>
    </main>

    <?php include __DIR__ . '/component/footer.php'; ?>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/script/main.js"></script>
</body>

</html>