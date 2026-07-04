<?php
/** @var array $reservations */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<div class="container mt-4">

    <h2>Reservasi Saya</h2>

    <hr>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th width="5%">No</th>
                <th>Kode Reservasi</th>
<th>Nama Fasilitas</th>
<th>Tujuan</th>
<th>Tanggal Reservasi</th>
<th>Status</th>

            </tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach ($reservations as $reservation): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $reservation['reservation_code'] ?></td>

<td><?= $reservation['facility_name'] ?></td>

<td><?= $reservation['purpose'] ?></td>

<td>

    <?= $reservation['start_date'] ?>

    s/d

    <?= $reservation['end_date'] ?>

</td>

<td>

<?php if ($reservation['status'] == 'Pending'): ?>

    <span class="badge bg-warning text-dark">

        Menunggu Approve Admin

    </span>

<?php elseif ($reservation['status'] == 'Approved'): ?>

    <span class="badge bg-info">

        Silahkan Upload Pembayaran

    </span>

<?php elseif ($reservation['status'] == 'Selesai'): ?>

    <span class="badge bg-success">

        Reservasi Selesai

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
