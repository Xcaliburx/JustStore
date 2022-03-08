<?php

include("config.php");

if(isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $getData = $db->prepare("DELETE FROM slider WHERE sequence=$id");
    $query = $getData->execute();

    // apakah query hapus berhasil?
    if($query){
        echo "<script>
                alert('Sukses delete data');
            </script>";
        header('Location: ../slider.php');

    } else {
        echo "<script>
            alert('Failed delete data');
        </script>";
        header('Location: ../slider.php');
    }

} else {
    die("akses dilarang...");
}

?>