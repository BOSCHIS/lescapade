<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le plat du samedi - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="admin-dashboard__container">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Modifier le plat du samedi</h1>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin/saturday" class="btn btn-light">Retour à la liste</a>
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

                    <form method="POST" action="/admin/saturday/update" enctype="multipart/form-data">
                        <?= \App\Utils\Csrf::input() ?>
                        <input type="hidden" name="id_saturday" value="<?= (int) $old['id_saturday'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="date_saturday" class="form-control"
                                value="<?= htmlspecialchars($old['date_saturday'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Titre</label>
                            <input type="text" name="title_saturday" class="form-control"
                                value="<?= htmlspecialchars($old['title_saturday'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description_saturday" class="form-control" rows="5"><?= htmlspecialchars($old['description_saturday'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" step="0.01" min="0" name="price_saturday" class="form-control"
                                value="<?= htmlspecialchars((string) $old['price_saturday'], ENT_QUOTES, 'UTF-8') ?>" required>
                        </div>

                        <?php if (!empty($old['image_saturday'])) : ?>
                            <div class="mb-3">
                                <label class="form-label">Image actuelle</label><br>
                                <img src="<?= htmlspecialchars($old['image_saturday'], ENT_QUOTES, 'UTF-8') ?>"
                                    style="width: 220px; height: 140px; object-fit: cover; border-radius: 10px;">
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <label class="form-label">Nouvelle image (optionnel)</label>
                            <input type="file" name="image_saturday" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/admin/saturday" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning">Enregistrer les modifications</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>