<?php 
    session_start(); 
    include_once "config.php"; 
    
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); 
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW); 

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) { 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { 
            $sql = mysqli_prepare($conn, "SELECT email FROM users WHERE email = ?"); 
            mysqli_stmt_bind_param($sql, "s", $email); 
            mysqli_stmt_execute($sql); 
            mysqli_stmt_store_result($sql); 

            if (mysqli_stmt_num_rows($sql) > 0) { 
                echo "Este e-mail já existe!"; 
            } else { 
                // Validar senha 
                $errors = array(); 

                if (strlen($password) < 8) { 
                    $errors[] = "A senha deve ter no mínimo 8 caracteres!"; 
                } 

                if (!preg_match("#[0-9]+#", $password)) { 
                    $errors[] = "A senha deve conter pelo menos um número!"; 
                } 

                if (!preg_match("#[a-zA-Z]+#", $password)) { 
                    $errors[] = "A senha deve conter pelo menos uma letra!"; 
                } 

                if (count($errors) === 0) { 
                    if (isset($_FILES['image'])) { 
                        $img_name = $_FILES['image']['name']; 
                        $tmp_name = $_FILES['image']['tmp_name']; 
                        $img_explode = explode('.', $img_name); 
                        $img_ext = end($img_explode); 
                        $extensions = ['png', 'jpeg', 'jpg']; 

                        if (in_array($img_ext, $extensions)) { 
                            $max_file_size = 5 * 1024 * 1024; // 5 MB

                            if ($_FILES['image']['size'] <= $max_file_size) {
                                if (getimagesize($tmp_name)) {
                                    $time = time(); 
                                    $new_img_name = $time . $img_name; 

                                    if (move_uploaded_file($tmp_name, "imgs/" . $new_img_name)) { 
                                        $status = "Ativo agora"; 

                                        $sql_max_id = "SELECT MAX(unique_id) as max_id FROM users"; 
                                        $result = mysqli_query($conn, $sql_max_id); 

                                        if ($result && mysqli_num_rows($result) > 0) { 
                                            $row = mysqli_fetch_assoc($result); 
                                            $new_user_id = $row['max_id'] + 1; 

                                            $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

                                            $sql2 = mysqli_prepare($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES (?,?,?,?,?,?,?)"); 
                                            mysqli_stmt_bind_param($sql2, "issssss", $new_user_id, $fname, $lname, $email, $hashed_password, $new_img_name, $status); 

                                            if (mysqli_stmt_execute($sql2)) { 
                                                $_SESSION['unique_id'] = $new_user_id; 
                                                echo "Cadastro realizado com sucesso!"; 
                                            } else { 
                                                echo "Algo deu errado!"; 
                                            } 
                                        } else { 
                                            echo "Algo deu errado ao obter o último ID de usuário!"; 
                                        } 
                                    } else { 
                                        echo "Ocorreu um erro ao fazer o upload da imagem!"; 
                                    } 
                                } else {
                                    echo "O arquivo enviado não é uma imagem válida!";
                                }
                            } else {
                                echo "O arquivo enviado é muito grande! Tamanho máximo permitido: " . $max_file_size/1024/1024 . " MB";
                            }
                        } else { 
                            echo "Selecione uma imagem no formato - jpeg, jpg, png!"; 
                        } 
                    } else { 
                        echo "Selecione uma imagem!"; 
                    } 
                } else { 
                    foreach ($errors as $error) { 
                        echo $error . " "; 
                    } 
                } 
            } 
        } else { 
            echo "E-mail inválido!"; 
        } 
    } else { 
        echo "Todos os campos são obrigatórios!"; 
    }
?>