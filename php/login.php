<?php 
    session_start(); 
    include_once "config.php"; 
    
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW); 

    if (!empty($email) && !empty($password)) {
        $sql = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?"); 
        mysqli_stmt_bind_param($sql, "s", $email); 
        mysqli_stmt_execute($sql); 
        $result = mysqli_stmt_get_result($sql); 

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $status = "Ativo agora";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if (password_verify($password, $row['password'])) {
                $_SESSION['unique_id'] = $row ['unique_id']; 

                $status = "Ativo agora";
                $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");

                echo "Login realizado com sucesso!"; 
            } else {
                echo "Email ou Senha incorreto!"; 
            }
        } else {
            echo "Email ou Senha incorreto!"; 
        }

    } else {
        echo "Todos os campos são obrigatórios!"; 
    }
?>