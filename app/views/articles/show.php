<?php require __DIR__ . '/../layouts/header.php'; ?>

<article class="article-page">
  <div class="article-hero" style="background-image:url('<?= img_src($article['image']) ?>')">
    <div class="container article-hero-inner">
      <span class="badge badge-light"><?= e($article['category']) ?></span>
      <h1><?= e($article['title']) ?></h1>
      <div class="article-meta">
        <span><?= tgl($article['created_at']) ?></span>
        <span>•</span>
        <span>👁 <?= (int)$article['views'] ?> kali dibaca</span>
      </div>
    </div>
  </div>

  <div class="container article-body">
    <div class="prose">
      <?= $article['content'] ?>
    </div>
    <a href="<?= url('articles') ?>" class="link-arrow">← Kembali ke artikel</a>
  </div>
</article>

<?php if (!empty($related)): ?>
<section class="section section-alt">
  <div class="container">
    <div class="section-head"><div><span class="eyebrow">Baca Juga</span><h2>Artikel Terkait</h2></div></div>
    <div class="card-grid">
      <?php foreach ($related as $r): ?>
        <article class="card reveal">
          <a href="<?= url('articles/show/' . $r['slug']) ?>" class="card-img">
            <img src="<?= img_src($r['image']) ?>" alt="<?= e($r['title']) ?>" loading="lazy">
            <span class="badge"><?= e($r['category']) ?></span>
          </a>
          <div class="card-body">
            <h3><a href="<?= url('articles/show/' . $r['slug']) ?>"><?= e($r['title']) ?></a></h3>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>