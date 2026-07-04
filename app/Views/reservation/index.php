<?php
/** @var array $reservations */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="container mt-4">

    <h2>Kelola Reservasi</h2>

    <hr>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

    <th>No</th>

    <th>Kode Reservasi</th>

<th>Nama User</th>

<th>Nama Fasilitas</th>

    <th>Total Harga</th>

    <th>Status</th>

    <th>Action</th>

</tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach ($reservations as $reservation): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $reservation['reservation_code'] ?></td>

<td><?= $reservation['name'] ?></td>

<td><?= $reservation['facility_name'] ?></td>

                <td>
                    Rp <?= number_format($reservation['total_price'], 0, ',', '.') ?>
                </td>

                <td><?= $reservation['status'] ?></td>
<td>

<?php if ($reservation['status'] == 'Pending'): ?>

    <a href="/reservations/status/<?= $reservation['id'] ?>/Approved"
       class="btn btn-success btn-sm">

        Approve

    </a>

    <a href="/reservations/status/<?= $reservation['id'] ?>/Rejected"
       class="btn btn-danger btn-sm">

        Reject

    </a>

<?php elseif ($reservation['status'] == 'Approved'): ?>

    <span class="badge bg-warning text-dark">

        Menunggu Pembayaran

    </span>

<?php elseif ($reservation['status'] == 'Selesai'): ?>

    <span class="badge bg-success">

        Sedang Ditempati

    </span>

    <br><br>

    <a href="/reservations/status/<?= $reservation['id'] ?>/Checkout"
       class="btn btn-primary btn-sm">

        Checkout

    </a>

<?php elseif ($reservation['status'] == 'Checkout'): ?>

    <span class="badge bg-secondary">

        Sudah Checkout

    </span>

<?php elseif ($reservation['status'] == 'Rejected'): ?>

    <span class="badge bg-danger">

        Reservasi Ditolak

    </span>

<?php endif; ?>

</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</div>

<?= $this->include('layout/footer') ?>