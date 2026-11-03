<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="page-head">
  <div class="container">
    <span class="eyebrow">Galeri</span>
    <h1>Potret Keindahan Alam</h1>
    <p>Setiap foto menyimpan cerita tentang betapa kayanya alam yang harus kita jaga.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="masonry">
      <?php foreach ($galleries as $i => $g): ?>
        <figure class="reveal" style="transition-delay:<?= ($i % 6) * 70 ?>ms">
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

<?php require __DIR__ . '/../layouts/footer.php'; ?>