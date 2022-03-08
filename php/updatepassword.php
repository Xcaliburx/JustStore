<?php
require_once("config.php");

if(isset($_POST['change'])){
    $email = $_POST['email'];
    $curpass = $_POST['currpass'];
    $pass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

    $getdata = "SELECT * FROM account WHERE email=$email LIMIT 1";
    $datas = $db->prepare($getdata);
    $datas->execute();
    $truepass = $datas->fetch(PDO::FETCH_ASSOC);


    if(password_verify($curpass, $truepass["password"])){
        $sql = "UPDATE account
                SET password=:pass
                WHERE email=:email";

        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
        ":pass" => $pass,
        ":email" => $email
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        if($saved) header("Location: ../profile.php");
        else{
            die('query failed');
            header("Location: ../profile.php");
        } 
    }else{
        die('wrong password');
        header("Location: ../profile.php");
    }
}
?>