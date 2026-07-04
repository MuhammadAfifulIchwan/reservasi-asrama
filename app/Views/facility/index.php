<?php
/** @var array $facilities */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="container mt-4">

    <div class="row">

        <div class="col-md-12">

            <h2>Daftar Fasilitas</h2>

            <hr>

            <?php if (session()->get('role') == 'admin'): ?>

    <a href="/facilities/create"
       class="btn btn-primary mb-3">

        Tambah Fasilitas

    </a>

<?php endif; ?>

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

<tr>

    <th width="5%">No</th>
    <th>Nama Fasilitas</th>
    <th>Kategori</th>
    <th>Harga</th>

    <th>Status Sistem</th>

    <th>Status Booking</th>

    <th>User ID</th>

    <th>Tanggal Mulai</th>

    <th>Tanggal Selesai</th>
                        <?php if (session()->get('role') == 'admin'): ?>

    <th width="20%">Action</th>

<?php endif; ?>

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

<?php if ($facility['status'] == 'available'): ?>

    <span class="badge bg-success">

        Available

    </span>

<?php else: ?>

    <span class="badge bg-secondary">

        -

    </span>

<?php endif; ?>

</td>

<td>

    <?= $facility['occupancy_status'] ?>

</td>

<td>

    <?= $facility['reserved_by'] ?>

</td>

<td>

    <?= $facility['start_date'] ?>

</td>

<td>

    <?= $facility['end_date'] ?>

</td>
                        <?php if (session()->get('role') == 'admin'): ?>

<td>

    <a href="/facilities/edit/<?= $facility['id'] ?>"
       class="btn btn-warning btn-sm">

       Edit

    </a>

    <a href="/facilities/delete/<?= $facility['id'] ?>"
       class="btn btn-danger btn-sm"

       onclick="return confirm('Yakin ingin menghapus fasilitas ini?')">

       Delete

    </a>

</td>

<?php endif; ?>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

<?= $this->include('layout/footer') ?>