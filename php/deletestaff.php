<?php

include("config.php");

if(isset($_GET['email']) ){

    // ambil id dari query string
    $email = $_GET['email'];

    // buat query hapus
    $getData = $db->prepare("DELETE FROM account WHERE email='$email'");
    $query = $getData->execute();

    // apakah query hapus berhasil?
    if($query){
        echo "<script>
                alert('Sukses delete data');
            </script>";
        header('Location: ../staff.php');
    } else {
        die("Failed delete data");
        header('Location: ../staff.php');
    }

} else {
    die("akses dilarang...");
}

?>