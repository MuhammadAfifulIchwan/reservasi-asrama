<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Halaman Login</h2>

<form method="post" action="<?= base_url('login/process') ?>">

    Email <br>
    <input type="email" name="email">

    <br><br>

    Password <br>
    <input type="password" name="password">

    <br><br>

    <button type="submit">Login</button>

</form>

</body>
</html>