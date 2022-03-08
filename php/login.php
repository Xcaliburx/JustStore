<?php 

require_once("config.php");

if(isset($_POST['login'])){

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = $_POST["password"];

    $sql = "SELECT * FROM account WHERE email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":email" => $email
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            // login sukses, alihkan ke halaman timeline
            header("Location: ../index.php");
        }else{
            $message = "password salah";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../login.html';</script>";
        }
    }else{
        $message = "akun email salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../login.html';</script>";
    }
}
?>