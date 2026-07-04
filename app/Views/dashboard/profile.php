<?= $this->include('layout/header') ?>

<?= $this->include('layout/user_sidebar') ?>

<h2>Profil User</h2>

<hr>

<div class="card p-3">

    <h4>Data Profil</h4>

    <p>Nama : <?= session()->get('name') ?></p>

    <p>Role : <?= session()->get('role') ?></p>

</div>

</div>

<?= $this->include('layout/footer') ?>