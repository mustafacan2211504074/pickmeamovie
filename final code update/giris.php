<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "mydatabase"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanı bağlantısında hata oluştu: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        session_start();
        $_SESSION["username"] = $username;

        echo '<script>
        alert("Login successful.");
        setTimeout(function() {
             window.location.href = "mainpage.html";
        }, 1000); 
        </script>';
        exit();
    } else {
        echo '<script>
        alert("Username or password is wrong.");
        setTimeout(function() {
             window.location.href = "signin.html";
        }, 1000); 
        </script>';
    }
}

$conn->close();
?>
