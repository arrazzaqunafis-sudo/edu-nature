</main>

<footer class="footer">
  <div class="container footer-grid">
    <div>
      <div class="brand brand-footer">
        <span class="brand-mark">🌿</span>
        <span class="brand-text">Edu<strong>Nature</strong></span>
      </div>
      <p class="footer-text">Platform edukasi alam untuk mengenal, mencintai, dan melindungi lingkungan sekitar kita.</p>
    </div>
    <div>
      <h4>Jelajahi</h4>
      <ul class="footer-links">
        <li><a href="<?= url('articles') ?>">Artikel</a></li>
        <li><a href="<?= url('gallery') ?>">Galeri</a></li>
        <li><a href="<?= url('quiz') ?>">Kuis</a></li>
      </ul>
    </div>
    <div>
      <h4>Kontak</h4>
      <ul class="footer-links">
        <li>hello@edunature.id</li>
        <li>+62 812 3456 7890</li>
        <li>Yogyakarta, Indonesia</li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">© <?= date('Y') ?> <?= APP_NAME ?>. Dibuat untuk edukasi alam.</div>
  </div>
</footer>

<script src="<?= asset('js/main.js') ?>"></script>
</body>
</html>