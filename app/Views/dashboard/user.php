<?php
/** @var int $totalFacilities */
/** @var int $activeReservations */
/** @var int $pendingReservations */
/** @var int $finishedReservations */
/** @var int $totalExpense */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<h2>Dashboard User</h2>

<hr>

<div class="row">

<!-- TOTAL FASILITAS -->
    <div class="col-md-4 mb-3">

        <div class="card text-center p-3">

            <h5>Total Fasilitas</h5>

            <h2><?= $totalFacilities ?></h2>

        </div>

    </div>

<!-- RESERVASI AKTIF -->
    <div class="col-md-4 mb-3">

        <div class="card text-center p-3">

            <h5>Reservasi Aktif</h5>

            <h2><?= $activeReservations ?></h2>

        </div>

    </div>


<!-- MENUNGGU VERIFIKASI -->
    <div class="col-md-4 mb-3">

        <div class="card text-center p-3">

            <h5>Menunggu Verifikasi</h5>

            <h2><?= $pendingReservations ?></h2>

        </div>

    </div>

<!-- RESERVASI SELESAI -->
    <div class="col-md-6 mb-3">

        <div class="card text-center p-3">

            <h5>Reservasi Selesai</h5>

            <h2><?= $finishedReservations ?></h2>

        </div>

    </div>

<!-- TOTAL PENGELUARAN -->
    <div class="col-md-6 mb-3">

        <div class="card text-center p-3">

            <h5>Total Pengeluaran</h5>

            <h2>

                Rp <?= number_format($totalExpense, 0, ',', '.') ?>

            </h2>

        </div>

    </div>

</div>

<br>

<div class="card p-4">

    <h4>

        Selamat Datang,

        <?= session()->get('name') ?>

    </h4>

    <p>

        Anda berhasil login ke sistem reservasi asrama.

    </p>

    <p>

        Gunakan menu sidebar untuk melakukan reservasi fasilitas asrama.

    </p>

</div>

<?= $this->include('layout/footer') ?>