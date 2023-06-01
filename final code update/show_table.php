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


$username = $_SESSION['username'];
$sql = "SELECT * FROM movies WHERE user_username = '$username'";
$result = $conn->query($sql);

?>

<table>
  <tr>
    <th>Film Adı</th>
    <th>Kategori</th>
    <th>Yıl</th>
    <th>Süre</th>
    <th></th>
  </tr>
  <?php

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['moviename'] . "</td>";
      echo "<td>" . $row['category'] . "</td>";
      echo "<td>" . $row['year'] . "</td>";
      echo "<td>" . $row['duration'] . "</td>";
      echo "<td><a href='delete_movie.php?id=" . $row['id'] . "'>Sil</a></td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='5'>Henüz film eklenmemiş.</td></tr>";
  }
  ?>
</table>

<?php
$conn->close();
}
?>
