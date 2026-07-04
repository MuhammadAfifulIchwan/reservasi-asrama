<?php
/** @var array $facilities */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<div class="container mt-4">

    <h2>Daftar Fasilitas</h2>

    <hr>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th width="5%">No</th>
                <th>Nama Fasilitas</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach ($facilities as $facility): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $facility['facility_name'] ?></td>

                <td><?= $facility['category'] ?></td>

                <td>
                    Rp <?= number_format($facility['price'], 0, ',', '.') ?>
                </td>

<td>

<?php if ($facility['occupancy_status'] == 'Sedang Digunakan'): ?>

    <span class="badge bg-danger">

        Sedang Digunakan

    </span>

<?php else: ?>

    <span class="badge bg-success">

        Tersedia

    </span>

<?php endif; ?>

</td>

<td>

<?php if ($facility['occupancy_status'] == 'Sedang Digunakan'): ?>

    <button class="btn btn-secondary btn-sm"
            disabled>

        Tidak Tersedia

    </button>

<?php else: ?>

    <a href="/reservations/create/<?= $facility['id'] ?>"
       class="btn btn-primary btn-sm">

        Reservasi

    </a>

<?php endif; ?>

</td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</div>

<?= $this->include('layout/footer') ?>