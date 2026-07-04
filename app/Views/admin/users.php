<?php
/** @var array $users */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<h2>Kelola User</h2>

<hr>

<table class="table table-bordered">

    <thead>

        <tr>

            <th>No</th>
<th>Nama</th>
<th>Email</th>
<th>Role</th>
<th width="20%">Action</th>

        </tr>

    </thead>

    <tbody>

    <?php $no = 1; ?>

    <?php foreach($users as $user): ?>

        <tr>

            <td><?= $user['name'] ?></td>

<td><?= $user['email'] ?></td>

<td><?= $user['role'] ?></td>

<td>

    <a href="/admin/users/edit/<?= $user['id'] ?>"
       class="btn btn-warning btn-sm">

        Edit

    </a>

    <a href="/admin/users/delete/<?= $user['id'] ?>"
       class="btn btn-danger btn-sm"

       onclick="return confirm('Yakin hapus user ini?')">

        Delete

    </a>

</td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

</div>

<?= $this->include('layout/footer') ?>