<?php

use App\Utils\Lang;
?>

<footer class="site-footer">
    <div class="footer__logo">
        <img src="/assets/images/logo/logo_orange.webp" alt="Logo L'Escapade" />
    </div>

    <div class="footer__content">
        <div class="footer__col">
            <h3><?= htmlspecialchars(Lang::translate('footer.contact'), ENT_QUOTES, 'UTF-8') ?></h3>
            <p>05 65 22 11 52</p>
            <p>lescapade46@outlook.fr</p>
        </div>

        <div class="footer__col footer__brand">
            <h2>L'Escapade</h2>
            <p><?= htmlspecialchars(Lang::translate('footer.tagline'), ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="footer__col">
            <h3><?= htmlspecialchars(Lang::translate('footer.address'), ENT_QUOTES, 'UTF-8') ?></h3>
            <p>227 Rue Président Wilson</p>
            <p>46000 Cahors</p>
        </div>

        <div class="footer__col footer__social">
            <h3><?= htmlspecialchars(Lang::translate('footer.follow_us'), ENT_QUOTES, 'UTF-8') ?></h3>
            <a href="https://www.facebook.com/profile.php?id=61572417827056"
                target="_blank"
                rel="noopener noreferrer"
                class="social-link"
                aria-label="Facebook L'Escapade">
                <img src="/assets/images/footer/logo_facebook.webp" alt="Facebook L'Escapade" />
            </a>
        </div>
    </div>

    <div class="footer__legal">
        <a href="/mentions-legales"><?= htmlspecialchars(Lang::translate('footer.legal'), ENT_QUOTES, 'UTF-8') ?></a>
        <a href="/confidentialite"><?= htmlspecialchars(Lang::translate('footer.privacy'), ENT_QUOTES, 'UTF-8') ?></a>
    </div>

    <button id="scrollTopBtn" class="scroll-top-btn" aria-label="<?= htmlspecialchars(Lang::translate('footer.back_to_top'), ENT_QUOTES, 'UTF-8') ?>">
        ↑
    </button>
</footer>