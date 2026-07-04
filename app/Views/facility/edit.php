<?php
/** @var array $facility */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="container mt-4">

    <h2>Edit Fasilitas</h2>

    <hr>

    <form method="post"
          action="/facilities/update/<?= $facility['id'] ?>">

        <div class="mb-3">

            <label>Kode Fasilitas</label>

            <input type="text"
                   name="facility_code"
                   class="form-control"
                   value="<?= $facility['facility_code'] ?>">

        </div>

        <div class="mb-3">

            <label>Nama Fasilitas</label>

            <input type="text"
                   name="facility_name"
                   class="form-control"
                   value="<?= $facility['facility_name'] ?>">

        </div>

        <div class="mb-3">

            <label>Kategori</label>

            <input type="text"
                   name="category"
                   class="form-control"
                   value="<?= $facility['category'] ?>">

        </div>

        <div class="mb-3">

            <label>Harga</label>

            <input type="number"
                   name="price"
                   class="form-control"
                   value="<?= $facility['price'] ?>">

        </div>

        <div class="mb-3">

            <label>Kapasitas</label>

            <input type="number"
                   name="capacity"
                   class="form-control"
                   value="<?= $facility['capacity'] ?>">

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea name="description"
                      class="form-control"><?= $facility['description'] ?></textarea>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <input type="text"
                   name="status"
                   class="form-control"
                   value="<?= $facility['status'] ?>">

        </div>

        <button type="submit"
                class="btn btn-success">

            Update

        </button>

        <a href="/facilities"
           class="btn btn-secondary">

           Kembali

        </a>

    </form>

</div>

</div>

<?= $this->include('layout/footer') ?>