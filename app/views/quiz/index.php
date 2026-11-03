<?php require __DIR__ . '/../layouts/header.php'; ?>

<section class="page-head">
  <div class="container">
    <span class="eyebrow">Kuis Interaktif</span>
    <h1>Seberapa Kenal Kamu dengan Alam?</h1>
    <p>Jawab pertanyaan berikut dan lihat seberapa besar wawasanmu tentang lingkungan.</p>
  </div>
</section>

<section class="section">
  <div class="container quiz-wrap">
    <form id="quizForm" data-url="<?= url('quiz/submit') ?>">
      <div class="quiz-progress">
        <div class="quiz-bar"><span id="quizBar"></span></div>
        <span id="quizCounter">0 / <?= count($questions) ?> terjawab</span>
      </div>

      <div class="quiz-name">
        <label for="playerName">Nama kamu (opsional)</label>
        <input type="text" id="playerName" name="name" placeholder="Tulis namamu...">
      </div>

      <?php foreach ($questions as $i => $q): ?>
        <div class="quiz-q" data-id="<?= (int)$q['id'] ?>">
          <div class="quiz-q-head">
            <span class="q-num"><?= $i + 1 ?></span>
            <h3><?= e($q['question']) ?></h3>
          </div>
          <div class="quiz-options">
            <?php foreach (['a','b','c','d'] as $opt): ?>
              <label class="opt">
                <input type="radio" name="q<?= (int)$q['id'] ?>" value="<?= $opt ?>">
                <span class="opt-key"><?= strtoupper($opt) ?></span>
                <span class="opt-text"><?= e($q['option_' . $opt]) ?></span>
              </label>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>

      <button type="submit" class="btn btn-primary btn-block" id="quizSubmit">Kirim Jawaban</button>
    </form>

    <div id="quizResult" class="quiz-result" hidden></div>
  </div>
</section>

<script src="<?= asset('js/quiz.js') ?>"></script>
<?php require __DIR__ . '/../layouts/footer.php'; ?>