<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?= base_url('assets/css/account.css') ?>">

<div class="page-wrapper">
  <main class="profile-content">
    <div class="profile-card">
      <h1>Bonjour <?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?></h1>

      <section class="profile-details">
          <p>
              <strong>Nom d’utilisateur :</strong> <?= htmlspecialchars($user->getUsername(), ENT_QUOTES, 'UTF-8') ?>
              <img src="<?= base_url('assets/icones/modify.svg') ?>" alt="Modifier" class="edit-icon">
          </p>
          <p>
              <strong>Email :</strong> <?= htmlspecialchars($user->getEmail(), ENT_QUOTES, 'UTF-8') ?>
              <img src="<?= base_url('assets/icones/modify.svg') ?>" alt="Modifier" class="edit-icon">
          </p>
          <p>
              <strong>Date de création :</strong> <?= htmlspecialchars($user->getCreatedDate(), ENT_QUOTES, 'UTF-8') ?>
              <img src="<?= base_url('assets/icones/modify.svg') ?>" alt="Modifier" class="edit-icon">
          </p>
      </section>
    </div>
  </main>
</div>
