# Panduan Pengujian Perubahan Warna Navbar

Berikut adalah langkah-langkah pengujian untuk memastikan perubahan warna navbar menjadi `rgba(255,255,255,0.3)` sudah diterapkan dengan benar:

## 1. Verifikasi Tampilan Navbar di Halaman Publik

-   Buka beberapa halaman yang menggunakan layout `public` pada website Anda.
-   Perhatikan bagian navbar di atas halaman.
-   Pastikan warna latar belakang navbar sudah berubah menjadi semi-transparan putih dengan kode warna `rgba(255,255,255,0.3)`.

## 2. Pengujian di Berbagai Browser

-   Buka website di browser yang berbeda seperti Google Chrome, Mozilla Firefox, Microsoft Edge, atau Safari.
-   Pastikan tampilan navbar konsisten dan warna latar belakangnya sesuai perubahan.

## 3. Pengujian di Berbagai Perangkat

-   Jika memungkinkan, buka website di perangkat berbeda seperti desktop, laptop, tablet, dan smartphone.
-   Periksa apakah warna navbar tetap konsisten di semua perangkat.

## 4. Cek Konflik CSS

-   Gunakan alat pengembang (Developer Tools) di browser (biasanya dengan klik kanan > Inspect atau tekan F12).
-   Pilih elemen navbar dan periksa properti CSS yang diterapkan.
-   Pastikan properti `background` atau `background-color` pada elemen navbar menggunakan nilai `rgba(255,255,255,0.3)` dan tidak tertimpa oleh aturan lain.
-   Jika ada aturan lain yang menimpa, catat dan laporkan untuk perbaikan lebih lanjut.

## 5. Hard Refresh dan Cache

-   Saat melakukan pengujian, lakukan hard refresh halaman (Ctrl+F5 di Windows/Linux, Cmd+Shift+R di Mac) untuk memastikan browser memuat ulang CSS terbaru.
-   Jika menggunakan cache aplikasi atau CDN, pastikan cache sudah dibersihkan.

---

Jika Anda menemukan masalah atau warna navbar belum berubah sesuai harapan, silakan catat detailnya dan laporkan agar dapat dilakukan perbaikan lebih lanjut.

---

Panduan ini dapat digunakan untuk pengujian manual oleh Anda atau tim QA.
