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