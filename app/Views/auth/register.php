<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Halaman Register</h2>

<form method="post" action="<?= base_url('register/store') ?>">

    Nama <br>
    <input type="text" name="name">

    <br><br>

    Email <br>
    <input type="email" name="email">

    <br><br>

    Password <br>
    <input type="password" name="password">

    <br><br>

    No HP <br>
    <input type="text" name="phone">

    <br><br>

    <button type="submit">Register</button>

</form>

</body>
</html>