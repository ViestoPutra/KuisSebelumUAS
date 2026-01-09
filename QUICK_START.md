# Quick Start Guide - Sistem Manajemen Kost-Kostan

## Akses Cepat

### Dashboard
- URL: `http://localhost:8000/`
- Menampilkan statistik lengkap sistem

### Menu Utama
1. **Kamar** → `/kamar` - Kelola data kamar
2. **Penyewa** → `/penyewa` - Kelola data penyewa
3. **Kontrak** → `/kontrak-sewa` - Kelola kontrak sewa
4. **Pembayaran** → `/pembayaran` - Catat pembayaran

---

## Workflow Penggunaan Sistem

### 1. TAMBAH KAMAR
```
Dashboard → Tombol "Tambah Kamar" atau Menu Kamar → Add
```
**Form:**
- Nomor Kamar (unik): A1, B2, dll
- Tipe: Standard / Deluxe / VIP
- Harga Bulanan: Dalam Rupiah
- Fasilitas: Deskripsi fasilitas (AC, WiFi, dll)
- Status: Tersedia / Terisi (default: Tersedia)

---

### 2. TAMBAH PENYEWA
```
Dashboard → Tombol "Tambah Penyewa" atau Menu Penyewa → Add
```
**Form:**
- Nama Lengkap
- No. Telepon (aktif)
- No. KTP (unik)
- Alamat Asal
- Pekerjaan

---

### 3. BUAT KONTRAK SEWA
```
Dashboard → Tombol "Buat Kontrak" atau Menu Kontrak → Buat Kontrak Baru
```
**Form:**
- Pilih Penyewa
- Pilih Kamar (hanya yang tersedia)
- Tanggal Mulai
- Tanggal Selesai (harus lebih besar dari tanggal mulai)
- Harga Bulanan (auto-fill dari kamar)
- Status: Aktif / Selesai

**Otomatis:** Saat kontrak dibuat, status kamar berubah menjadi "terisi"

---

### 4. CATAT PEMBAYARAN
```
Dashboard → Tombol "Catat Pembayaran" atau Menu Pembayaran → Add
```
**Form:**
- Pilih Kontrak Sewa (hanya yang aktif)
- Bulan: 1-12 (Januari-Desember)
- Tahun: 2000-2099
- Jumlah Bayar
- Tanggal Bayar
- Status: Lunas / Tertunggak
- Keterangan (opsional)
- **Bukti Transfer** (opsional, JPG/PNG max 2MB)

---

## Fitur-Fitur Utama

### List Views (Index)
- ✅ Tampilkan semua data dalam tabel
- ✅ Pagination otomatis (jika banyak data)
- ✅ Aksi: Detail, Edit, Hapus
- ✅ Filter/Search (pada halaman Kamar, Penyewa, Pembayaran)

### Detail Views (Show)
- ✅ Tampilkan informasi lengkap
- ✅ Terdapat relasi data yang terkait
- ✅ Tombol Edit dan Kembali
- ✅ Untuk Penyewa: Lihat riwayat kontrak
- ✅ Untuk Kamar: Lihat riwayat penyewa
- ✅ Untuk Kontrak: Lihat riwayat pembayaran
- ✅ Untuk Pembayaran: Lihat bukti transfer

### Filter & Search
- **Kamar**: Filter by Status (Tersedia/Terisi) atau Tipe (Standard/Deluxe/VIP)
- **Penyewa**: Search by Nama atau No. Telepon
- **Pembayaran**: Filter by Status (Lunas/Tertunggak)

### Validasi
- Semua form tervalidasi server-side
- Error messages jelas ditampilkan
- Form tetap terisi dengan nilai sebelumnya saat error

---

## Batasan & Rules

### Kamar
- ❌ Tidak bisa dihapus jika sudah pernah disewa (ada kontrak)
- ✅ Status otomatis berubah saat ada kontrak baru

### Penyewa
- ❌ No. KTP harus unik (tidak boleh duplikat)
- ❌ Tidak bisa dihapus jika ada kontrak aktif
- ✅ Bisa dihapus jika semua kontrak sudah selesai

### Kontrak Sewa
- ✅ Hanya bisa dipilih kamar dengan status "tersedia"
- ✅ Tanggal selesai harus lebih besar dari tanggal mulai
- ✅ Saat dibuat, status kamar otomatis "terisi"
- ✅ Saat dihapus, kamar kembali "tersedia" (jika tidak ada kontrak aktif lain)

### Pembayaran
- ✅ Hanya bisa dipilih kontrak dengan status "aktif"
- ✅ Bulan harus 1-12, Tahun harus valid
- ✅ Bukti transfer opsional (JPG, PNG, max 2MB)
- ✅ Saat dihapus, bukti transfer otomatis terhapus

---

## Tips & Tricks

### Mengakses Detail Data
1. Klik tombol "Detail" / "Lihat" di halaman list
2. Atau klik nama item (jika diimplementasikan sebagai link)

### Mengedit Data
1. Klik tombol "Edit" di halaman list
2. Atau buka detail → Klik tombol "Edit"

### Menghapus Data
1. Klik tombol "Hapus" dan konfirmasi
2. Sistem akan cek apakah data bisa dihapus
3. Jika tidak bisa, akan tampil pesan error

### Filter Kamar
- Klik Filter di halaman Kamar
- Pilih Status atau Tipe
- Klik tombol "Filter"

### Search Penyewa
- Masukkan nama atau telepon di form search
- Klik tombol "Cari"

---

## Troubleshooting

### Error: "Kamar tidak dapat dihapus karena pernah disewa"
**Solusi:** Kamar sudah memiliki kontrak sewa. Tidak bisa dihapus untuk menjaga integritas data.

### Error: "Penyewa tidak dapat dihapus karena memiliki kontrak aktif"
**Solusi:** Penyewa masih memiliki kontrak yang aktif. Selesaikan kontrak terlebih dahulu.

### File bukti transfer tidak terupload
**Cek:**
- File harus format JPG, JPEG, atau PNG
- Ukuran file tidak boleh lebih dari 2MB
- Folder `storage/app/public/bukti_transfer` sudah ada

### Form tidak tersubmit
**Cek:**
- Semua field required sudah diisi (ditandai *)
- Format data sudah benar (tanggal, angka, dll)
- Lihat pesan error di atas form

---

## Database Structure

### Tabel KAMAR
```
id, nomor_kamar*, tipe, harga_bulanan, fasilitas, status, created_at, updated_at
```

### Tabel PENYEWA
```
id, nama_lengkap, nomor_telepon, nomor_ktp*, alamat_asal, pekerjaan, created_at, updated_at
```

### Tabel KONTRAK_SEWA
```
id, penyewa_id (FK), kamar_id (FK), tanggal_mulai, tanggal_selesai, 
harga_bulanan, status, created_at, updated_at
```

### Tabel PEMBAYARAN
```
id, kontrak_sewa_id (FK), bulan, tahun, jumlah_bayar, tanggal_bayar, 
status, keterangan, bukti_transfer, created_at, updated_at
```

---

## Keyboard Shortcuts (Opsional)

Tidak ada keyboard shortcuts built-in, tapi Anda bisa menggunakan:
- `Tab` - Pindah antar field form
- `Enter` - Submit form (di beberapa browser)
- `Esc` - Kembali (tidak built-in, tapi browser bisa navigate back)

---

## Contact & Support

Untuk pertanyaan atau error, silakan:
1. Cek dokumentasi di file `DOKUMENTASI_IMPLEMENTASI.md`
2. Lihat code controllers di `app/Http/Controllers/`
3. Lihat views di `resources/views/`

---

**Last Updated:** January 9, 2026
**Version:** 1.0.0

