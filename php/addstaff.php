<?php
require_once("config.php");

function validate_phone_number($phone){
    // Allow +, - and . in phone number
    $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    // Remove "-" from number
    $phone_to_check = str_replace("-", "", $filtered_phone_number);
    // Check the lenght of number
    // This can be customized if you want phone number from a specific country
    if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
       return false;
    } else {
      return true;
    }
}

if(isset($_POST['register'])){

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $gender = $_POST["gender"];
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    // enkripsi password
    $currpass = $_POST["password"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $role = $_POST["role"];
    $checkpass = $_POST["re-password"];

    if($role == null){
        $message = "role harus dipilih";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }elseif(strlen($name) < 3){
        $message = "name minimal 3 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else if($gender == null){
        $message = "gender harus dipilih";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else if(strlen($address) < 10){
        $message = "address minimal 10 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else if(validate_phone_number($phone) == false){
        $message = "format no telepon salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "format email salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }elseif(strlen($currpass) < 6){
        $message = "password minimal 6 karakter";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else if(strcmp($currpass, $checkpass) != 0){
        $message = "password dan re-password tidak sama";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../createstaff.php';</script>";
    }else{
        // menyiapkan query
        $sql = "INSERT INTO account (name, gender, address, phone, email, password, role) 
                VALUES (:name, :gender, :address, :phone, :email, :password, :role)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":name" => $name,
            ":gender" => $gender,
            ":address" => $address,
            ":phone" => $phone,
            ":password" => $password,
            ":email" => $email,
            ":role" => $role
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved) header("Location: ../staff.php");
        else header("Location: ../addstaff.php");
    }
}
?>