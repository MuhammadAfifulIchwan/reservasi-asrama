<?php
/** @var array $payments */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="container mt-4">

    <h2>Verifikasi Pembayaran</h2>

    <hr>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

<tr>

    <th width="5%">No</th>

    <th>Invoice</th>

    <th>Kode Reservasi</th>

    <th>Nama User</th>

    <th>Fasilitas</th>

    <th>Metode</th>

    <th>Bukti</th>

    <th>Status</th>

    <th width="20%">Action</th>

</tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach ($payments as $payment): ?>

<tr>

    <td><?= $no++ ?></td>

    <td>

        <?= $payment['invoice_number'] ?>

    </td>

    <td>

        <?= $payment['reservation_code'] ?>

    </td>

    <td>

        <?= $payment['name'] ?>

    </td>

    <td>

        <?= $payment['facility_name'] ?>

    </td>

    <td>

        <?= $payment['payment_method'] ?>

    </td>

    <td>

        <a href="<?= base_url('uploads/payment/' . $payment['payment_proof']) ?>"
           target="_blank"
           class="btn btn-info btn-sm">

            Lihat Bukti

        </a>

    </td>

    <td>

        <?= $payment['payment_status'] ?>

    </td>

    <td>

        <a href="/payments/status/<?= $payment['id'] ?>/Lunas"
           class="btn btn-success btn-sm">

            Approve

        </a>

        <a href="/payments/status/<?= $payment['id'] ?>/Ditolak"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin menolak pembayaran ini?')">

            Reject

        </a>

    </td>

</tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</div>

<?= $this->include('layout/footer') ?>