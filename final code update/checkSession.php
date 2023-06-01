<?php
session_start();

if(isset($_SESSION['username'])) {
    
    echo "authenticated";
} else {
    
    echo "unauthenticated";
}
?>
