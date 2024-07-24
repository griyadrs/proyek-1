<?php
//admin hvantman123
session_start();
require "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

    <style>
        .main {
            height: 100vh;
        }

        .login-box {
            height: 300px;
            width: 500px;
            box-sizing: border-box;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control" name="username">
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password">
                </div>
                <div>
                    <button name="loginbtn" class="btn btn-success form-control mt-3" type="submit">
                        Login</button>
                </div>
            </form>
        </div>
        <div class="mt-3" style="width: 500px">
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                $query = mysqli_query($conn, "SELECT * FROM users WHERE
                username = '$username' AND password = '$password'");
                $countdata = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);

                if ($countdata > 0) {
                    if ($password == $data["password"]) {
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['login'] = true;
                        header('location: index.php');
                    } else { ?>
                        <div class="alert alert-warning" role="alert">
                            <i>Akun atau Sandi salah!</i>
                        </div>
                    <?php }
                    ;
                } else { ?>
                    <div class="alert alert-warning" role="alert">
                        <i>Akun atau Sandi salah!</i>
                    </div>
                <?php }
                ;
            }
            ?>
        </div>
    </div>
</body>

</html>