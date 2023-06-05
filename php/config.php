<?php 
    $conn = mysqli_connect("localhost", "admin", "123", "chat"); 
    if(!$conn){ 
        echo "Erro ao conectar: " . mysqli_connect_error(); 
    }
?>  