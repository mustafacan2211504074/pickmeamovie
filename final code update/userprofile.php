<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Movie Picker</title>
    
</head>
<style>
    body{
        background-color: #131314;
        font-family: newFont;
    }
    @font-face {
        font-family: newFont;
        src: url(fonts/Roboto-Medium.ttf);
    }
    .userinfo{
        margin-top: 100px;
        width: 300px;
        height: 360px;
        border: 1px solid #5CDB95;
        margin-left: 670px;
        margin-bottom: 40px;
        background-color: rgba(0, 0, 0, 0.4);
        background-blend-mode: overlay;
        border-radius: 10px;
    }
    .watched-movies{
        width: 1200px;
        height: 600px;
        border: 1px solid #5CDB95;
        border-radius: 10px;
        margin-left: 220px;
    }
    .nav1{
            width: 101px;
            height: 49px;
            float: left;
            border-bottom: 3px solid #F55725;
            
    }
    .nav2{
            width: 1499px;
            float: right;
            height: 49px;
            border-bottom: 3px solid #F55725;
            
    }
    .logonav{
            width: 175px;
            height: 63px;
            margin-top: 10px;
            cursor: pointer;
            border: 3px solid;
            border-image:linear-gradient(to bottom,transparent 60%,transparent 0) 2;
            margin-left: -3px;
            margin-right: -2.5px;
    }
    .navbar{
            width: 100%;
            display: flex;
            justify-content: start;
            position: fixed;
            top: 0;
            background-color: #131314;
            z-index:2;
            height: 50px;
    }
    .logo{
            width: 100%;
            height: 100%;
    }
    .user-photo{
        width: 225px;
        height: 225px;
        margin-left: 37.5px;
        
        margin-top: 37.5px;
    }
    .user-info{
        width: 500px;
        height: 100px;
        
        margin-top: 10px;
        margin-left: -100px;
    }
    .user-name{
        width: 100%;
        height: 50%;
        
        text-align: center;
    }
    .user-name h2{
        color: white;
        font-size: 25px;
        margin-top: 5px;
    }
    .user-name p{
        color: #888;
        font-size: 14px;
        margin-top: -10px;
    }
    .user-photo img{
        width: 100%;
        height: 100%;
        border-radius: 10px;
    }
    .watchlist{
       
        width: 300px;
        height: 75px;
        margin-left: 25px;
        margin-top: 20px;
        color: white;
        font-size: 32px;
        float: left;
    }
    .table{
        
        width: 1150px;
        height: 480px;
        margin-left: 25px;
        
    }
    table{
        width: 100%;
    }
    th{
        color: white;
        font-size: 22px;
        text-align: left;
        padding-bottom: 10px;
    }
    td{
        color: #888;
        font-size: 18px;
        padding-bottom: 5px;
    }
    .addmovie{
        width: 140px;
        height: 32px;
        margin-right: 25px;
        margin-top: 20px;
        color: white;
        font-size: 18px;
        float: right;
        text-align: right;
        border: 1px solid #888;
        text-align: center;
        padding-top: 10px;
        background-color: #888;
        cursor: pointer;
        border-radius: 10px;
    }
    .delete{
        cursor: pointer;
        color: #F55725;
    }
</style>
<body>
    <div class="navbar">
        <div class="nav1"></div>
        <div class="logonav"> <a href="mainpage.html"><img src="logoideas/logo öneri3png.png" class="logo"></a>   
        </div>
        <div class="nav2"></div>
    </div>
    <div class="userinfo">
        <div class="user-photo"><img src="defaultuser.jpg"></div>
        <div class="user-info">
            <div class="user-name">
                <?php include 'profile.php'; ?>
            </div>
        </div>
    </div>
    <div class="watched-movies">
        <div class="watchlist">Movie Watchlist</div>
        <div class="addmovie" onclick="showForm()">+ Add Movie</div>
        <div class="table">
            <form id="myForm" style="display: none;" action="add_movie.php" method="POST">
                <input type="text" name="moviename" placeholder="Movie Name" required><br>
                <input type="text" name="category" placeholder="Category" required><br>
                <input type="number" name="year" placeholder="Year" required><br>
                <input type="number" name="duration" placeholder="Duration (minute)" required><br>
                <input onclick="saveForm()" type="submit" value="Add Movie">
            </form>
            <?php



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
    <th>Movie Name</th>
    <th>Category</th>
    <th>Year</th>
    <th>Duration(minute)</th>
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
      echo "<td><a href='delete_movie.php?movie_id=" . $row['movie_id'] . "'>Delete</a></td>";
      echo "</tr>";
    }
  } else {
    echo "<tr><td colspan='5'>No movies have been added yet.</td></tr>";
  }
  ?>
</table>

<?php
$conn->close();
}
?>

        </div>
    </div>
    <script>
    function showForm() {
  var form = document.getElementById("myForm");
  form.style.display = "block";
}

function saveForm() {
  var form = document.getElementById("myForm");
  form.style.display = "none";
}


    </script>
    <style>
        form {
  position: absolute;
  top: 50%;
  left: 81%;
  transform: translate(-50%, -50%);
}
    #myForm{
        border: 2px solid #5CDB95;
        width: 175px;
        background-color: #131314;
        height: 105px;
        border-radius: 5px;
    }
    </style>
</body>
</html>
