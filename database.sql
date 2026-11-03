CREATE DATABASE IF NOT EXISTS edunature
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE edunature;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','user') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  category VARCHAR(50) NOT NULL,
  excerpt TEXT,
  content LONGTEXT,
  image VARCHAR(500),
  author_id INT NULL,
  views INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE galleries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  image VARCHAR(500) NOT NULL,
  location VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT NOT NULL,
  option_a VARCHAR(255) NOT NULL,
  option_b VARCHAR(255) NOT NULL,
  option_c VARCHAR(255) NOT NULL,
  option_d VARCHAR(255) NOT NULL,
  correct CHAR(1) NOT NULL,
  explanation TEXT
);

CREATE TABLE quiz_results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  score INT NOT NULL,
  total INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============ SEED DATA ============
INSERT INTO articles (title, slug, category, excerpt, content, image) VALUES
('Mengenal Ekosistem Hutan Hujan Tropis Indonesia', 'mengenal-ekosistem-hutan-hujan-tropis-indonesia', 'Ekosistem',
 'Indonesia memiliki salah satu hutan hujan tropis terbesar di dunia. Yuk kenali keanekaragaman hayati di dalamnya.',
 '<p>Hutan hujan tropis Indonesia adalah salah satu paru-paru dunia. Tersebar dari Sumatra, Kalimantan, hingga Papua, hutan ini menjadi rumah bagi ribuan spesies endemik.</p><h3>Mengapa Penting?</h3><p>Hutan hujan berperan sebagai penyerap karbon, pengatur siklus air, dan sumber keanekaragaman hayati. Satu hektar hutan dapat menyimpan ratusan ton karbon yang membantu menekan pemanasan global.</p><h3>Ancaman</h3><p>Deforestasi, kebakaran hutan, dan alih fungsi lahan menjadi ancaman utama. Kita bisa ikut menjaga dengan tidak membeli produk kayu ilegal dan mendukung konservasi.</p>',
 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1200&q=80'),
('7 Cara Sederhana Menjaga Kelestarian Alam di Rumah', '7-cara-sederhana-menjaga-kelestarian-alam-di-rumah', 'Aksi Hijau',
 'Menjaga alam tidak harus dimulai dari hal besar. Langkah kecil di rumah pun bisa berdampak nyata.',
 '<p>Perubahan besar dimulai dari kebiasaan kecil. Berikut tujuh langkah yang bisa kamu mulai hari ini.</p><ol><li>Pisahkan sampah organik dan anorganik.</li><li>Hemat air saat mandi dan mencuci.</li><li>Matikan lampu yang tidak dipakai.</li><li>Gunakan tas belanja kain.</li><li>Tanam tanaman di pot atau pekarangan.</li><li>Kurangi penggunaan plastik sekali pakai.</li><li>Daur ulang barang bekas menjadi kerajinan.</li></ol>',
 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e?w=1200&q=80'),
('Mengapa Lebah Sangat Penting bagi Kehidupan?', 'mengapa-lebah-sangat-penting-bagi-kehidupan', 'Fauna',
 'Tanpa lebah, sebagian besar buah dan sayur yang kita makan akan hilang. Simak perannya yang luar biasa.',
 '<p>Lebah adalah penyerbuk utama di dunia. Sekitar 70% tanaman pangan bergantung pada penyerbukan hewan, dan lebah memainkan peran terbesar.</p><h3>Ancaman bagi Lebah</h3><p>Penggunaan pestisida berlebihan, hilangnya habitat, dan perubahan iklim membuat populasi lebah menurun drastis. Menanam bunga lokal di sekitar rumah adalah cara mudah membantu mereka.</p>',
 'https://images.unsplash.com/photo-1476231682828-37e571bc172f?w=1200&q=80'),
('Siklus Air: Perjalanan Setetes Air yang Menopang Kehidupan', 'siklus-air-perjalanan-setetes-air', 'Ekosistem',
 'Air terus bergerak dalam siklus abadi. Memahami siklus ini membantu kita menghargai setiap tetesnya.',
 '<p>Siklus air terdiri dari evaporasi, kondensasi, presipitasi, dan infiltrasi. Matahari menguapkan air dari laut dan daratan, uap itu naik dan mengembun menjadi awan, lalu turun sebagai hujan.</p><p>Hutan berperan penting menjaga siklus ini. Ketika hutan rusak, siklus air terganggu dan menyebabkan banjir maupun kekeringan.</p>',
 'https://images.unsplash.com/photo-1433086966358-54859d0ed716?w=1200&q=80'),
('Mangrove: Benteng Alami yang Menjaga Pesisir', 'mangrove-benteng-alami-pesisir', 'Ekosistem',
 'Hutan mangrove melindungi pantai dari abrasi dan menjadi rumah bagi biota laut.',
 '<p>Mangrove tumbuh di daerah pasang surut air laut. Akar-akarnya yang kuat mampu menahan gelombang dan mencegah abrasi pantai.</p><p>Selain itu, mangrove menyimpan karbon dalam jumlah besar — bahkan lebih banyak daripada hutan daratan. Ekosistem ini juga menjadi tempat berkembang biak ikan, udang, dan kepiting.</p>',
 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1200&q=80'),
('Fenomena Migrasi Burung: Navigasi Alam yang Menakjubkan', 'fenomena-migrasi-burung', 'Fauna',
 'Setiap tahun jutaan burung terbang ribuan kilometer. Bagaimana mereka menemukan arah?',
 '<p>Burung migran memanfaatkan medan magnet bumi, posisi matahari dan bintang, serta lanskap untuk bernavigasi. Perjalanan mereka bisa mencapai 20.000 km pulang-pergi.</p><p>Perubahan iklim dan hilangnya titik singgah (stopover site) menjadi tantangan besar bagi kelangsungan migrasi mereka.</p>',
 'https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?w=1200&q=80');

INSERT INTO galleries (title, description, image, location) VALUES
('Kabut Pagi di Hutan Pinus', 'Cahaya lembut menembus kabut di antara pepohonan pinus.', 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?w=1200&q=80', 'Lembang, Jawa Barat'),
('Danau Tersembunyi', 'Air yang tenang memantulkan langit biru dengan sempurna.', 'https://images.unsplash.com/photo-1426604966848-d7adac402bff?w=1200&q=80', 'Kalimantan'),
('Air Terjun di Tengah Rimba', 'Aliran air jernih di antara bebatuan dan lumut hijau.', 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?w=1200&q=80', 'Bali'),
('Padang Rumput Hijau', 'Hamparan hijau dengan langit biru yang luas.', 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&q=80', 'Nusa Tenggara'),
('Matahari Menembus Kanopi', 'Berkas cahaya emas di antara daun-daun hutan.', 'https://images.unsplash.com/photo-1518495973542-4542c06a5843?w=1200&q=80', 'Papua'),
('Bunga Musim Semi', 'Aneka warna mekar di musim semi.', 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1200&q=80', 'Dieng');

INSERT INTO questions (question, option_a, option_b, option_c, option_d, correct, explanation) VALUES
('Proses tumbuhan membuat makanan sendiri dengan bantuan cahaya matahari disebut...', 'Respirasi', 'Fotosintesis', 'Transpirasi', 'Fermentasi', 'b', 'Fotosintesis mengubah CO₂ dan air menjadi glukosa dengan bantuan cahaya matahari dan klorofil.'),
('Hewan yang berperan paling besar dalam proses penyerbukan bunga adalah...', 'Semut', 'Lebah', 'Nyamuk', 'Cicak', 'b', 'Lebah membantu penyerbukan sekitar 70% tanaman pangan dunia.'),
('Berapa persen permukaan Bumi yang tertutup air?', '30%', '50%', '71%', '90%', 'c', 'Sekitar 71% permukaan Bumi tertutup air, meski hanya 2,5% yang berupa air tawar.'),
('Gas yang diserap tumbuhan dari udara untuk fotosintesis adalah...', 'Oksigen', 'Nitrogen', 'Karbon dioksida', 'Hidrogen', 'c', 'Tumbuhan menyerap CO₂ dan melepaskan O₂ — kebalikan dari pernapasan manusia.'),
('Hutan yang tumbuh di daerah pasang surut air laut disebut...', 'Hutan bakau', 'Hutan lindung', 'Hutan hujan', 'Hutan pinus', 'a', 'Mangrove atau hutan bakau tumbuh di zona pasang surut dan melindungi pantai dari abrasi.'),
('Prinsip 3R dalam pengelolaan sampah adalah...', 'Reduce, Reuse, Recycle', 'Remove, Rebuild, Recycle', 'Reduce, Remove, Recycle', 'Reuse, Rebuild, Remove', 'a', '3R: kurangi (reduce), gunakan kembali (reuse), dan daur ulang (recycle).'),
('Organisme yang bertugas menguraikan sisa makhluk hidup disebut...', 'Produsen', 'Konsumen', 'Dekomposer', 'Predator', 'c', 'Dekomposer seperti bakteri dan jamur menguraikan bahan organik menjadi zat hara tanah.'),
('Alat pernapasan pada ikan adalah...', 'Paru-paru', 'Insang', 'Trakea', 'Kulit', 'b', 'Insang memungkinkan ikan menyerap oksigen terlarut dalam air.'),
('Lapisan atmosfer yang melindungi Bumi dari radiasi ultraviolet berlebih adalah...', 'Troposfer', 'Stratosfer', 'Lapisan ozon', 'Ionosfer', 'c', 'Lapisan ozon menyerap sebagian besar radiasi UV-B yang berbahaya.'),
('Hewan yang berkembang biak dengan cara bertelur disebut...', 'Vivipar', 'Ovipar', 'Ovovivipar', 'Mamalia', 'b', 'Ovipar adalah cara berkembang biak dengan bertelur, seperti pada burung dan reptil.');