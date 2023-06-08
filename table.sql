CREATE TABLE `model` (
    `idmodel` int(11) primary key auto_increment,
    `model` varchar(20) NOT NULL,
    `kode` varchar(10) NOT NULL,
    `deskripsi` text NOT NULL
);

CREATE TABLE `pertanyaan` (
    `idpertanyaan` int(11) primary key auto_increment,
    `pertanyaan` text NOT NULL,
    `kode` varchar(10) NOT NULL
);

CREATE TABLE `jawaban` (
    `idjawaban` int(11) primary key auto_increment,
    `idpertanyaan` int(11) NOT NULL,
    `jawaban` text NOT NULL,
    `kode` varchar(10) NOT NULL,
    `bobot` double NOT NULL,

    foreign key(idpertanyaan) references pertanyaan(idpertanyaan) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `rekomendasi` (
    `idrekomendasi` int(11) primary key auto_increment,
    `idmodel` int(11) NOT NULL,
    `rekomendasi` text NOT NULL,

    foreign key(idmodel) references model(idmodel) ON DELETE CASCADE ON UPDATE CASCADE
);