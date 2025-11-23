<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil – CinéMundo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('assets/img/favicon-32x32.png') ?>" type="image/png">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
</head>

<script>
    const baseSortUrl = '<?= site_url("home/sort") ?>';

    document.addEventListener('DOMContentLoaded', () => {
        const buttons = document.querySelectorAll('.sort-btn');
        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                const sortKey     = btn.dataset.sort;
                const currentOrder= btn.dataset.order;
                window.location.href = `${baseSortUrl}/${sortKey}/${currentOrder}`;
            });
        });
    });
</script>


<body>

<main class="main-content">

  <div class="search-container">
    <form action="<?= base_url() ?>" method="POST" class="search-form">
      <input type="text" name="prefix" placeholder="Rechercher une série ou un épisode…" class="search-input">
      <select name="genre" aria-label="Genre" class="genre-select">
        <option selected value="0">Genre</option>
        <?php foreach($genres as $genre): ?>
          <option value="<?= $genre->getId() ?>">
            <?= htmlspecialchars($genre->getName(), ENT_QUOTES, 'UTF-8') ?>
          </option>
        <?php endforeach; ?>
      </select>
      <button type="submit" class="search-btn">
        <img src="<?= base_url('assets/icones/research.svg') ?>" alt="Rechercher">
      </button>
    </form>

      <div class="sort-buttons">
          <button type="button"
                  class="sort-btn"
                  data-sort="alpha"
                  data-order="<?= isset($sort) && isset($order) && $sort === 'alpha' ? $order : 'asc'?>">
              A → Z ↕
          </button>
          <button type="button"
                  class="sort-btn"
                  data-sort="seasons"
                  data-order="<?= isset($sort) && isset($order) && $sort === 'seasons' ? $order : 'asc'?>">
              Saisons ↕
          </button>
      </div>
  </div>

  <div class="series-grid">
    <?php if (count($tvShows) === 0): ?>
      <div class="no-result">Aucune série correspondante.</div>
    <?php else: ?>
      <?php foreach ($tvShows as $tvShow): ?>
        <a href="<?= site_url('details/tvshow/' . $tvShow->getId()) ?>" class="serie-link">
          <div class="serie-card">
            <h3><?= htmlspecialchars($tvShow->getName(), ENT_QUOTES, 'UTF-8') ?></h3>
            <div class="poster-placeholder">
              <?php if ($tvShow->getPoster() !== null): ?>
                <img
                  src="data:image/jpeg;base64,<?= base64_encode($tvShow->getPoster()->getImage()) ?>"
                  alt="Poster de <?= htmlspecialchars($tvShow->getName(), ENT_QUOTES, 'UTF-8') ?>"
                >
              <?php else: ?>
                <div class="no-poster">Poster non disponible</div>
              <?php endif; ?>
            </div>
            <p class="season-count">
              <?= count($tvShow->getSeasons()) ?> saisons
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</main>
</body>
</html>
