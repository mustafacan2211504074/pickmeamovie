<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız oldu: " . $conn->connect_error);
}

$name = $_POST['name'];
$familyname = $_POST['familyname'];
$username = $_POST['username'];
$password = $_POST['password'];

$sql = "INSERT INTO users (name, familyname, username, password)
        VALUES ('$name', '$familyname', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    session_start();
    $_SESSION['username'] = $username; 

    $redirectUrl = "/ibp%20project/signin.html";
    echo '<script>
            setTimeout(function() {
              alert("Registration done successfully.");
              window.location.href = "' . $redirectUrl . '";
            }, 1000);
          </script>';
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
