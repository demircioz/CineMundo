<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?= site_url('../assets/css/tvshow_details.css') ?>">

<div class="page-wrapper">
  <main class="tvshow-details-container">

    <div class="tvshow-header">
      <div class="tvshow-poster">
        <?php if($tvshow->getPoster()): ?>
          <img
            src="data:image/jpeg;base64,<?= base64_encode($tvshow->getPoster()->getImage()) ?>"
            alt="<?= htmlspecialchars($tvshow->getName(), ENT_QUOTES, 'UTF-8') ?>"
          >
        <?php endif; ?>

        <?php if($tvshow->getHomePage()): ?>
          <a
            href="<?= htmlspecialchars($tvshow->getHomePage(), ENT_QUOTES, 'UTF-8') ?>"
            class="btn-watch"
            target="_blank"
          >📹 Regarder</a>
        <?php endif; ?>
      </div>

      <div class="tvshow-meta">
        <h1><?= htmlspecialchars($tvshow->getName(), ENT_QUOTES, 'UTF-8') ?></h1>
        <?php if ($tvshow->getOriginalName()): ?>
          <p class="original-title"><em><?= htmlspecialchars($tvshow->getOriginalName(), ENT_QUOTES, 'UTF-8') ?></em></p>
        <?php endif; ?>
        <p class="season-count"><?= count($tvshow->getSeasons()) ?> saisons</p>
        <?php if ($tvshow->getOverview()): ?>
          <p class="overview"><?= nl2br(htmlspecialchars($tvshow->getOverview(), ENT_QUOTES, 'UTF-8')) ?></p>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!empty($seasons)): ?>
      <div class="sort-detail">
        <button type="button" class="sort-btn-detail" data-sort="rating">Trier par note ↕</button>
      </div>
      <section class="seasons-grid">
        <?php foreach ($seasons as $season): ?>
          <a href="<?= site_url('details/season/' . $season->getId()) ?>" class="season-link">
            <div class="season-card">
              <?php if ($season->getSeasonNumber() === 2147483647): ?>
                <p class="season-number">Épisodes spéciaux</p>
              <?php else: ?>
                <p class="season-number">Saison <?= htmlspecialchars($season->getSeasonNumber(), ENT_QUOTES, 'UTF-8') ?></p>
              <?php endif; ?>
              <div class="season-poster">
                <?php if ($season->getPoster()): ?>
                  <img
                    src="data:image/jpeg;base64,<?= base64_encode($season->getPoster()->getImage())?>"
                    alt="Saison <?= htmlspecialchars($season->getSeasonNumber(), ENT_QUOTES, 'UTF-8') ?>"
                  >
                <?php endif; ?>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </section>
    <?php endif; ?>

    <?php
    function renderStars(int $score): string {
      $stars = round($score / 2 * 2) / 2;
      $html  = '<div class="star-rating">';
      for ($i = 1; $i <= 5; $i++) {
        if ($stars >= $i) {
          $html .= '<svg class="star star--full" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z"/></svg>';
        } elseif ($stars >= $i - 0.5) {
          $html .= '<svg class="star star--half" viewBox="0 0 24 24"><defs><linearGradient id="halfGrad"><stop offset="50%" stop-color="#f5c518"/><stop offset="50%" stop-color="transparent"/></linearGradient></defs><path fill="url(#halfGrad)" d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z"/></svg>';
        } else {
          $html .= '<svg class="star star--empty" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z" fill="none" stroke="#ccc" stroke-width="2"/></svg>';
        }
      }
      return $html . '</div>';
    }
    ?>

    <section class="series-reviews">
      <h2>Les avis de la communauté</h2>
      <?php if (empty($ratingsData)): ?>
        <p class="no-reviews">Aucun avis pour cette série.</p>
      <?php else: ?>
        <div class="reviews-list">
          <?php foreach ($ratingsData as $ratingData): ?>
            <article class="review-card">
              <header class="review-header">
                <div class="review-meta">
                  <?= renderStars($ratingData['rating']->getScore()) ?>
                  <time datetime="<?= $ratingData['rating']->getDate() ?>">
                    <?= $ratingData['rating']->getDate() ?>
                  </time>
                </div>
                <h3 class="review-author">
                  <?= htmlspecialchars($ratingData['user']->getUsername(), ENT_QUOTES, 'UTF-8') ?>
                </h3>
              </header>
              <p class="review-comment">
                <?= nl2br(htmlspecialchars($ratingData['rating']->getComment(), ENT_QUOTES)) ?>
              </p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <section class="add-review">
      <h2>Laisser un avis</h2>
      <?php if ($user !== null): ?>
        <form action="<?= site_url('details/comment') ?>" method="POST" class="review-form">
          <input type="hidden" name="tvShowId" value="<?= $tvshow->getId() ?>">
          <label for="score">Note :</label>
          <select name="score" id="score" required>
            <?php for ($i = 10; $i >= 0; $i--): ?>
              <option value="<?= $i ?>"><?= $i ?>/10</option>
            <?php endfor; ?>
          </select>
          <label for="comment">Commentaire :</label>
          <textarea name="comment" id="comment" rows="4" placeholder="Écrivez votre avis..." required></textarea>
          <button type="submit" class="btn-submit-review">Envoyer</button>
        </form>
      <?php else: ?>
        <p class="must-login">
          <a href="<?= site_url('account/login') ?>">Connectez-vous</a> pour laisser un commentaire.
        </p>
      <?php endif; ?>
    </section>

  </main>
</div>
