<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="stat-grid">
  <div class="stat-card"><span>Artikel</span><strong><?= $articles ?></strong></div>
  <div class="stat-card"><span>Foto Galeri</span><strong><?= $galleries ?></strong></div>
  <div class="stat-card"><span>Soal Kuis</span><strong><?= $questions ?></strong></div>
  <div class="stat-card"><span>Peserta Kuis</span><strong><?= $quizzes ?></strong></div>
</div>

<div class="admin-cols">
  <div class="panel">
    <h3>Artikel Terbaru</h3>
    <table class="table">
      <thead><tr><th>Judul</th><th>Kategori</th><th>Tanggal</th></tr></thead>
      <tbody>
      <?php foreach ($latest as $a): ?>
        <tr>
          <td><?= e($a['title']) ?></td>
          <td><span class="tag"><?= e($a['category']) ?></span></td>
          <td><?= tgl($a['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <div class="panel">
    <h3>Skor Tertinggi</h3>
    <table class="table">
      <thead><tr><th>Nama</th><th>Skor</th></tr></thead>
      <tbody>
      <?php foreach ($top as $t): ?>
        <tr>
          <td><?= e($t['name']) ?></td>
          <td><strong><?= (int)$t['score'] ?>/<?= (int)$t['total'] ?></strong></td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($top)): ?>
        <tr><td colspan="2" class="muted">Belum ada peserta kuis.</td></tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>