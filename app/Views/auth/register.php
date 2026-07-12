<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Halaman Register</h2>

                    <form method="post" action="<?= base_url('register/store') ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success w-100">Register</button>

                        <p class="text-center mt-3 mb-0">
                            Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a>
                        </p>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>