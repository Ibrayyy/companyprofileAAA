
<title>FAQ - Alfa Artha Andhaya</title>
<!-- Link ke file CSS eksternal -->
<link rel="stylesheet" href="../style.css">

<!-- Tombol Kembali -->
<div class="back-button">
  <button onclick="goBack()">← Back</button>
</div>

<script>
  function goBack() {
  window.history.back(); // Kembali ke halaman sebelumnya
}
</script>

<!-- Input Pencarian FAQ -->
<div class="search-bar">
  <input type="text" id="search-input" placeholder="Cari di FAQ...">
  <button onclick="searchFAQ()">Search</button>
</div>

<!-- Pesan Jika Tidak Ditemukan -->
<div id="no-results" class="no-results" style="display: none;">
  Tidak ada hasil yang cocok.
</div>

<!-- Section FAQ -->
<div class="faq-section">
  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer1')">
      Apa itu PT. Alfa Artha Andhaya (AAA)?
    </div>
    <div class="faq-answer" id="answer1">
      PT. Alfa Artha Andhaya adalah perusahaan distribusi multinasional yang berfokus pada penjualan 
      perlengkapan IT, seperti motherboard, VGA card, dan produk dari berbagai merek ternama seperti MSI, 
      darkFlash, AIGO, Transcend, Acer, dan Predator.
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer2')">
      Sejak kapan PT. Alfa Artha Andhaya berdiri?
    </div>
    <div class="faq-answer" id="answer2">
      Perusahaan ini berdiri sejak Juni 2003 dan terus berkembang dengan cabang-cabang di beberapa 
      kota besar di Indonesia.
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer3')">
      Dimana lokasi pusat PT Alfa Artha Andhaya dan juga cabang-cabangnya?
    </div>
    <div class="faq-answer" id="answer3">
      Kantor pusat kami berlokasi di Ruko Harco Mangga Dua, Jakarta, dengan cabang di kota-kota seperti Bandung, 
      Yogyakarta, dan Surabaya.
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer4')">
      Apakah PT. Alfa Artha Andhaya melayani penjualan langsung ke konsumen?
    </div>
    <div class="faq-answer" id="answer4">
      Tidak, PT. Alfa Artha Andhaya fokus pada model bisnis B2B (Business to Business), yang artinya kami menjual 
      produk kepada toko retail, bukan langsung ke konsumen akhir.
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer5')">
      Apa saja produk yang didistribusikan oleh PT. Alfa Artha Andhaya?
    </div>
    <div class="faq-answer" id="answer5">
      Kami mendistribusikan berbagai produk IT seperti motherboard, VGA card, dan perangkat komputer lainnya dari 
      merek-merek ternama seperti MSI, darkFlash, AIGO, Transcend, Acer, dan Predator.
    </div>
  </div>

  <div class="faq-item">
    <div class="faq-question" onclick="toggleAnswer('answer6')">
      Bagaimana cara menjadi mitra bisnis PT. Alfa Artha Andhaya?
    </div>
    <div class="faq-answer" id="answer6">
      Untuk menjadi mitra bisnis, Anda dapat menghubungi kami melalui halaman kontak di website atau mengunjungi kantor 
      pusat atau cabang terdekat kami.
    </div>
  </div>
</div>

<!-- JavaScript untuk Animasi dan Pencarian -->
<script>
  function toggleAnswer(id) {
    const answer = document.getElementById(id);
    answer.classList.toggle('active');
  }

  function searchFAQ() {
    const query = document.getElementById("search-input").value.toLowerCase();
    const faqItems = document.querySelectorAll(".faq-item");
    let found = false;

    faqItems.forEach(item => {
      const questionText = item.querySelector(".faq-question").textContent.toLowerCase();
      const answerText = item.querySelector(".faq-answer").textContent.toLowerCase();

      if (questionText.includes(query) || answerText.includes(query)) {
        item.style.display = "block";
        found = true;
      } else {
        item.style.display = "none";
      }
    });

    document.getElementById("no-results").style.display = found ? "none" : "block";
  }
</script>

<?php include '../includes/footer.php'; ?>