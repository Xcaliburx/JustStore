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
    $role = "user";
    $file = $_FILES["picture"]["name"];
    $checkpass = $_POST["re-password"];

    if(strlen($name) < 3){
        $message = "name minimal 3 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if($gender == null){
        $message = "gender harus dipilih";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if(strlen($address) < 10){
        $message = "address minimal 10 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if(validate_phone_number($phone) == false){
        $message = "format no telepon salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $message = "format email salah";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }elseif(strlen($currpass) < 6){
        $message = "password minimal 6 karakter";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if(strcmp($currpass, $checkpass) != 0){
        $message = "password dan re-password tidak sama";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if(!preg_match("/\.(jpeg|png|jpg)$/", $file)){
        $message = "extension file hanya boleh png, jpg, dan jpeg";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else if($_FILES["picture"]["size"] > 2097152){
        $message = "size file maksimal 2MB";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../signup.html';</script>";
    }else{
    // menyiapkan query
        $sql = "INSERT INTO account (name, gender, address, phone, email, password, role, profile_picture) 
                VALUES (:name, :gender, :address, :phone, :email, :password, :role, :file)";
        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = array(
            ":name" => $name,
            ":gender" => $gender,
            ":address" => $address,
            ":phone" => $phone,
            ":password" => $password,
            ":email" => $email,
            ":role" => $role,
            ":file" => $file
        );

        // eksekusi query untuk menyimpan ke database
        $saved = $stmt->execute($params);

        move_uploaded_file($_FILES["picture"]["tmp_name"], '../uploaded/profilepic/'.$_FILES["picture"]["name"]);

        // jika query simpan berhasil, maka user sudah terdaftar
        // maka alihkan ke halaman login
        if($saved) header("Location: ../login.html");
        else header("Location: ../signup.html");
    }
}
?>