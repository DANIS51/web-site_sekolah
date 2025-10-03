# TODO: Fix Operator Galeri Controller Methods

## Issue

-   Route calls `index` method, but controller has `galeri` method.
-   All operator galeri routes use standard CRUD method names, but controller uses custom names.

## Tasks

-   [ ] Rename `galeri` method to `index` in Operator\GaleriController.php
-   [ ] Rename `createGaleri` to `create`
-   [ ] Rename `storeGaleri` to `store`
-   [ ] Rename `editGaleri` to `edit` and change parameter from `$id` to `$galeri`
-   [ ] Rename `updateGaleri` to `update` and change parameter from `$id` to `$galeri`
-   [ ] Rename `destroyGaleri` to `destroy` and change parameter from `$id` to `$galeri`
-   [ ] Test the application to ensure it works
