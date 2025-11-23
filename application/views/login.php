<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - CinéMundo</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
  <script defer src="<?= base_url('assets/js/login.js') ?>"></script>
</head>
<body>
  <main class="page-content">
    <div class="login-container">


      <form action="<?= site_url('account/login') ?>" method="POST" id="login-form">
        <h2>Connexion</h2>
      <?php if (isset($error)): ?>
        <div class="error-message">
          <?= htmlspecialchars($error->getMessage(), ENT_QUOTES, 'UTF-8') ?>
        </div>
      <?php endif; ?>
        <!-- Email field -->
        <div class="form-group">
          <label for="email">
            <span class="label-text">Adresse email</span><span class="required">*</span>
          </label>
          <div class="input-wrapper">
            <img src="<?= site_url('../assets/icones/mail.svg') ?>" class="input-icon" alt="Email">
            <input type="email" id="email" name="email" placeholder="Entrez votre adresse email" required>
          </div>
        </div>

        <!-- Password field -->
        <div class="form-group">
          <label for="password">
            <span class="label-text">Mot de passe</span><span class="required">*</span>
          </label>
          <div class="input-wrapper">
            <img src="<?= site_url('../assets/icones/lock.svg') ?>" class="input-icon" alt="Mot de passe">
            <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
          </div>
          <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
          </div>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn-submit"><strong>Se connecter</strong></button>
      </form>
    </div>
  </main>
</body>
</html>
