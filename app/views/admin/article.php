<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="panel">
  <div class="panel-head">
    <h3>Daftar Artikel</h3>
    <a href="<?= url('admin/articleForm') ?>" class="btn btn-primary btn-sm">+ Tulis Artikel</a>
  </div>
  <table class="table">
    <thead><tr><th>Judul</th><th>Kategori</th><th>Views</th><th>Tanggal</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($articles as $a): ?>
      <tr>
        <td><?= e($a['title']) ?></td>
        <td><span class="tag"><?= e($a['category']) ?></span></td>
        <td><?= (int)$a['views'] ?></td>
        <td><?= tgl($a['created_at']) ?></td>
        <td class="actions">
          <a href="<?= url('admin/articleForm/' . $a['id']) ?>" class="btn-mini">Edit</a>
          <a href="<?= url('admin/articleDelete/' . $a['id']) ?>" class="btn-mini danger"
             onclick="return confirm('Hapus artikel ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>