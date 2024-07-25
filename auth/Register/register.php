<?php
    include '../../connect.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "Pendaftaran berhasil.";
            header('location:../login');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
}
?>