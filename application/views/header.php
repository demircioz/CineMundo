<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>CinéMundo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="<?= base_url('assets/img/favicon-32x32.png') ?>" type="image/png">
  <link rel="stylesheet" href="<?= base_url('assets/css/header.css') ?>">
</head>
<body>
  <header>
    <div class="header-left">
      <a href="<?= site_url() ?>">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo CinéMundo">
      </a>
    </div>
    <div class="header-right">
      <?php if ($user === null): ?>
        <a href="<?= site_url('account/create') ?>">
          <img src="<?= base_url('assets/icones/user.svg') ?>" alt="Icône utilisateur">
          S’inscrire
        </a>
        <a href="<?= site_url('account/login') ?>">
          <img src="<?= base_url('assets/icones/login.svg') ?>" alt="Icône connexion">
          Se connecter
        </a>
      <?php else: ?>
        <a href="<?= site_url('account') ?>">
          <img src="<?= base_url('assets/icones/user.svg') ?>" alt="Icône profil">
          Mon compte
        </a>
        <a href="<?= site_url('account/disconnect') ?>">
          <img src="<?= base_url('assets/icones/disconnect.svg') ?>" alt="Icône déconnexion">
          Se déconnecter
        </a>
      <?php endif; ?>
    </div>
  </header>

  <div class="page-wrapper">
    <!-- Le contenu spécifique de chaque page commence ici -->
