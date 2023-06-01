<?php
$targetDirectory = 'img/';  
$targetFile = $targetDirectory . basename($_FILES['photo']['name']);  


if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFile)) {


    
    $photoPath = $targetFile;  


    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "mydatabase";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }

   
    $userId = 1;  
    $sql = "UPDATE users SET photo = '$photoPath' WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        echo "Fotoğraf yüklendi ve veritabanında kaydedildi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    
    $conn->close();
} else {
    echo "Fotoğraf yükleme hatası.";
}
?>
