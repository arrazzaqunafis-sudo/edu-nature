document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("quizForm");
  if (!form) return;

  const bar = document.getElementById("quizBar");
  const counter = document.getElementById("quizCounter");
  const result = document.getElementById("quizResult");
  const submit = document.getElementById("quizSubmit");
  const questions = [...form.querySelectorAll(".quiz-q")];
  const totalQ = questions.length;

  /* ---- Progress ---- */
  const updateProgress = () => {
    let answered = 0;
    questions.forEach((q) => {
      if (q.querySelector("input[type=radio]:checked")) answered++;
    });
    bar.style.width = (answered / totalQ) * 100 + "%";
    counter.textContent = `${answered} / ${totalQ} terjawab`;
  };
  form.addEventListener("change", updateProgress);
  updateProgress();

  /* ---- Submit ---- */
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const answers = {};
    let unanswered = 0;
    questions.forEach((q) => {
      const id = q.dataset.id;
      const picked = q.querySelector("input[type=radio]:checked");
      if (picked) answers[id] = picked.value;
      else unanswered++;
    });

    if (
      unanswered > 0 &&
      !confirm(`Masih ada ${unanswered} soal belum dijawab. Tetap kirim?`)
    )
      return;

    submit.disabled = true;
    submit.textContent = "Memproses...";

    try {
      const res = await fetch(form.dataset.url, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          name: document.getElementById("playerName").value,
          answers,
        }),
      });
      const data = await res.json();
      renderResult(data);
    } catch (err) {
      alert("Terjadi kesalahan saat mengirim jawaban.");
      submit.disabled = false;
      submit.textContent = "Kirim Jawaban";
    }
  });

  function renderResult(data) {
    const pct = data.total ? Math.round((data.score / data.total) * 100) : 0;
    const grade =
      pct >= 90
        ? "Luar biasa! Kamu penjelajah alam sejati 🌟"
        : pct >= 70
          ? "Bagus! Wawasan alammu sudah di atas rata-rata 🌿"
          : pct >= 50
            ? "Cukup baik — terus belajar ya! 🌱"
            : "Jangan menyerah, baca artikel dan coba lagi 🌾";

    let html = `
      <div class="result-card">
        <div class="score-circle" style="--pct:${pct}%">
          <strong>${data.score}/${data.total}</strong>
        </div>
        <h2>Skor Kamu ${pct}%</h2>
        <p>${grade}</p>
        <button class="btn btn-outline" onclick="location.reload()">Ulangi Kuis</button>
      </div>
      <h3 style="margin:2rem 0 1rem">Pembahasan</h3>
    `;

    data.detail.forEach((d, i) => {
      html += `
        <div class="detail-item ${d.is_correct ? "" : "wrong"}">
          <p><strong>${i + 1}. ${escapeHtml(d.question)}</strong></p>
          <p>Jawabanmu: <strong>${d.your}</strong> ${d.is_correct ? "✅" : `❌ (benar: ${d.correct})`}</p>
          ${d.explanation ? `<p class="exp">💡 ${escapeHtml(d.explanation)}</p>` : ""}
        </div>
      `;
    });

    result.innerHTML = html;
    result.hidden = false;
    form.style.display = "none";
    result.scrollIntoView({ behavior: "smooth", block: "start" });
  }

  function escapeHtml(str) {
    const d = document.createElement("div");
    d.textContent = str;
    return d.innerHTML;
  }
});
