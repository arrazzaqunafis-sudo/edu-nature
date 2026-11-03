<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="page-head">
  <div class="container">
    <span class="eyebrow">Perpustakaan Alam</span>
    <h1>Artikel Edukasi Alam</h1>
    <p>Baca wawasan seputar ekosistem, fauna, dan aksi hijau untuk bumi yang lebih baik.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <form class="filter-bar" method="get" action="<?= url('articles') ?>">
      <input type="text" name="q" placeholder="Cari artikel..." value="<?= e($q) ?>">
      <select name="category">
        <option value="">Semua kategori</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= e($c) ?>" <?= $category === $c ? 'selected' : '' ?>><?= e($c) ?></option>
        <?php endforeach; ?>
      </select>
      <button class="btn btn-primary" type="submit">Cari</button>
    </form>

    <?php if (empty($articles)): ?>
      <p class="empty">Tidak ada artikel yang cocok dengan pencarianmu.</p>
    <?php else: ?>
      <div class="card-grid">
        <?php foreach ($articles as $i => $a): ?>
          <article class="card reveal" style="transition-delay:<?= $i * 60 ?>ms">
            <a href="<?= url('articles/show/' . $a['slug']) ?>" class="card-img">
              <img src="<?= img_src($a['image']) ?>" alt="<?= e($a['title']) ?>" loading="lazy">
              <span class="badge"><?= e($a['category']) ?></span>
            </a>
            <div class="card-body">
              <h3><a href="<?= url('articles/show/' . $a['slug']) ?>"><?= e($a['title']) ?></a></h3>
              <p><?= e(excerpt($a['excerpt'] ?: $a['content'])) ?></p>
              <div class="card-meta">
                <span><?= tgl($a['created_at']) ?></span>
                <span>👁 <?= (int)$a['views'] ?></span>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>