<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="<?= site_url('../assets/css/season_details.css') ?>">

<div class="page-container">
    <main class="season-details-container">
        <h2>
            <a href="<?= site_url('details/tvshow/' . $tvshow->getId()) ?>">
                <?= htmlspecialchars($tvshow->getName(), ENT_QUOTES, 'UTF-8') ?>
            </a>
            —
            <?php if ($season->getSeasonNumber() === 2147483647): ?>
                Épisodes spéciaux
            <?php else: ?>
                Saison <?= htmlspecialchars($season->getSeasonNumber(), ENT_QUOTES, 'UTF-8') ?>
            <?php endif; ?>
        </h2>

        <?php foreach ($season->getEpisodes() as $episode): ?>
            <article class="episode-card">
                <h3><?= htmlspecialchars($episode->getName(), ENT_QUOTES, 'UTF-8') ?></h3>
                <details class="episode-synopsis">
                    <summary>Voir le synopsis</summary>
                    <p><?= nl2br(htmlspecialchars($episode->getOverview(), ENT_QUOTES, 'UTF-8')) ?></p>
                </details>
            </article>
        <?php endforeach; ?>

        <?php
        // helper inline pour convertir /10 → étoiles sur 5
        function renderStars(int $score): string {
            $stars = round($score / 2 * 2) / 2;
            $html  = '<div class="star-rating">';
            for ($i = 1; $i <= 5; $i++) {
                if ($stars >= $i) {
                    $html .= '<svg class="star star--full" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z"/></svg>';
                } elseif ($stars >= $i - 0.5) {
                    $html .= '<svg class="star star--half" viewBox="0 0 24 24">
                            <defs>
                              <linearGradient id="halfGrad">
                                <stop offset="50%" stop-color="#f5c518"/>
                                <stop offset="50%" stop-color="transparent"/>
                              </linearGradient>
                            </defs>
                            <path fill="url(#halfGrad)" d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z"/>
                          </svg>';
                } else {
                    $html .= '<svg class="star star--empty" viewBox="0 0 24 24">
                            <path d="M12 .587l3.668 7.568L24 9.423l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.27 0 9.423l8.332-1.268z"
                                  fill="none" stroke="#ccc" stroke-width="2"/>
                          </svg>';
                }
            }
            return $html.'</div>';
        }
        ?>

        <section class="season-reviews">
            <h2>Les avis sur cette saison</h2>

            <?php if (empty($ratingsData)): ?>
                <p class="no-reviews">Aucun avis pour cette saison.</p>
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
                                    <?= htmlspecialchars($ratingData['user']->getUsername(), ENT_QUOTES) ?>
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

            <?php if($user !== null): ?>
                <form action="<?= site_url('details/comment') ?>" method="post" class="review-form">
                    <input type="hidden" name="seasonId" value="<?= $season->getId() ?>">

                    <label for="score">Note :</label>
                    <select name="score" id="score" required>
                        <?php for($i = 10; $i >= 0; $i--): ?>
                            <option value="<?= $i ?>"><?= $i ?>/10</option>
                        <?php endfor; ?>
                    </select>

                    <label for="comment">Commentaire :</label>
                    <textarea
                            name="comment"
                            id="comment"
                            rows="4"
                            placeholder="Écrivez votre avis..."
                            required
                    ></textarea>

                    <button type="submit" class="btn-submit-review">Envoyer</button>
                </form>
            <?php else: ?>
                <p class="must-login">
                    <a href="<?= site_url('account/login') ?>">Connectez-vous</a>
                    pour laisser un commentaire.
                </p>
            <?php endif; ?>
        </section>

    </main>
</div>
