<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-wrap">
  <div class="auth-card">
    <span class="eyebrow">Panel Admin & User</span>
    <h1>Masuk</h1>
    <p class="auth-sub">Kelola artikel, galeri, dan ikuti kuis EduNature.</p>

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

    <p class="auth-hint">Admin: <code>admin@edunature.id</code> / <code>admin123</code></p>
    <p class="auth-hint">User: <code>user@edunature.id</code> / <code>user123</code></p>
    <p class="auth-hint">Belum punya akun? <a href="<?= url('auth/register') ?>">Daftar sekarang</a></p>
  </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>