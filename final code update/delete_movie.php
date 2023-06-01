<?php
session_start();

if (isset($_SESSION['username'])) {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mydatabase";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
  }

  $movie_id = $_GET['movie_id'];

  $sql = "DELETE FROM movies WHERE movie_id = '$movie_id' AND user_username = '{$_SESSION['username']}'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("The movie was deleted successfully."); setTimeout(function() { window.location.href = "userprofile.php"; }, 1000);</script>';
  } else {
    echo "Film silinirken bir hata oluştu: " . $conn->error;
  }

  $conn->close();
}
?>
