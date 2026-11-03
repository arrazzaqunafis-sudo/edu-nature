<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="panel">
  <h3>Riwayat Hasil Kuis</h3>
  <table class="table">
    <thead><tr><th>#</th><th>Nama</th><th>Skor</th><th>Persentase</th><th>Waktu</th></tr></thead>
    <tbody>
    <?php foreach ($results as $i => $r): ?>
      <?php $pct = $r['total'] > 0 ? round($r['score'] / $r['total'] * 100) : 0; ?>
      <tr>
        <td><?= $i + 1 ?></td>
        <td><?= e($r['name']) ?></td>
        <td><strong><?= (int)$r['score'] ?>/<?= (int)$r['total'] ?></strong></td>
        <td><?= $pct ?>%</td>
        <td><?= date('d/m/Y H:i', strtotime($r['created_at'])) ?></td>
      </tr>
    <?php endforeach; ?>
    <?php if (empty($results)): ?>
      <tr><td colspan="5" class="muted">Belum ada hasil kuis.</td></tr>
    <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>