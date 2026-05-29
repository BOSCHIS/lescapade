<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/assets/images/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/assets/images/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="/assets/images/favicon/site.webmanifest" />
    <title>Dashboard admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="admin-dashboard__container">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Dashboard</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <a href="/admin/logout" class="admin-dashboard__logout">Déconnexion</a>
            </div>

            <div class="admin-dashboard__grid">
                <a href="/admin/menu" class="admin-dashboard__card">
                    <span>01</span>
                    <h2>Gérer la carte</h2>
                    <p>Créer, modifier, supprimer et réordonner les plats.</p>
                </a>

                <a href="/admin/day" class="admin-dashboard__card">
                    <span>02</span>
                    <h2>Plat du jour</h2>
                    <p>Ajouter, modifier et supprimer le plat du jour avec son image.</p>
                </a>

                <a href="/admin/saturday" class="admin-dashboard__card">
                    <span>03</span>
                    <h2>Plat du samedi</h2>
                    <p>Ajouter, modifier et supprimer le plat du samedi avec son image.</p>
                </a>
            </div>
        </div>
    </main>

</body>

</html>