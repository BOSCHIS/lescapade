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
    <title>Ajouter un plat - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="admin-dashboard__container">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Ajouter un plat</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin/menu" class="btn btn-light">Retour à la liste</a>
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

                    <form method="POST" action="/admin/menu/store">
                        <?= \App\Utils\Csrf::input() ?>

                        <div class="mb-3">
                            <label for="title_menu" class="form-label">Titre du plat</label>
                            <input
                                type="text"
                                class="form-control"
                                id="title_menu"
                                name="title_menu"
                                value="<?= htmlspecialchars($old['title_menu'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="description_menu" class="form-label">Description</label>
                            <textarea
                                class="form-control"
                                id="description_menu"
                                name="description_menu"
                                rows="4"><?= htmlspecialchars($old['description_menu'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="extra_menu" class="form-label">Extra</label>
                            <input
                                type="text"
                                class="form-control"
                                id="extra_menu"
                                name="extra_menu"
                                value="<?= htmlspecialchars($old['extra_menu'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="mb-3">
                            <label for="price_menu" class="form-label">Prix</label>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                class="form-control"
                                id="price_menu"
                                name="price_menu"
                                value="<?= htmlspecialchars((string) ($old['price_menu'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="order_menu" class="form-label">Ordre</label>
                            <input
                                type="number"
                                class="form-control"
                                id="order_menu"
                                name="order_menu"
                                value="<?= htmlspecialchars((string) ($old['order_menu'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Choisir une catégorie</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option
                                        value="<?= (int) $category['id_category'] ?>"
                                        <?= (string) ($old['category_id'] ?? '') === (string) $category['id_category'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['name_category'], ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="/admin/menu" class="btn btn-outline-secondary">Annuler</a>
                            <button type="submit" class="btn btn-warning">Enregistrer le plat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>