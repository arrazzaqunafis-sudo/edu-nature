<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="hero">
  <div class="hero-bg" style="background-image:url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1800&q=80')"></div>
  <div class="container hero-inner">
    <span class="pill">🌍 Belajar Alam, Cinta Bumi</span>
    <h1>Jelajahi, Pelajari, dan <em>Lindungi</em><br>Alam Indonesia</h1>
    <p class="hero-sub">Temukan artikel, galeri, dan kuis interaktif untuk menumbuhkan kepedulian pada lingkungan sejak dini.</p>
    <div class="hero-actions">
      <a href="<?= url('articles') ?>" class="btn btn-primary">Mulai Belajar →</a>
      <a href="<?= url('quiz') ?>" class="btn btn-ghost">Ikuti Kuis</a>
    </div>
    <div class="hero-stats">
      <div><strong><?= $stats['articles'] ?></strong><span>Artikel</span></div>
      <div><strong><?= $stats['galleries'] ?></strong><span>Foto Alam</span></div>
      <div><strong><?= $stats['questions'] ?></strong><span>Soal Kuis</span></div>
      <div><strong><?= $stats['quizzes'] ?></strong><span>Peserta</span></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <div>
        <span class="eyebrow">Artikel Terbaru</span>
        <h2>Wawasan untuk Bumi</h2>
      </div>
      <a href="<?= url('articles') ?>" class="link-arrow">Lihat semua →</a>
    </div>

    <div class="card-grid">
      <?php foreach ($featured as $i => $a): ?>
        <article class="card reveal" style="transition-delay:<?= $i * 90 ?>ms">
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
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-head reveal">
      <div>
        <span class="eyebrow">Galeri</span>
        <h2>Keindahan yang Patut Dijaga</h2>
      </div>
      <a href="<?= url('gallery') ?>" class="link-arrow">Buka galeri →</a>
    </div>

    <div class="masonry">
      <?php foreach ($galleries as $g): ?>
        <figure class="reveal">
          <img src="<?= img_src($g['image']) ?>" alt="<?= e($g['title']) ?>" loading="lazy">
          <figcaption>
            <strong><?= e($g['title']) ?></strong>
            <span><?= e($g['location']) ?></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta reveal">
      <div>
        <span class="eyebrow light">Uji Pengetahuanmu</span>
        <h2>Siap Jadi Penjelajah Alam?</h2>
        <p>Jawab <?= min(5, $stats['questions']) ?> pertanyaan seru tentang alam dan dapatkan skor terbaikmu.</p>
      </div>
      <a href="<?= url('quiz') ?>" class="btn btn-light">Mulai Kuis Sekarang →</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/../layouts/footer.php'; ?>