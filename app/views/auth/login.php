<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-wrap">
  <div class="auth-card">
    <span class="eyebrow">Panel Admin</span>
    <h1>Masuk</h1>
    <p class="auth-sub">Kelola artikel, galeri, dan kuis EduNature.</p>

    <?php if (!empty($error)): ?>
      <div class="alert"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= url('auth/login') ?>">
      <label>Email</label>
      <input type="email" name="email" required placeholder="admin@edunature.id">

      <label>Password</label>
      <input type="password" name="password" required placeholder="••••••••">

      <button class="btn btn-primary btn-block" type="submit">Masuk</button>
    </form>

    <p class="auth-hint">Default: <code>admin@edunature.id</code> / <code>admin123</code></p>
  </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>