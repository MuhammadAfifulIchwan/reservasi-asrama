<?php
/** @var array $reservations */
/** @var array $payments */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<div class="container mt-4">

    <h2>Upload Pembayaran</h2>

    <hr>

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif; ?>

    <form method="post"
          action="<?= base_url('payments/store') ?>"
          enctype="multipart/form-data">

        <!-- PILIH RESERVASI -->

        <div class="mb-3">

            <label>Pilih Reservasi</label>

            <select name="reservation_id"
                    class="form-control">

                <?php foreach ($reservations as $reservation): ?>

                    <option
                        value="<?= $reservation['id'] ?>">

                        <?= $reservation['reservation_code'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- METODE PEMBAYARAN -->

        <div class="mb-3">

            <label>Metode Pembayaran</label>

            <select name="payment_method"
                    class="form-control">

                <option>Transfer Bank</option>

                <option>QRIS</option>

            </select>

        </div>


        <!-- UPLOAD FILE -->

        <div class="mb-3">

            <label>Upload Bukti Pembayaran</label>

            <input type="file"
                   name="payment_proof"
                   class="form-control">

        </div>


        <button class="btn btn-primary">

            Upload Pembayaran

        </button>

    </form>

    <hr class="mt-5">
    /*TABEL UNTUK DOWNLOAD INVOICE */

    <h3>Riwayat Pembayaran</h3>

    <table class="table table-bordered">

        <thead class="table-dark">

            <tr>

                <th>Invoice</th>
                <th>Kode Reservasi</th>
                <th>Status</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach ($payments as $payment): ?>

            <tr>

                <td>
                    <?= $payment['invoice_number'] ?>
                </td>

                <td>
                    <?= $payment['reservation_code'] ?>
                </td>

                <td>
                    <?= $payment['payment_status'] ?>
                </td>

                <td>

                    <?php if ($payment['payment_status'] == 'Lunas'): ?>

                        <a href="/payments/invoice/<?= $payment['id'] ?>"
                           class="btn btn-success btn-sm">

                            Download Invoice

                        </a>

                    <?php else: ?>

                        -

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

</div>

<?= $this->include('layout/footer') ?>