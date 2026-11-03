<?php require __DIR__ . '/../layouts/admin_header.php'; ?>

<div class="panel">
  <h3>Tambah Soal Kuis</h3>
  <form method="post" action="<?= url('admin/questionSave') ?>" class="form-grid">
    <label>Pertanyaan</label>
    <textarea name="question" rows="2" required></textarea>

    <div class="grid-2">
      <div><label>A</label><input type="text" name="option_a" required></div>
      <div><label>B</label><input type="text" name="option_b" required></div>
      <div><label>C</label><input type="text" name="option_c" required></div>
      <div><label>D</label><input type="text" name="option_d" required></div>
    </div>

    <label>Jawaban Benar</label>
    <select name="correct">
      <option value="a">A</option><option value="b">B</option>
      <option value="c">C</option><option value="d">D</option>
    </select>

    <label>Penjelasan</label>
    <textarea name="explanation" rows="2"></textarea>

    <div class="form-actions">
      <button class="btn btn-primary" type="submit">Simpan Soal</button>
    </div>
  </form>
</div>

<div class="panel">
  <h3>Daftar Soal (<?= count($questions) ?>)</h3>
  <table class="table">
    <thead><tr><th>Pertanyaan</th><th>Jawaban</th><th>Aksi</th></tr></thead>
    <tbody>
    <?php foreach ($questions as $q): ?>
      <tr>
        <td><?= e($q['question']) ?></td>
        <td><span class="tag"><?= strtoupper($q['correct']) ?></span></td>
        <td class="actions">
          <a href="<?= url('admin/questionDelete/' . $q['id']) ?>" class="btn-mini danger"
             onclick="return confirm('Hapus soal ini?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/../layouts/admin_footer.php'; ?>