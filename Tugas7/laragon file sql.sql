USE pemrograman_web_contoh;

CREATE TABLE IF NOT EXISTS buku (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Judul VARCHAR(255) NOT NULL,
    Penulis VARCHAR(255) NOT NULL,
    Tahun_Terbit INT,
    Harga DECIMAL(10,2),
    Stok INT
);

CREATE TABLE IF NOT EXISTS pelanggan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Nama VARCHAR(255) NOT NULL,
    Alamat VARCHAR(255),
    Email VARCHAR(255),
    Telepon VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Tanggal_Pesanan DATE,
    Pelanggan_ID INT,
    Total_Harga DECIMAL(10,2),
    FOREIGN KEY (Pelanggan_ID) REFERENCES pelanggan(ID)
);

CREATE TABLE IF NOT EXISTS detail_pesanan (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    Pesanan_ID INT,
    Buku_ID INT,
    Kuantitas INT,
    Harga_Per_Satuan DECIMAL(10,2),
    FOREIGN KEY (Pesanan_ID) REFERENCES pesanan(ID),
    FOREIGN KEY (Buku_ID) REFERENCES buku(ID)
);

INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, Stok) VALUES
('Pemrograman PHP Dasar', 'Budi Raharjo', 2022, 75000, 50),
('Belajar MySQL', 'Andi Sulistyo', 2021, 65000, 30);

INSERT INTO pelanggan (Nama, Alamat, Email, Telepon) VALUES
('Ahmad Fauzi', 'Jl. Mawar No. 10, Jakarta', 'ahmad@email.com', '081234567890'),
('Siti Rahayu', 'Jl. Melati No. 5, Bandung', 'siti@email.com', '082345678901');