# Toko Buku - Sistem Login Diaktifkan! 🚀

## 🎯 Setup Database (Wajib!)

**users table belum ada** → Ikuti langkah ini:

### Via HeidiSQL (Laragon):
1. Buka **HeidiSQL** (dari Laragon tray → Database)
2. Connect ke **localhost** (root, no password)
3. Pilih database `**pemrograman_web_contoh**`
4. Klik tab **Query** (di kanan atas)
5. **Copy-paste** seluruh isi `database_updated.sql`** 
6. Klik **Run** (▶️) atau F9
7. ✅ Selesai! users table + data admin ada.

**Alternatif:** phpMyAdmin (localhost/phpmyadmin) → Import atau SQL tab.

### Credentials Demo:
- Username: `**admin**`
- Password: `**password**`

## 🚀 Cara Test:
1. Pastikan Laragon running (Apache + MySQL ✅ green)
2. Buka `http://localhost/Tugas7/toko-buku/`
3. **Login** → Dashboard + CRUD aman
4. **Logout** → kembali login page
5. Coba akses langsung CRUD → redirect login

## 📁 Struktur Sistem:
```
Tugas7/toko-buku/
├── auth.php          ← Proteksi session
├── login.php         ← Halaman login
├── proses_login.php  ← Validasi + session
├── logout.php        ← Hapus session
├── index.php         ← Dashboard (dilindungi)
├── buku/ pelanggan/  ← CRUD (semua dilindungi)
│   └── pesanan/
└── database_updated.sql ← DB baru + users
```

## ⚠️ Catatan:
- JS warning di pesanan/tambah.php → abaikan (fungsi OK)
- Tambah user? INSERT manual ke `users` (password_hash di PHP)

**Sistem aman sekarang! Selamat coding! 📚**
