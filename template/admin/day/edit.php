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
    <title>Modifier le plat du jour - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="admin-dashboard__container">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Modifier le plat du jour</h1>
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

                    <form method="POST" action="/admin/day/update" enctype="multipart/form-data">
                        <?= \App\Utils\Csrf::input() ?>
                        <input type="hidden" name="id_day" value="<?= (int) $old['id_day'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date_day" class="form-control"
                                value="<?= htmlspecialchars($old['date_day'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="title_day" class="form-control"
                                value="<?= htmlspecialchars($old['title_day'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description_day" class="form-control" rows="5"><?= htmlspecialchars($old['description_day'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" min="0" name="price_day" class="form-control"
                                value="<?= htmlspecialchars((string) $old['price_day'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <?php if (!empty($old['image_day'])) : ?>
                            <div class="mb-3">
                                <label class="form-label">Image actuelle</label><br>
                                <img src="<?= htmlspecialchars($old['image_day'], ENT_QUOTES, 'UTF-8') ?>"
                                    style="width: 220px; height: 140px; object-fit: cover; border-radius: 10px;">
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="form-label">Nouvelle image (optionnel)</label>
                            <input type="file" name="image_day" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/admin/day" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>