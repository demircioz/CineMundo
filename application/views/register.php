<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Create an account - CinéMundo</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/register.css') ?>">

  <script defer src="<?= base_url('assets/js/login.js') ?>"></script>
</head>
<body>

<main class="register-container">

  <form id="register-form" action="<?= site_url('account/create') ?>" method="POST">
    <h2>Créer un compte</h2>
    <div class="form-group">
      <?php if (isset($error)): ?>
        <div class="error-message">
          <?= htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>
      <label for="username">
        <span class="label-text">Nom d'utilisateur</span><span class="required">*</span>
      </label>
      <div class="input-wrapper">
        <img src="<?= base_url('assets/icones/user.svg') ?>" class="input-icon" alt="Utilisateur">
        <input type="text" id="username" name="username" placeholder="Ex. mundolegoat" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email">
        <span class="label-text">Adresse email</span><span class="required">*</span>
      </label>
      <div class="input-wrapper">
        <img src="<?= base_url('assets/icones/mail.svg') ?>" class="input-icon" alt="Email">
        <input type="email" id="email" name="email" placeholder="exemple@email.com" required>
      </div>
    </div>

    <div class="form-group">
      <label for="confirm-email">
        <span class="label-text">Confirmer l'email</span><span class="required">*</span>
      </label>
      <div class="input-wrapper">
        <img src="<?= base_url('assets/icones/mail.svg') ?>" class="input-icon" alt="Email">
        <input type="email" id="confirm-email" name="confirm-email" placeholder="Confirmez votre adresse email" required>
      </div>
    </div>

    <div class="form-group">
      <label for="password">
        <span class="label-text">Mot de passe</span><span class="required">*</span>
      </label>
      <div class="input-wrapper">
        <img src="<?= base_url('assets/icones/lock.svg') ?>" class="input-icon" alt="Mot de passe">
        <input type="password" id="password" name="password"
               placeholder="8-32 caractères, 1 majuscule, 2 chiffres, 1 spécial" required>
      </div>
    </div>

    <div class="form-group">
      <label for="confirm-password">
        <span class="label-text">Confirmer le mot de passe</span><span class="required">*</span>
      </label>
      <div class="input-wrapper">
        <img src="<?= base_url('assets/icones/lock.svg') ?>" class="input-icon" alt="Mot de passe">
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmez le mot de passe" required>
      </div>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn-submit"><strong>Créer le compte</strong></button>
  </form>
</main>

</body>
</html>
