<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plat du samedi - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="container-fluid px-4 px-xl-5">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Gestion du plat du samedi</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin" class="btn btn-light">Retour au dashboard</a>
                    <a href="/admin/saturday/create" class="btn btn-warning">Ajouter un plat du samedi</a>
                    <a href="/admin/logout" class="admin-dashboard__logout">Déconnexion</a>
                </div>
            </div>

            <div class="card bg-white border-0 shadow-sm">
                <div class="card-body p-4">
                    <?php if (empty($saturdays)) : ?>
                        <div class="alert alert-info mb-0">
                            Aucun plat du samedi enregistré pour le moment.
                        </div>
                    <?php else : ?>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Titre</th>
                                        <th>Prix</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($saturdays as $saturday) : ?>
                                        <tr>
                                            <td><?= (int) $saturday['id_saturday'] ?></td>
                                            <td><?= htmlspecialchars(date('d/m/Y', strtotime($saturday['date_saturday'])), ENT_QUOTES, 'UTF-8') ?></td>
                                            <td>
                                                <?php if (!empty($saturday['image_saturday'])) : ?>
                                                    <img
                                                        src="<?= htmlspecialchars($saturday['image_saturday'], ENT_QUOTES, 'UTF-8') ?>"
                                                        alt="Image du plat du samedi"
                                                        style="width: 90px; height: 60px; object-fit: cover; border-radius: 8px;">
                                                <?php else : ?>
                                                    <span class="text-muted">Aucune image</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="fw-semibold">
                                                    <?= htmlspecialchars($saturday['title_saturday'], ENT_QUOTES, 'UTF-8') ?>
                                                </div>

                                                <?php if (!empty($saturday['description_saturday'])) : ?>
                                                    <div class="small text-muted mt-1">
                                                        <?= htmlspecialchars(mb_strimwidth($saturday['description_saturday'], 0, 110, '...'), ENT_QUOTES, 'UTF-8') ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="text-nowrap">
                                                    <?= number_format((float) $saturday['price_saturday'], 2, ',', ' ') ?> €
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                                    <a href="/admin/saturday/edit?id=<?= (int) $saturday['id_saturday'] ?>" class="btn btn-sm btn-outline-secondary">
                                                        Modifier
                                                    </a>

                                                    <form method="POST" action="/admin/saturday/delete" onsubmit="return confirm('Supprimer ce plat du samedi ?');" class="d-inline">
                                                        <?= \App\Utils\Csrf::input() ?>
                                                        <input type="hidden" name="id_saturday" value="<?= (int) $saturday['id_saturday'] ?>">
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