<?php $active = $active ?? ''; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title ?? APP_NAME) ?> — <?= APP_NAME ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
<script>window.BASE_URL = '<?= BASEURL ?>';</script>
</head>
<body>

<header class="nav" id="nav">
  <div class="container nav-inner">
    <a href="<?= url() ?>" class="brand">
      <span class="brand-mark">🌿</span>
      <span class="brand-text">Edu<strong>Nature</strong></span>
    </a>
    <nav class="nav-links" id="navLinks">
      <a href="<?= url() ?>" class="<?= $active==='home'?'active':'' ?>">Beranda</a>
      <a href="<?= url('articles') ?>" class="<?= $active==='articles'?'active':'' ?>">Artikel</a>
      <a href="<?= url('gallery') ?>" class="<?= $active==='gallery'?'active':'' ?>">Galeri</a>
      <a href="<?= url('quiz') ?>" class="<?= $active==='quiz'?'active':'' ?>">Kuis</a>
      <?php if (is_admin()): ?>
        <a href="<?= url('admin') ?>" class="btn btn-sm btn-dark">Dashboard</a>
      <?php else: ?>
        <a href="<?= url('auth/login') ?>" class="btn btn-sm btn-outline">Masuk</a>
      <?php endif; ?>
    </nav>
    <button class="nav-toggle" id="navToggle" aria-label="Buka menu">☰</button>
  </div>
</header>

<main>