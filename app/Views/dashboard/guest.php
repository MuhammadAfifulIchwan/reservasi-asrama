<?= $this->include('layout/header') ?>

<?= $this->include('layout/guest_sidebar') ?>

<h2>Dashboard Guest</h2>

<hr>

<div class="card p-3">

    <h4>Selamat Datang Guest</h4>

    <p>

        Anda sedang masuk sebagai Guest.

    </p>

    <p>

        Guest hanya dapat melihat fasilitas yang tersedia.

    </p>

    <p>

        Untuk melakukan reservasi, silakan daftar sebagai User.

    </p>

    <a href="/register"
       class="btn btn-primary">

       Daftar Sekarang

    </a>

</div>

</div>

<?= $this->include('layout/footer') ?>
