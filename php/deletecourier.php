<?php

include("config.php");

if(isset($_GET['id']) ){

    // ambil id dari query string
    $id = $_GET['id'];

    // buat query hapus
    $getData = $db->prepare("DELETE FROM courier WHERE ID=$id");
    $query = $getData->execute();

    // apakah query hapus berhasil?
    if($query){
        echo "<script>
                alert('Sukses delete data');
            </script>";
        header('Location: ../courier.php');

    } else {
        echo "<script>
            alert('Failed delete data');
        </script>";
        header('Location: ../courier.php');
    }

} else {
    die("akses dilarang...");
}

?>