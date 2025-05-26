// Validasi untuk form penyewaan (formSewa)
function validasiFormSewa() {
  var nama = document.getElementById("nama").value.trim();
  var email = document.getElementById("email_sewa").value.trim();
  var namaKegiatan = document.getElementById("nama_kegiatan").value.trim();
  var telepon = document.getElementById("telepon").value.trim();
  var item = document.getElementById("item").value.trim();
  var tanggal = document.getElementById("tanggal").value.trim();
  var durasi = document.getElementById("durasi").value.trim();
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (nama === "" || email === "" || namaKegiatan === "" || telepon === "" || item === "" || tanggal === "" || durasi === "") {
      alert("Semua field harus diisi!");
      return false;
  }

  if (isNaN(durasi) || durasi <= 0) {
      alert("Durasi harus berupa angka positif!");
      return false;
  }

  alert("Form penyewaan berhasil dikirim. Informasi selanjutnya akan dikirim ke nomor telepon yang Anda cantumkan.");
  return true;
}

// Validasi untuk form penggunaan talent (bookTalent)
function validasiFormTalent() {
  console.log("Fungsi validasiFormTalent dipanggil"); // Debugging
  var namaClient = document.getElementById("nama_client").value.trim();
  var email = document.getElementById("email_talent").value.trim();
  var namaKegiatan = document.getElementById("nama_kegiatan").value.trim();
  var jenisTalent = document.getElementById("jenis_talent").value.trim();
  var jumlahTalent = document.getElementById("jumlah_talent").value.trim();
  var tanggalAcara = document.getElementById("tanggal_acara").value.trim();
  var lokasi = document.getElementById("lokasi").value.trim();
  var durasi = document.getElementById("durasi").value.trim();
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  console.log("Nama Client:", namaClient); 
  console.log("Email:", email); 

  if (namaClient === "" || email === "" || namaKegiatan === "" || jenisTalent === "" || jumlahTalent === "" || tanggalAcara === "" || lokasi === "" || durasi === "") {
      alert("Semua field harus diisi!");
      return false;
  }

  if (isNaN(jumlahTalent) || jumlahTalent <= 0) {
      alert("Jumlah talent harus berupa angka positif!");
      return false;
  }

  if (isNaN(durasi) || durasi <= 0) {
      alert("Durasi harus berupa angka positif!");
      return false;
  }

  alert("Form penggunaan talent berhasil dikirim. Terima kasih! informasi selanjutnya akan di kirimkan melalui email anda.");
  return true;
}