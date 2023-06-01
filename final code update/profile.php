<?php
session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $host = 'localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'mydatabase';

    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız oldu: " . $conn->connect_error);
    }

    $sql = "SELECT name, familyname, username FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $familyname = $row['familyname'];
        $username = $row['username'];

        echo "<h2>$name $familyname</h2>";
        echo "<p>@$username</p>";
    } else {
        echo "Profil bilgileri bulunamadı.";
    }

    $conn->close();
} else {
    echo "Lütfen önce oturum açın.";
}
?>
