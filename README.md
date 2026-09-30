# Exam Browser (WebView + Lock Task) untuk aplikasi CI3

## 1. Build APK (pilih salah satu)
**A. Tanpa Android Studio (GitHub Actions, gratis)**
1. Buat repository baru di github.com, unggah seluruh isi folder ini (termasuk folder `.github`).
2. Buka tab Actions -> "Build APK" -> Run workflow (atau otomatis jalan setelah push).
3. Setelah selesai, unduh artifact `exambrowser-apk` -> `app-debug.apk`.

**B. Android Studio**
Buka folder ini sebagai proyek -> Build -> Build APK(s).

URL ujian sudah diset ke https://uol.smkwahapo.sch.id/ (ubah `EXAM_URL` dan `EXIT_PIN` di MainActivity.kt sebelum build; PIN bawaan 123456, sebaiknya diganti).

## 2. Pasang APK
`adb install app-debug.apk` (atau salin ke HP dan install manual).

## 3. Jadikan device owner (agar pinning TANPA peringatan)
Syarat: tidak ada akun (Google/Samsung/Xiaomi dll) di perangkat; idealnya perangkat baru/reset.
1. Aktifkan Developer options + USB debugging (Xiaomi/Oppo: aktifkan juga "USB debugging (Security settings)").
2. Pasang APK:  adb install app-debug.apk
3. Jalankan:   adb shell dpm set-device-owner com.example.exambrowser/.AdminReceiver
   Berhasil bila muncul "Success. Device owner set to package ...".
4. Buka aplikasi -> langsung terkunci tanpa dialog "Pin layar".

Jika muncul error "already several users/accounts", hapus semua akun di Pengaturan (dan user tambahan), lalu ulangi.

## 4. Keluar / melepas
- Tombol Exit -> masukkan PIN -> keluar dari kunci.
- Melepas status device owner: set RELEASE_DEVICE_OWNER_ON_EXIT = true (lepas otomatis saat keluar), atau reset pabrik.

## 5. Sisi CI3 (opsional)
Lihat CI3_contoh_cek_aplikasi.php untuk mewajibkan akses dari aplikasi ini saja.

## Catatan
- Auto rotate: screenOrientation="fullSensor" + configChanges, jadi halaman tidak reload saat diputar.
- Tanpa langkah 3, aplikasi tetap jalan memakai screen pinning biasa (ada dialog peringatan & bisa dilepas Back+Overview).
- FLAG_SECURE aktif: screenshot/rekam layar diblokir.
