<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="#" class="admin-dashboard__card">
                    <span>01</span>
                    <h2>Gérer la carte</h2>
                    <p>Créer, modifier, supprimer et réordonner les plats.</p>
                </a>

                <a href="#" class="admin-dashboard__card">
                    <span>02</span>
                    <h2>Plat du jour</h2>
                    <p>Ajouter le plat du jour avec son image et sa date.</p>
                </a>

                <a href="#" class="admin-dashboard__card">
                    <span>03</span>
                    <h2>Plat du samedi</h2>
                    <p>Gérer le plat du samedi avec son visuel dédié.</p>
                </a>
            </div>
        </div>
    </main>

</body>

</html>