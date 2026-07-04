<?php
/** @var int $totalUsers */
/** @var int $totalFacilities */
/** @var int $totalReservations */
/** @var int $pendingReservations */
/** @var int $approvedReservations */
/** @var int $paidPayments */
/** @var int $rejectedPayments */
/** @var int|float $totalRevenue */
/** @var array $transactions */
/** @var string|null $filterType */
/** @var string|null $filterValue */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <h2>Laporan Sistem</h2>

    <div>

<a href="/admin/report/export-pdf?filter_type=<?= $filterType ?>&filter_value=<?= $filterValue ?>"
   class="btn btn-danger">

    Export PDF

</a>

<a href="/admin/report/export-excel?filter_type=<?= $filterType ?>&filter_value=<?= $filterValue ?>"
   class="btn btn-success">

    Export Excel

</a>

    </div>

</div>

<hr>

<!-- FILTER LAPORAN -->
<div class="card p-4 mb-4">

    <h4>Filter Laporan</h4>

    <form method="get" action="/admin/report">

        <div class="row">

<!-- PILIH JENIS FILTER -->
            <div class="col-md-4 mb-3">

                <label>Jenis Filter</label>

<select name="filter_type" class="form-control">

    <option value="">-- Pilih Filter --</option>

    <option value="daily"
        <?= ($filterType == 'daily') ? 'selected' : '' ?>>
        Harian
    </option>

    <option value="monthly"
        <?= ($filterType == 'monthly') ? 'selected' : '' ?>>
        Bulanan
    </option>

    <option value="yearly"
        <?= ($filterType == 'yearly') ? 'selected' : '' ?>>
        Tahunan
    </option>

</select>

            </div>

<!-- VALUE FILTER -->
            <div class="col-md-4 mb-3">

                <label>Nilai Filter</label>
<input type="text"
       name="filter_value"
       value="<?= $filterValue ?>"
       class="form-control"
       placeholder="Contoh: 2026-05-10 / 2026-05 / 2026">

            </div>

<!-- BUTTON -->
            <div class="col-md-4 mb-3">

                <label>&nbsp;</label>

                <button class="btn btn-primary form-control">

                    Filter Laporan

                </button>

            </div>

        </div>

    </form>

</div>

<hr>

<div class="row">

<!-- TOTAL USER -->
    <div class="col-md-3 mb-3">
        <div class="card p-3 text-center">
            <h5>Total User</h5>
            <h3><?= $totalUsers ?></h3>
        </div>
    </div>

<!-- TOTAL FASILITAS -->
    <div class="col-md-3 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Fasilitas</h5>
            <h3><?= $totalFacilities ?></h3>
        </div>
    </div>

<!-- TOTAL RESERVASI -->
    <div class="col-md-3 mb-3">
        <div class="card p-3 text-center">
            <h5>Total Reservasi</h5>
            <h3><?= $totalReservations ?></h3>
        </div>
    </div>

<!-- PENDING -->
    <div class="col-md-3 mb-3">
        <div class="card p-3 text-center">
            <h5>Reservasi Pending</h5>
            <h3><?= $pendingReservations ?></h3>
        </div>
    </div>

</div>

<div class="row">

<!-- APPROVED -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Reservasi Approved</h5>
            <h3><?= $approvedReservations ?></h3>
        </div>
    </div>

<!-- LUNAS -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Pembayaran Lunas</h5>
            <h3><?= $paidPayments ?></h3>
        </div>
    </div>

<!-- DITOLAK -->
    <div class="col-md-4 mb-3">
        <div class="card p-3 text-center">
            <h5>Pembayaran Ditolak</h5>
            <h3><?= $rejectedPayments ?></h3>
        </div>
    </div>

</div>

<hr>

<div class="row">

    <div class="col-md-12">

        <div class="card p-4 text-center">

            <h4>Total Pendapatan Asrama</h4>

            <h2>

                Rp <?= number_format($totalRevenue, 0, ',', '.') ?>

            </h2>

        </div>

    </div>

</div>

<hr class="mt-5">

<h4>Daftar Transaksi Reservasi</h4>

<div class="table-responsive">

<table class="table table-bordered table-striped">

    <thead class="table-dark">

        <tr>

            <th>No</th>
            <th>Kode Reservasi</th>
            <th>Nama User</th>
            <th>Fasilitas</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Total Harga</th>
            <th>Status</th>

        </tr>

    </thead>

    <tbody>

    <?php $no = 1; ?>

    <?php foreach ($transactions as $trx): ?>

        <tr>

            <td><?= $no++ ?></td>

            <td><?= $trx['reservation_code'] ?></td>

            <td><?= $trx['user_name'] ?></td>

            <td><?= $trx['facility_name'] ?></td>

            <td><?= $trx['start_date'] ?></td>

            <td><?= $trx['end_date'] ?></td>

            <td>
                Rp <?= number_format($trx['total_price'],0,',','.') ?>
            </td>

            <td><?= $trx['status'] ?></td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</div>

<?= $this->include('layout/footer') ?>