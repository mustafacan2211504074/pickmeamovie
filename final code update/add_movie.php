<?php
session_start();


if (isset($_SESSION['username'])) {

$username = $_SESSION['username'];


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$moviename = $_POST['moviename'];
$category = $_POST['category'];
$year = $_POST['year'];
$duration = $_POST['duration'];
$username = $_SESSION['username'];

$sql = "INSERT INTO movies (user_username, moviename, category, year, duration) VALUES ('$username', '$moviename', '$category', '$year', '$duration')";

if ($conn->query($sql) === TRUE) {
    $redirectUrl = "/ibp%20project/userprofile.php";
  echo '<script>
    setTimeout(function() {
    alert("Movie added successfully.");
    window.location.href = "' . $redirectUrl . '";
    }, 1000);
    </script>';
} else {
  echo "Film eklenirken bir hata oluştu: " . $conn->error;
}

$conn->close();

} 
?>
