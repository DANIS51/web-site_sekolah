# Galeri Enhancements: Add Kategori (Foto/Video) and Tanggal

## Information Gathered:
- Galeri model has 'kategori' (enum: Foto, Video) and 'tanggal' (date) fields.
- Admin side already supports kategori, tanggal, and both foto/video files.
- Operator side is incomplete: only supports images ('gambar' field), no kategori or tanggal.
- Database migration supports kategori and tanggal.
- Public galeri.blade.php needs to display kategori and tanggal.
- Field mismatch: Operator uses 'gambar', but model uses 'file'.

## Plan:
- Update Operator GaleriController:
  - index(): Order by tanggal desc, paginate if needed.
  - store/update(): Validate and handle 'kategori', 'tanggal', 'file' (support images/videos), change from 'gambar' to 'file'.
- Update resources/views/operator/galeri/create.blade.php:
  - Add kategori select (Foto/Video).
  - Add tanggal date input.
  - Change gambar input to file, accept images/videos.
  - Update preview script for images only (videos can't preview easily).
- Update resources/views/operator/galeri/edit.blade.php:
  - Similar additions as create.
- Update resources/views/operator/galeri/index.blade.php:
  - Add Kategori and Tanggal columns in table.
  - Display kategori (Foto/Video) and formatted tanggal.
- Update resources/views/public/galeri.blade.php:
  - Display kategori and tanggal in gallery cards.
- No changes needed for admin side (already implemented).
- Ensure file storage path consistent ('galeri' instead of 'galeri_gambars').

## Dependent Files to be edited:
- app/Http/Controllers/Operator/GaleriController.php (core logic).
- resources/views/operator/galeri/create.blade.php, edit.blade.php, index.blade.php (UI).
- resources/views/public/galeri.blade.php (public display).

## Followup steps:
- Test file uploads for both foto and video in operator create/edit.
- Verify display in operator index and public galeri pages.
- Run php artisan storage:link if needed for public access.
- No new dependencies required.

## Completed Tasks:
- [x] Updated Operator GaleriController index() to order by tanggal desc.
- [x] Updated Operator GaleriController store() to handle kategori, tanggal, file (images/videos).
- [x] Updated Operator GaleriController update() to handle kategori, tanggal, file.
- [x] Updated Operator GaleriController destroy() to use 'file' field.
- [x] Updated operator galeri create.blade.php with kategori select, tanggal input, file input for images/videos.
- [x] Updated operator galeri edit.blade.php with kategori, tanggal, file fields.
- [x] Updated operator galeri index.blade.php to table format with Kategori and Tanggal columns.
- [x] Updated public galeri.blade.php to display kategori and tanggal, handle video display.
- [x] Updated PublicController galeri() to order by tanggal desc.
- [x] Fixed profil_sekolah model reference in PublicController.
- [x] Added Tanggal column to admin ekstrakurikulera index.blade.php.
- [x] Added Tanggal column to operator ekstrakurikulera index.blade.php.
- [x] Added tanggal display to public ekstrakurikuler.blade.php.
