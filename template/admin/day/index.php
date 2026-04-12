<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plat du jour - Admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-dashboard-page">

    <main class="admin-dashboard">
        <div class="container-fluid px-4 px-xl-5">
            <div class="admin-dashboard__header">
                <div>
                    <span class="admin-dashboard__subtitle">Espace administrateur</span>
                    <h1>Gestion du plat du jour</h1>
                    <p>
                        Bienvenue
                        <strong><?= htmlspecialchars($_SESSION['admin']['name_administrator'] ?? '', ENT_QUOTES, 'UTF-8') ?></strong>
                    </p>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <a href="/admin" class="btn btn-light">Retour au dashboard</a>
                    <a href="/admin/day/create" class="btn btn-warning">Ajouter un plat du jour</a>
                    <a href="/admin/logout" class="admin-dashboard__logout">Déconnexion</a>
                </div>
            </div>

            <div class="card bg-white border-0 shadow-sm">
                <div class="card-body p-4">
                    <?php if (empty($days)) : ?>
                        <div class="alert alert-info mb-0">
                            Aucun plat du jour enregistré pour le moment.
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
                                    <?php foreach ($days as $day) : ?>
                                        <tr>
                                            <td><?= (int) $day['id_day'] ?></td>

                                            <td>
                                                <?php
                                                $date = !empty($day['date_day']) ? strtotime($day['date_day']) : false;
                                                ?>
                                                <?= $date ? htmlspecialchars(date('d/m/Y', $date), ENT_QUOTES, 'UTF-8') : '—' ?>
                                            </td>

                                            <td>
                                                <?php if (!empty($day['image_day'])) : ?>
                                                    <img
                                                        src="<?= htmlspecialchars($day['image_day'], ENT_QUOTES, 'UTF-8') ?>"
                                                        alt="Image du plat du jour"
                                                        style="width: 90px; height: 60px; object-fit: cover; border-radius: 8px;">
                                                <?php else : ?>
                                                    <span class="text-muted">Aucune image</span>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <div class="fw-semibold">
                                                    <?= htmlspecialchars($day['title_day'], ENT_QUOTES, 'UTF-8') ?>
                                                </div>

                                                <?php if (!empty($day['description_day'])) : ?>
                                                    <div class="small text-muted mt-1">
                                                        <?= htmlspecialchars(mb_strimwidth($day['description_day'], 0, 110, '...'), ENT_QUOTES, 'UTF-8') ?>
                                                    </div>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <span class="text-nowrap">
                                                    <?= number_format((float) $day['price_day'], 2, ',', ' ') ?> €
                                                </span>
                                            </td>

                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2 flex-wrap">
                                                    <a href="/admin/day/edit?id=<?= (int) $day['id_day'] ?>" class="btn btn-sm btn-outline-secondary">
                                                        Modifier
                                                    </a>

                                                    <form method="POST" action="/admin/day/delete" onsubmit="return confirm('Supprimer ce plat du jour ?');" class="d-inline">
                                                        <?= \App\Utils\Csrf::input() ?>
                                                        <input type="hidden" name="id_day" value="<?= (int) $day['id_day'] ?>">
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