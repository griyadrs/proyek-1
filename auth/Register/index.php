<!DOCTYPE html>
<html>
    <head>
        <title>Formulir Pendaftaran Pengguna</title>
    </head>
    <body>
        <h2>Formulir Pendaftaran Pengguna</h2>
        <form action="register.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>
            <input type="submit" value="Daftar">
        </form>
    </body>
</html>
