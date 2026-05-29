<?php

use App\Utils\Csrf;
?>
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
    <title>Connexion admin - L'Escapade</title>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/main.css">
</head>

<body class="admin-auth-page">

    <main class="admin-auth">
        <div class="admin-auth__card">
            <div class="admin-auth__logo">
                <img src="/assets/images/logo/logo_orange.webp" alt="Logo L'Escapade">
            </div>

            <span class="admin-auth__subtitle">Espace administrateur</span>
            <h1 class="admin-auth__title">Connexion</h1>

            <?php if (!empty($error)) : ?>
                <div class="admin-auth__error">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form method="post" class="admin-auth__form" novalidate>
                <?= Csrf::input(); ?>

                <div class="admin-auth__field">
                    <label for="name_administrator">Identifiant</label>
                    <input
                        type="text"
                        id="name_administrator"
                        name="name_administrator"
                        autocomplete="username"
                        required>
                </div>

                <div class="admin-auth__field">
                    <label for="password_administrator">Mot de passe</label>
                    <input
                        type="password"
                        id="password_administrator"
                        name="password_administrator"
                        autocomplete="current-password"
                        required>
                </div>

                <button type="submit" class="admin-auth__button">
                    Se connecter
                </button>
            </form>
        </div>
    </main>

</body>

</html>