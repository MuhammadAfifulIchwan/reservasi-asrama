<?php
/** @var int $totalUsers */
/** @var int $totalFacilities */
/** @var int $totalReservations */
/** @var int $totalPayments */
/** @var int $totalRevenue */
/** @var array $reservationChart */
/** @var array $revenueChart */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<h2>Dashboard Admin</h2>

<hr>

<div class="row">

    <!-- TOTAL USER -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Total User</h5>
            <h3><?= $totalUsers ?></h3>
        </div>
    </div>

    <!-- TOTAL FASILITAS -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Fasilitas</h5>
            <h3><?= $totalFacilities ?></h3>
        </div>
    </div>

    <!-- TOTAL RESERVASI -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Reservasi</h5>
            <h3><?= $totalReservations ?></h3>
        </div>
    </div>

    <!-- TOTAL PEMBAYARAN -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Pembayaran</h5>
            <h3><?= $totalPayments ?></h3>
        </div>
    </div>

    <!-- TOTAL PENDAPATAN -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Pendapatan</h5>
            <h3>
                Rp <?= number_format($totalRevenue, 0, ',', '.') ?>
            </h3>
        </div>
    </div>

</div>

<hr>

<!-- GRAFIK -->

<div class="row mt-4">

    <!-- GRAFIK RESERVASI -->

    <div class="col-md-6">

        <div class="card p-4">

            <h4>Grafik Reservasi Bulanan</h4>

            <canvas id="reservationChart"></canvas>

        </div>

    </div>


    <!-- GRAFIK PENDAPATAN -->

    <div class="col-md-6">

        <div class="card p-4">

            <h4>Grafik Pendapatan Bulanan</h4>

            <canvas id="revenueChart"></canvas>

        </div>

    </div>

</div>
<script>

window.reservationChartData =
<?= json_encode($reservationChart) ?>;


window.revenueChartData =
<?= json_encode($revenueChart) ?>;

</script>

<?= $this->include('layout/footer') ?>