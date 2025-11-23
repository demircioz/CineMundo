<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/footer.css') ?>">

<footer class="footer">
  <div class="footer-container">

    <!-- About -->
    <div class="footer-section">
      <h3>À propos de CinéMundo</h3>
      <p>
        CinéMundo est une plateforme passionnée dédiée à l’univers des séries.<br>
        Explorez, critiquez, partagez — entre fans, pour les fans.
      </p>
    </div>

    <!-- Socials -->
    <div class="footer-section">
      <h3>Restez Connectés</h3>
      <div class="footer-socials">
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/x.svg') ?>" alt="X" height="24">
          <span>X</span>
        </a>
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/github.svg') ?>" alt="GitHub" height="24">
          <span>GitHub</span>
        </a>
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/linkedin.svg') ?>" alt="LinkedIn" height="24">
          <span>LinkedIn</span>
        </a>
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/youtube.svg') ?>" alt="YouTube" height="24">
          <span>YouTube</span>
        </a>
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/tiktok.svg') ?>" alt="TikTok" height="24">
          <span>TikTok</span>
        </a>
        <a href="#" class="social-link">
          <img src="<?= base_url('assets/icones/instagram.svg') ?>" alt="Instagram" height="24">
          <span>Instagram</span>
        </a>
      </div>
    </div>

    <!-- Contact -->
    <div class="footer-section">
      <h3>Coordonnées</h3>
      <p style="line-height: 1.6;">
        <img src="<?= base_url('assets/icones/adress.svg') ?>" alt="Adresse" height="16">
        Route d'Hurtault, 77300 Fontainebleau<br>

        <img src="<?= base_url('assets/icones/phone.svg') ?>" alt="Téléphone" height="16">
        +33 1 23 45 67 89<br>

        <img src="<?= base_url('assets/icones/mail.svg') ?>" alt="Email" height="16">
        <a href="mailto:contact@cinemundo.com">contact@cinemundo.com</a>
      </p>
    </div>

  </div>

  <hr>

  <div class="footer-bottom">
    <p>© Copyright 2025 : CinéMundo. Tous droits réservés</p>
    <p>Projet Étudiant : Nathan BAUDRIER, Lakshman MURALITHARAN, Canpolat DEMIRCI--OZMEN</p>
    <p>
      <a href="<?= site_url('notices') ?>">Mentions légales</a>
    </p>
  </div>
</footer>

</div>
</body>
</html>
