<?php
session_start();
session_unset();
session_destroy();

echo '<script>
        alert("Log out successful.");
        setTimeout(function() {
             window.location.href = "mainpage.html";
        }, 1000); 
        </script>';
exit();
?>
