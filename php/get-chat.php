<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']); 

        $sql = "SELECT * FROM messages 
            LEFT JOIN users ON users.unique_id = messages.incoming_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id ASC";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                if($row['outgoing_msg_id'] === $outgoing_id) {
                    echo '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                            </div>';
                } else {
                    echo '<div class="chat incoming">
                                <img src="php/imgs/' . $row['img'] . '" alt="">
                                <div class="details">
                                   <p>'. $row['msg'] .'</p>
                                </div>
                            </div>';
                }
            }
        } else {
            echo '<p class="no-msg custom-class">Não há mensagens! Inicie sua conversa...</p><style>.custom-class {
                text-align: center;
                opacity: 0.5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                font-size: 18px;
              }</style>';
        }
    } else {
        header("Location: ../login.php");
    }
?>