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
    <title>Ajouter un plat du jour - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="admin-dashboard__container">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Ajouter un plat du jour</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin/day" class="btn btn-light">Retour à la liste</a>
                    <a href="/admin/logout" class="admin-dashboard__logout">Déconnexion</a>
                </div>
            </div>

            <div class="card bg-white border-0 shadow-sm">
                <div class="card-body p-4">
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="/admin/day/store" enctype="multipart/form-data">
                        <?= \App\Utils\Csrf::input() ?>

                        <div class="mb-3">
                            <label for="date_day" class="form-label">Date</label>
                            <input
                                type="date"
                                class="form-control"
                                id="date_day"
                                name="date_day"
                                value="<?= htmlspecialchars($old['date_day'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="title_day" class="form-label">Titre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title_day"
                                name="title_day"
                                value="<?= htmlspecialchars($old['title_day'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="description_day" class="form-label">Description</label>
                            <textarea
                                class="form-control"
                                id="description_day"
                                name="description_day"
                                rows="5"><?= htmlspecialchars($old['description_day'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price_day" class="form-label">Prix</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control"
                                id="price_day"
                                name="price_day"
                                value="<?= htmlspecialchars((string) ($old['price_day'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="image_day" class="form-label">Image</label>
                            <input
                                type="file"
                                class="form-control"
                                id="image_day"
                                name="image_day"
                                accept=".jpg,.jpeg,.png,.webp">
                            <div class="form-text">
                                Formats autorisés : JPG, PNG, WEBP.
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/admin/day" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning">Enregistrer le plat du jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>