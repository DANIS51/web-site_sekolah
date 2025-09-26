# TODO: Make School Website Responsive

## Information Gathered
- Website uses Laravel with Bootstrap 5 for responsiveness.
- Layouts have media queries for mobile/tablet.
- Public views use responsive grids and img-fluid.
- Admin/operator views need img-fluid on images and table-responsive on tables.

## Plan
- Add 'img-fluid' class to all images in views (admin/operator index, public galeri/guru/siswa).
- Wrap tables in index views with 'table-responsive' div.
- Ensure forms in create/edit are responsive (already by default).

## Steps
- [ ] Update admin/siswa/siswa.blade.php: Add img-fluid to foto img.
- [ ] Update admin/guru/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update admin/berita/index.blade.php: Ensure table-responsive.
- [ ] Update admin/galeri/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update admin/ekstrakurikulera/index.blade.php: Add table-responsive.
- [ ] Update admin/profil_sekolah/index.blade.php: Add table-responsive.
- [ ] Update admin/users/index.blade.php: Add table-responsive.
- [ ] Update operator/siswa/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update operator/guru/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update operator/berita/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update operator/galeri/index.blade.php: Add table-responsive and img-fluid.
- [ ] Update operator/ekstrakurikulera/index.blade.php: Add table-responsive.
- [ ] Update operator/profil_sekolah/index.blade.php: Add table-responsive.
- [ ] Update public/galeri.blade.php: Add img-fluid to gallery images.
- [ ] Update public/guru.blade.php: Add img-fluid to person images.
- [ ] Update public/siswa.blade.php: Add img-fluid to person images.
- [ ] Update public/ekstrakurikuler.blade.php: Add img-fluid if any.
- [ ] Update public/profil-sekolah.blade.php: Add img-fluid to logo.
- [ ] Test responsiveness using browser dev tools.

## Dependent Files
- All index.blade.php in admin/ and operator/ subdirs.
- Public content views for images.

## Followup Steps
- Run 'npm run build' to compile assets.
- Test on mobile/tablet simulators.
