function kirimForm() {
    // Mendapatkan nilai dari input
    var nama = document.getElementById("nama").value;
    var npm = document.getElementById("npm").value;
    
    // Mendapatkan nilai radio button jenis kelamin
    var jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
    var jenisKelaminValue = jenisKelamin ? jenisKelamin.value : "";
    
    // Mendapatkan nilai checkbox hobi
    var hobi = document.querySelectorAll('input[name="hobi"]:checked');
    var hobiValues = [];
    hobi.forEach(function(item) {
        hobiValues.push(item.value);
    });
    
    // Mendapatkan nilai select kota
    var kota = document.getElementById("kota").value;
    
    // Mendapatkan nilai textarea pesan
    var pesan = document.getElementById("pesan").value;
    
    // Validasi sederhana
    if (nama === "" || npm === "" || jenisKelaminValue === "" || kota === "") {
        alert("Mohon lengkapi semua data yang wajib diisi!");
        return;
    }
    
    // Menampilkan hasil (bisa dimodifikasi sesuai kebutuhan)
    var hasil = "Data Pendaftaran:\n";
    hasil += "Nama: " + nama + "\n";
    hasil += "NPM: " + npm + "\n";
    hasil += "Jenis Kelamin: " + jenisKelaminValue + "\n";
    hasil += "Hobi: " + (hobiValues.length > 0 ? hobiValues.join(", ") : "Tidak ada") + "\n";
    hasil += "Kota: " + kota + "\n";
    hasil += "Pesan: " + (pesan ? pesan : "Tidak ada");
    
    alert(hasil);
    
    // Reset form setelah submit
    document.getElementById("formpendaftaran").reset();
}

