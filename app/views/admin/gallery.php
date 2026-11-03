<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="panel">
  <h3>Tambah Foto Galeri</h3>
  <form method="post" action="<?= url('admin/gallerySave') ?>" enctype="multipart/form-data" class="form-grid">
    <label>Judul</label>
    <input type="text" name="title" required>

    <label>Lokasi</label>
    <input type="text" name="location" placeholder="Contoh: Bromo, Jawa Timur">

    <label>Deskripsi</label>
    <textarea name="description" rows="2"></textarea>

    <label>Upload Foto</label>
    <input type="file" name="image" accept="image/*">

    <label>atau URL Foto</label>
    <input type="url" name="image_url" placeholder="https://...">

    <div class="form-actions">
      <button class="btn btn-primary" type="submit">Tambah Foto</button>
    </div>
  </form>
</div>

<div class="panel">
  <h3>Daftar Galeri</h3>
  <div class="gallery-admin">
    <?php foreach ($galleries as $g): ?>
      <div class="gallery-admin-item">
        <img src="<?= img_src($g['image']) ?>" alt="<?= e($g['title']) ?>">
        <div>
          <strong><?= e($g['title']) ?></strong>
          <span class="muted"><?= e($g['location']) ?></span>
        </div>
        <a href="<?= url('admin/galleryDelete/' . $g['id']) ?>" class="btn-mini danger"
           onclick="return confirm('Hapus foto ini?')">Hapus</a>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>