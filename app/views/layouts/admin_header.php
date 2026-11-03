<?php $active = $active ?? ''; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title ?? 'Admin') ?> — <?= APP_NAME ?></title>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('css/style.css') ?>">
<link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body class="admin-body">

<div class="admin-shell">
  <aside class="admin-sidebar">
    <a href="<?= url('admin') ?>" class="brand brand-footer">
      <span class="brand-mark">🌿</span>
      <span class="brand-text">Edu<strong>Nature</strong></span>
    </a>
    <nav class="admin-nav">
      <a href="<?= url('admin') ?>" class="<?= $active==='dashboard'?'active':'' ?>">📊 Dashboard</a>
      <a href="<?= url('admin/articles') ?>" class="<?= $active==='articles'?'active':'' ?>">📝 Artikel</a>
      <a href="<?= url('admin/gallery') ?>" class="<?= $active==='gallery'?'active':'' ?>">🖼 Galeri</a>
      <a href="<?= url('admin/questions') ?>" class="<?= $active==='questions'?'active':'' ?>">❓ Bank Soal</a>
      <a href="<?= url('admin/results') ?>" class="<?= $active==='results'?'active':'' ?>">🏆 Hasil Kuis</a>
    </nav>
    <div class="admin-user">
      <div class="avatar"><?= strtoupper(substr($_SESSION['user']['name'], 0, 1)) ?></div>
      <div>
        <strong><?= e($_SESSION['user']['name']) ?></strong>
        <a href="<?= url('auth/logout') ?>">Keluar</a>
      </div>
    </div>
  </aside>

  <div class="admin-main">
    <header class="admin-topbar">
      <h2><?= e($title ?? 'Dashboard') ?></h2>
      <a href="<?= url() ?>" target="_blank" class="btn btn-sm btn-outline">Lihat Situs ↗</a>
    </header>
    <div class="admin-content">