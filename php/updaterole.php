<?php
require_once("config.php");

if(isset($_POST['update'])){
    $role = $_POST['role'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM account WHERE email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":email" => $email
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $sql = "UPDATE account
                SET role=:role
                WHERE email=:email";
        $stmt = $db->prepare($sql);
        $params = array(
            ":email" => $email,
            ":role" => $role
        );
        $stmt->execute($params);
        header("Location: ../staff.php");
    }else{
        echo('No account');
        header("Location: updaterole.php");
    }
}
?>