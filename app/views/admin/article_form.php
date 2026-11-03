<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="panel">
  <form method="post" action="<?= url('admin/articleSave') ?>" enctype="multipart/form-data" class="form-grid">
    <input type="hidden" name="id" value="<?= $article['id'] ?? '' ?>">

    <label>Judul</label>
    <input type="text" name="title" required value="<?= e($article['title'] ?? '') ?>">

    <label>Kategori</label>
    <input type="text" name="category" required value="<?= e($article['category'] ?? '') ?>" placeholder="Ekosistem / Fauna / Aksi Hijau">

    <label>Ringkasan</label>
    <textarea name="excerpt" rows="2"><?= e($article['excerpt'] ?? '') ?></textarea>

    <label>Konten (HTML diperbolehkan)</label>
    <textarea name="content" rows="12" required><?= e($article['content'] ?? '') ?></textarea>

    <label>Gambar (upload)</label>
    <input type="file" name="image" accept="image/*">
    <?php if (!empty($article['image'])): ?>
      <img src="<?= img_src($article['image']) ?>" class="preview-img" alt="preview">
    <?php endif; ?>

    <div class="form-actions">
      <a href="<?= url('admin/articles') ?>" class="btn btn-outline">Batal</a>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>