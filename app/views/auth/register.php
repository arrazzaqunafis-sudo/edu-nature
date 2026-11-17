<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="auth-wrap">
  <div class="auth-card">
    <span class="eyebrow">Akun Baru</span>
    <h1>Daftar</h1>
    <p class="auth-sub">Buat akun untuk mengikuti kuis dan simpan hasilmu.</p>

    <?php if (!empty($error)): ?>
      <div class="alert"><?= e($error) ?></div>
    <?php endif; ?>

    <form method="post" action="<?= url('auth/register') ?>">
      <label>Nama</label>
      <input type="text" name="name" required placeholder="Nama lengkap">

      <label>Email</label>
      <input type="email" name="email" required placeholder="you@example.com">

      <label>Password</label>
      <input type="password" name="password" required placeholder="Minimal 6 karakter">

      <button class="btn btn-primary btn-block" type="submit">Daftar</button>
    </form>

    <p class="auth-hint">Sudah punya akun? <a href="<?= url('auth/login') ?>">Masuk</a></p>
  </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
