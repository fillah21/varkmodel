-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Agu 2023 pada 12.07
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vark`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `idhasil` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggal_tes` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `v` double NOT NULL,
  `a` double NOT NULL,
  `r` double NOT NULL,
  `k` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`idhasil`, `iduser`, `tanggal_tes`, `v`, `a`, `r`, `k`) VALUES
(1, 2, '2023-08-03 13:43:06', 83.99, 81.87, 73.99, 73.99),
(2, 2, '2023-08-07 17:52:52', 83.99, 83.99, 73.99, 73.99),
(3, 2, '2023-08-07 17:17:42', 91.83, 70.55, 73.99, 73.99),
(4, 2, '2023-08-07 17:21:28', 68.6, 90.75, 73.99, 73.99),
(5, 2, '2023-08-07 17:25:15', 68.6, 70.55, 93.23, 73.99),
(6, 2, '2023-08-07 17:29:25', 68.6, 70.55, 73.99, 93.23),
(7, 7, '2023-08-10 04:50:10', 68.6, 49, 83.99, 93.23),
(8, 19, '2023-08-14 02:35:46', 73.99, 73.99, 68.6, 93.23),
(9, 19, '2023-08-14 02:38:57', 91.83, 70.55, 83.99, 49),
(10, 19, '2023-08-14 02:40:45', 68.6, 84.98, 73.99, 86.73),
(11, 19, '2023-08-14 02:41:31', 73.99, 67.36, 49, 96.55);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `idpertanyaan` int(11) NOT NULL,
  `idmodel` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `kode` varchar(10) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `idpertanyaan`, `idmodel`, `jawaban`, `kode`, `bobot`) VALUES
(5, 10, 12, 'Menggambar, menunjukkan atau memberikan peta', 'V1', 0.7),
(7, 10, 14, 'Menulis arah', 'R1', 0.7),
(10, 11, 13, 'Menelepon, sms atau email kepada mereka', 'A2', 0.6),
(11, 11, 14, 'Memberi mereka brosur tentang tempat itu', 'R2', 0.7),
(12, 11, 16, 'Menjelaskan secara langsung beberapa garis besar tempat yang akan mereka kunjungi', 'K2', 0.7),
(13, 10, 13, 'Menjelaskan arah secara lisan', 'A1', 0.65),
(15, 10, 16, 'Pergi dengan orang yang ingin ditolong', 'K1', 0.7),
(20, 11, 12, 'Memperlihatkan kepada mereka tempat yang indah dari tempat tujuan', 'V2', 0.62),
(22, 12, 13, 'Mendengarkan penjelasan dari penjual', 'A4', 0.7),
(23, 12, 14, 'Membaca secara detail atau mengecek lewat internet', 'R4', 0.7),
(24, 12, 16, 'Mencoba atau mengecek terlebih dahulu', 'K4', 0.7),
(25, 12, 12, 'Melihat bagus tidaknya ponsel lewat brosur', 'V4', 0.7),
(26, 14, 12, 'Melihat materi berbentuk grafik dan sejenisnya yang menarik mata', 'V99', 0.8),
(27, 14, 13, 'Mendengarkan penjelasan dari orang lain, podcast, seminar, atau semacamnya', 'A99', 0.8),
(28, 14, 14, 'Materi berbentuk tulisan seperti di buku, jurnal, dan sebagainya', 'R99', 0.8),
(29, 14, 16, 'Praktik langsung dan belajar dari kesalahan', 'K99', 0.8),
(48, 21, 12, 'Lihat video di internet bagaimana cara memasak', 'V3', 0.7),
(49, 21, 13, 'Meminta saran teman', 'A3', 0.65),
(50, 21, 14, 'Menggunakan bantuan resep', 'R3', 0.7),
(51, 21, 16, 'Memasak sesuatu yang kamu tahu tanpa resep', 'K3', 0.7),
(52, 22, 12, 'Menunjukkan diagram atau bagian-bagian mana yang salah', 'V5', 0.7),
(53, 22, 13, 'Menjelaskan dimana letak kesalahan pada dirimu', 'A5', 0.7),
(54, 22, 14, 'Memberikan sesuatu untuk kamu baca', 'R5', 0.7),
(55, 22, 16, 'Menggunakan suatu alat dan menunjukkan apa yang salah', 'K5', 0.7),
(56, 23, 12, 'Mengikuti petunjuk dari sebuah bagan', 'V6', 0.7),
(57, 23, 13, 'Berbicara dengan orang yang tahu tentang program itu', 'A6', 0.7),
(58, 23, 14, 'Membaca petunjuk mengenai cara kerja program tersebut', 'R6', 0.7),
(59, 23, 16, 'Mencoba secara langsung, dan belajar dari kesalahan', 'K6', 0.7),
(60, 24, 12, 'Dengan desain yang menarik dan bagian-bagian website tersebut', 'V7', 0.7),
(61, 24, 13, 'Dari web yang bisa mendengarkan musik, radio atau wawancara', 'A7', 0.7),
(62, 24, 14, 'Penjelasan yang sangat menarik dari daftar dan keterangan', 'R7', 0.62),
(63, 24, 16, 'Sesuatu yang gampang dibuka dan dicoba', 'K7', 0.7),
(64, 25, 12, 'Melihat diagram, bagan atau grafik mengenai materi yang ingin disampaikan', 'V8', 0.62),
(65, 25, 13, 'Melakukan tanya jawab, atau diskusi grup dari tamu', 'A8', 0.7),
(66, 25, 14, 'Kamu akan langsung membaca buku', 'R8', 0.7),
(67, 25, 16, 'Berlatih secara langsung sebelum acara dimulai', 'K8', 0.7),
(68, 26, 12, 'Melihat dari grafik hasil yang telah kamu terima', 'V9', 0.7),
(69, 26, 13, 'Dari seseorang yang ikut ujian bersama kamu', 'A9', 0.7),
(70, 26, 14, 'Melihat hasil secara langsung yang berbentuk tulisan rapih', 'R9', 0.7),
(71, 26, 16, 'Menggunakan contoh dari apa yang telah kamu lakukan', 'K9', 0.7),
(72, 27, 12, 'Membuat diagram dan grafik yang akan membantu menjelaskan sesuatu', 'V10', 0.7),
(73, 27, 13, 'Menulis poin–poin penting dan menghafal sambil menyebutkannya berulang-ulang', 'A10', 0.62),
(74, 27, 14, 'Menulis ulang dan membaca tulisan tersebut berulang-ulang', 'R10', 0.7),
(75, 27, 16, 'Mengumpulkan contoh-contoh dan cerita agar mudah presentasi', 'K10', 0.7),
(83, 31, 14, 'tes1', 'R11', 0.5),
(84, 31, 16, 'tes1', 'K11', 0.5),
(85, 31, 12, 'tes1', 'V11', 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `idkriteria` int(11) NOT NULL,
  `idmodel` int(11) NOT NULL,
  `kriteria` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`idkriteria`, `idmodel`, `kriteria`) VALUES
(1, 12, 'Menyukai instruksi yang dikemas dengan rapih menggunakan bagan, tabel, dan lain-lain'),
(2, 12, 'Sering membuat peta konsep untuk merangkum atau mengubungkan informasi yang didapat'),
(3, 12, 'Lebih cepat menangkap informasi berupa diagram, model, dan tabel'),
(4, 12, 'Saat berhubungan dengan komputer, lebih suka melihat sesuatu yang beranimasi'),
(5, 12, 'Cocok dengan kegiatan yang berhubungan dengan pembuatan video, fotografi, dan ilustrasi'),
(6, 13, 'Menyukai instruksi secara lisan'),
(7, 13, 'Sering mengulangi informasi secara lisan atau membuat rekaman suara'),
(8, 13, 'Melakukan debat, dan diskusi untuk menemukan jalan keluar dari sebuah masalah atau mendapat informasi baru'),
(9, 13, 'Membaca sebuah teks dengan nada yang berbeda'),
(10, 13, 'Sangat suka mendengarkan sebuah diskusi, seminar, podcast, dan lain-lain'),
(11, 14, 'Menyukai instruksi secara tertulis'),
(12, 14, 'Sering membuat catatan, atau memo kecil untuk mengingat informasi yang masuk'),
(13, 14, 'Suka membaca buku, jurnal, blog, dan karya ilmiah lain untuk menambah wawasan'),
(14, 14, 'Membuat catatan secara rapih ketika menerima informasi'),
(15, 16, 'Menyukai praktek secara langsung dalam menerima instruksi'),
(16, 16, 'Sering melakukan praktek untuk mengingat informasi yang langsung'),
(17, 16, 'Menjelaskan sesuatu dengan memperagakan atau mempraktekkan objek tersebut'),
(18, 16, 'Cocok dengan kegiatan yang berhubungan dengan olahraga, berperan, dan lain-lain');

-- --------------------------------------------------------

--
-- Struktur dari tabel `model`
--

CREATE TABLE `model` (
  `idmodel` int(11) NOT NULL,
  `model` varchar(20) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `model`
--

INSERT INTO `model` (`idmodel`, `model`, `kode`, `deskripsi`) VALUES
(12, 'Visual', 'V', 'Visual yaitu seseorang yang memiliki preferensi pada informasi yang berbentuk grafis, tabel, bagan, atau informasi yang memiliki visual menarik.'),
(13, 'Auditory', 'A', 'Auditory yaitu seseorang yang memiliki preferensi untuk mendengar informasi yang didapat dalam bentuk rekaman audio, percakapan langsung, ataupun bertukar pendapat.'),
(14, 'Read/Write', 'R', 'Read/Write yaitu seseorang yang memiliki preferensi pada informasi yang berbentuk tulisan seperti buku, jurnal, catatan, dan lain-lain.'),
(16, 'Kinesthetic', 'K', 'Kinesthetic yaitu seseorang yang memiliki preferensi untuk mempraktekan langsung informasi yang didapat atau melihat seseorang melakukan sesuatu untuk mendapatkan informasi.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `idpertanyaan` int(11) NOT NULL,
  `pertanyaan` text NOT NULL,
  `kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pertanyaan`
--

INSERT INTO `pertanyaan` (`idpertanyaan`, `pertanyaan`, `kode`) VALUES
(10, 'Kamu ingin menolong seseorang untuk pergi ke suatu tempat, kamu akan melakukan apa?', 'P1'),
(11, 'Kamu merencanakan liburan bersama teman-teman, kamu ingin memberitahu rencana kamu, apa yang akan kamu lakukan?', 'P2'),
(12, 'Kamu ingin membeli sebuah kamera digital atau ponsel, bagaimana cara kamu mengecek kualitas ponsel atau kamera tersebut?', 'P4'),
(14, 'Jika ingin belajar, kamu lebih suka?', 'T99'),
(21, 'Kamu ingin memasak sesuatu untuk seseorang, apa yang akan kamu lakukan ?', 'P3'),
(22, 'Kamu punya masalah dengan perasaan kamu, apa yang ingin dokter bantu untuk kamu ?', 'P5'),
(23, 'Kamu ingin belajar program, keterampilan atau game baru di komputer. Apa yang akan kamu lakukan ?', 'P6'),
(24, 'Saya menyukai website yang mempunyai ?', 'P7'),
(25, 'Kamu memilih untuk menjadi guru atau pembawa acara. Apa yang akan kamu lakukan sebagai persiapan?', 'P8'),
(26, 'Kamu telah selesai mengikuti kejuaraan atau tes dan menginginkan hasilnya. Bagaimana caramu mengetahui hasilnya ?', 'P9'),
(27, 'Kamu akan membuat pidato yang penting di sebuah konferensi atau wawancara pekerjaan. Apa yang akan kamu lakukan ?', 'P10'),
(31, 'Testing 123', 'P11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `idrekomendasi` int(11) NOT NULL,
  `idmodel` int(11) NOT NULL,
  `rekomendasi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rekomendasi`
--

INSERT INTO `rekomendasi` (`idrekomendasi`, `idmodel`, `rekomendasi`) VALUES
(1, 12, 'Membaca diagram, mindmap, dan bagan'),
(3, 12, 'Mengubah tulisan menjadi diagram, mindmap, dan bagan'),
(4, 12, 'Membuat tulisan berwarna'),
(5, 12, 'Menggunakan font bervariasi'),
(7, 12, 'Membuat catatan dengan tata letak yang bagus'),
(8, 12, 'Membuat catatan dengan desain yang menarik'),
(9, 12, 'Melihat informasi dalam bentuk animasi'),
(10, 12, 'Membuat atau melihat gambar ilustrasi'),
(11, 13, 'Melihat atau melakukan debat dan diskusi tentang sebuah topik'),
(12, 13, 'Mendengarkan podcast'),
(13, 13, 'Belajar sambil mendengarkan backsound'),
(14, 13, 'Mengikuti seminar/webinar'),
(15, 13, 'Sering bercerita atau diskusi'),
(16, 13, 'Membaca dengan nyaring'),
(17, 14, 'Sering membaca buku'),
(18, 14, 'Banyak-banyak mencatat dan merangkum informasi yang didapat'),
(19, 14, 'Mendeskripsikan grafik menjadi tulisan'),
(20, 14, 'Menggunakan judul dan list dalam membuat catatan'),
(21, 14, 'Membuat glosarium'),
(22, 14, 'Mencetak materi digital'),
(23, 16, 'Belajar dengan menggunakan contoh di kehidupan nyata'),
(24, 16, 'Melakukan demonstrasi'),
(25, 16, 'Melakukan kegiatan fisik untuk menangkap informasi'),
(26, 16, 'Mengajarkan orang lain'),
(27, 16, 'Melakukan trial and error (mencoba sampai berhasil)'),
(28, 16, 'Belajar di luar ruangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `instansi` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `pwd`, `nama`, `instansi`, `email`, `role`) VALUES
(2, 'admin', '$2y$10$VsemK5tK9Yu3QgCKu9hW9eREPzQJAIntq1AL1mSB/3NLqWKgPc0mO', 'Admininstrator', 'UMC', 'admin@example.com', 'Admin'),
(4, 'deden', '$2y$10$pMLmeCUeuNkYOfNnsCZMjOd6mZIMB3vrcTUX2k..b5ClNw6XJ4xBq', 'Deden Suhendar', 'UMC', 'dedenselalutersakiti@gmail.com', 'User'),
(5, 'alvin', '$2y$10$NmX8V8arwUTX.HuP/GHVxO95b6tdWbj2tpPTHS9S0ydRtnf24t0Ji', 'Alvin Nugraha', 'UMC', 'alvin@gmail.com', 'User'),
(6, 'eka', '$2y$10$hGG4QUoDqCxB93seFcnjAuBKEwHx89abDZL/KFz0dfZVYqk3lGBQS', 'Eka Nurseva Saniyah', 'UMC', 'ekanursevas@gmail.com', 'User'),
(7, 'fillah21', '$2y$10$fKkXe5NdGwpb2CJ5v5puDuauWLEhE0toJ9pcan94a6p1gZKWI2UXy', 'Fillah Zaki Alhaqi', 'SMAN 1 Cilimus', 'fillah.alhaqi11@gmail.com', 'Admin'),
(8, 'user', '$2y$10$UJg.36/O1zSNtmS6EjbMgOyeJgnZdJ.xtMOJAnQ2VgoMvY2kRRo2C', 'User App', 'UMC', 'user@gmail.com', 'User'),
(11, 'desy', '$2y$10$GZgOjKKh/7c7wUZEWtssPOQ2sD5.d4.KkH5IaNfathdH28uwSKCBy', 'Desy Fitriyani', 'Unjani', 'desyfitriyani@gmail.com', 'User'),
(12, 'ekauser', '$2y$10$rJ9.26WPp6x1ODd4CYOuq./vJnkzYQoisJHwrdY5.8hxMu6VEnyyi', 'Eka Nurseva', 'umc', 'ekans@gmail.com', 'User'),
(17, 'user1', '$2y$10$UyGZxTYisfXCpi0Ib8skQ.XwLhrKRTzHiVfvdf5CQ03FfOdG14usi', 'User1', 'UMC', 'user1@gmail.com', 'User'),
(19, 'user2', '$2y$10$vwhOXdZOmdCbRWdtNR/pvu2/cKIxcpnFPY8w2Az66t6yQl26NvVKy', 'User2', 'UMC', 'user2@gmail.com', 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`idhasil`),
  ADD KEY `iduser` (`iduser`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`),
  ADD KEY `idpertanyaan` (`idpertanyaan`),
  ADD KEY `idmodel` (`idmodel`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idkriteria`),
  ADD KEY `idmodel` (`idmodel`);

--
-- Indeks untuk tabel `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`idmodel`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`idpertanyaan`);

--
-- Indeks untuk tabel `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`idrekomendasi`),
  ADD KEY `idmodel` (`idmodel`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `idhasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `model`
--
ALTER TABLE `model`
  MODIFY `idmodel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `idpertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `idrekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD CONSTRAINT `hasil_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`idpertanyaan`) REFERENCES `pertanyaan` (`idpertanyaan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`idmodel`) REFERENCES `model` (`idmodel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`idmodel`) REFERENCES `model` (`idmodel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `rekomendasi_ibfk_1` FOREIGN KEY (`idmodel`) REFERENCES `model` (`idmodel`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
