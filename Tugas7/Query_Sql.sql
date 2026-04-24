-- =============================================
-- Database: toko_buku
-- =============================================

CREATE DATABASE IF NOT EXISTS toko_buku CHARACTER SET utf8 COLLATE utf8_general_ci;
USE toko_buku;

-- Tabel buku
CREATE TABLE IF NOT EXISTS buku (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(255) NOT NULL,
    Penulis VARCHAR(255) NOT NULL,
    Tahun_Terbit INT,
    Harga DECIMAL(10,2),
    Stok INT
);

-- Tabel pelanggan
CREATE TABLE IF NOT EXISTS pelanggan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nama VARCHAR(255) NOT NULL,
    Alamat VARCHAR(255),
    Email VARCHAR(255),
    Telepon VARCHAR(20)
);

-- Tabel pesanan
CREATE TABLE IF NOT EXISTS pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Tanggal_Pesanan DATE,
    Pelanggan_ID INT,
    Total_Harga DECIMAL(10,2),
    FOREIGN KEY (Pelanggan_ID) REFERENCES pelanggan(ID)
);

-- Tabel detail_pesanan
CREATE TABLE IF NOT EXISTS detail_pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pesanan_ID INT,
    Buku_ID INT,
    Kuantitas INT,
    Harga_Per_Satuan DECIMAL(10,2),
    FOREIGN KEY (Pesanan_ID) REFERENCES pesanan(ID),
    FOREIGN KEY (Buku_ID) REFERENCES buku(ID)
);

-- Data contoh buku
INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, Stok) VALUES
('Pemrograman PHP Dasar', 'Budi Raharjo', 2022, 75000, 50),
('Belajar MySQL', 'Andi Sulistyo', 2021, 65000, 30),
('HTML & CSS Modern', 'Rini Kartika', 2023, 85000, 20),
('JavaScript untuk Pemula', 'Dono Santoso', 2022, 70000, 40);

-- Data contoh pelanggan
INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES
('Ahmad Fauzi', 'Jl. Mawar No. 10, Jakarta', 'ahmad@email.com', '081234567890'),
('Siti Rahayu', 'Jl. Melati No. 5, Bandung', 'siti@email.com', '082345678901'),
('Budi Santoso', 'Jl. Kenanga No. 3, Surabaya', 'budi@email.com', '083456789012');
