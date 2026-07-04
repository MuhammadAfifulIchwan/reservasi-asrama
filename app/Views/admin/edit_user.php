<?php
/** @var array $user */
?>

<?= $this->include('layout/header') ?>

<?= $this->include('layout/admin_sidebar') ?>

<div class="container mt-4">

    <h2>Edit User</h2>

    <hr>

    <form method="post"
          action="<?= base_url('admin/users/update/' . $user['id']) ?>">

        <div class="mb-3">

            <label>Nama</label>

            <input type="text"
                   name="name"
                   class="form-control"

                   value="<?= $user['name'] ?>">

        </div>


        <div class="mb-3">

            <label>Email</label>

            <input type="email"
                   name="email"
                   class="form-control"

                   value="<?= $user['email'] ?>">

        </div>


        <div class="mb-3">

            <label>Role</label>

            <select name="role"
                    class="form-control">

                <option
                    value="admin"

                    <?= $user['role'] == 'admin'
                        ? 'selected'
                        : '' ?>>

                    Admin

                </option>


                <option
                    value="user"

                    <?= $user['role'] == 'user'
                        ? 'selected'
                        : '' ?>>

                    User

                </option>


                <option
                    value="guest"

                    <?= $user['role'] == 'guest'
                        ? 'selected'
                        : '' ?>>

                    Guest

                </option>

            </select>

        </div>


        <button class="btn btn-primary">

            Update User

        </button>

        <a href="/admin/users"
           class="btn btn-secondary">

            Kembali

        </a>

    </form>

</div>

</div>

<?= $this->include('layout/footer') ?>