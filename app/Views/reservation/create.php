<?php
/** @var int $facility_id */
/** @var int $price */
/** @var string $category */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<div class="container mt-4">

    <h2>Buat Reservasi</h2>

    <hr>

<!-- ERROR JIKA JADWAL BENTROK -->
    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= session()->getFlashdata('error') ?>

        </div>

    <?php endif; ?>

    <form method="post"
          action="/reservations/store">

<!-- FACILITY -->
        <div class="mb-3">

            <label>ID Fasilitas</label>

            <input type="number"
                   name="facility_id"
                   class="form-control"
                   value="<?= $facility_id ?>"
                   readonly>

            <input type="hidden"
       id="price"
       value="<?= $price ?>">

<input type="hidden"
       id="category"
       value="<?= $category ?>">

        </div>

<!-- TUJUAN -->
        <div class="mb-3">

            <label>Tujuan Penggunaan</label>

            <input type="text"
                   name="purpose"
                   class="form-control"
                   required>

        </div>

<!-- TANGGAL MULAI -->
        <div class="mb-3">

            <label>Tanggal Mulai</label>

            <input type="date"
            id="start_date"
                   name="start_date"
                   class="form-control"
                   required>

        </div>

<!-- TANGGAL SELESAI -->
        <div class="mb-3">

            <label>Tanggal Selesai</label>

            <input type="date"
                      id="end_date"
                   name="end_date"
                   class="form-control"
                   required>

        </div>

<!-- TOTAL HARGA -->
        <div class="mb-3">

            <label>Total Harga</label>

            <input type="number"
       name="total_price"
       id="total_price"
       class="form-control"
       readonly
       required>

        </div>

        <button type="submit"
                class="btn btn-success">

            Simpan Reservasi

        </button>

        <a href="/user/facilities"
           class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>

</div>

<script src="/js/reservation.js"></script>

<?= $this->include('layout/footer') ?>