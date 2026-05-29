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
    <title>Gestion de la carte - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="container-fluid px-4 px-xl-5">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Gestion de la carte</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin" class="btn btn-light">Retour au dashboard</a>
                    <a href="/admin/menu/create" class="btn btn-warning">Ajouter un plat</a>
                    <a href="/admin/logout" class="admin-dashboard__logout">Déconnexion</a>
                </div>
            </div>

            <div class="card bg-white border-0 shadow-sm">
                <div class="card-body p-4">
                    <?php if (empty($menus)) : ?>
                        <div class="alert alert-info mb-0">
                            Aucun plat enregistré pour le moment.
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Titre</th>
                                        <th>Catégorie</th>
                                        <th>Prix</th>
                                        <th>Ordre</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($menus as $menu) : ?>
                                        <tr>

                                            <td data-label="Titre">
                                                <?php if (!empty($menu['title_menu'])) : ?>
                                                    <div class="fw-semibold">
                                                        <?= htmlspecialchars($menu['title_menu'], ENT_QUOTES, 'UTF-8') ?>
                                                    </div>

                                                    <?php if (!empty($menu['extra_menu'])) : ?>
                                                        <div class="small text-muted mt-1">
                                                            <?= htmlspecialchars($menu['extra_menu'], ENT_QUOTES, 'UTF-8') ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <em class="text-muted">
                                                        <?= htmlspecialchars($menu['extra_menu'] ?? 'Texte libre', ENT_QUOTES, 'UTF-8') ?>
                                                    </em>
                                                <?php endif; ?>
                                            </td>

                                            <td data-label="Catégorie">
                                                <?= htmlspecialchars($menu['name_category'], ENT_QUOTES, 'UTF-8') ?>
                                            </td>

                                            <td data-label="Prix">
                                                <?php if ($menu['price_menu'] !== null) : ?>
                                                    <span class="text-nowrap">
                                                        <?= number_format((float) $menu['price_menu'], 2, ',', ' ') ?> €
                                                    </span>
                                                <?php else : ?>
                                                    <span class="text-muted">—</span>
                                                <?php endif; ?>
                                            </td>

                                            <td data-label="Ordre">
                                                <?php if ($menu['order_menu'] !== null) : ?>
                                                    <?= (int) $menu['order_menu'] ?>
                                                <?php else : ?>
                                                    <span class="text-muted">—</span>
                                                <?php endif; ?>
                                            </td>

                                            <td data-label="Actions" class="text-end">
                                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                                    <form method="POST" action="/admin/menu/move-up" class="d-inline">
                                                        <?= \App\Utils\Csrf::input() ?>
                                                        <input type="hidden" name="id_menu" value="<?= (int) $menu['id_menu'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                                            ⬆️
                                                        </button>
                                                    </form>

                                                    <form method="POST" action="/admin/menu/move-down" class="d-inline">
                                                        <?= \App\Utils\Csrf::input() ?>
                                                        <input type="hidden" name="id_menu" value="<?= (int) $menu['id_menu'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                                            ⬇️
                                                        </button>
                                                    </form>

                                                    <a href="/admin/menu/edit?id=<?= (int) $menu['id_menu'] ?>" class="btn btn-sm btn-outline-secondary">
                                                        Modifier
                                                    </a>

                                                    <form method="POST" action="/admin/menu/delete" onsubmit="return confirm('Supprimer ce plat ?');" class="d-inline">
                                                        <?= \App\Utils\Csrf::input() ?>
                                                        <input type="hidden" name="id_menu" value="<?= (int) $menu['id_menu'] ?>">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            Supprimer
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>