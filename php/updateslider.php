<?php
include("config.php");

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $nama = $_POST['name'];
    $sequence = $_POST['sequence'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $link = $_POST['hyperlink'];
    $image = $_FILES["image"]["name"];

    if(strlen($nama) < 5){
        $message = "name minimal 5 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../slider.php';</script>";
    }else if($sequence < 1){
        $message = "sequence minimal 1";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../slider.php';</script>";
    }else if(!(startsWith($link, "https") || startsWith($link, "http") || startsWith($link, "localhost") || startsWith($link, "127.0.0.1"))){
            $message = "harus diawali dengan “http” / “https” / “localhost” / “127.0.0.1”";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../slider.php';</script>";
    }else if(strtotime($end) <= strtotime($start)){
            $message = "end time harus lebih besar dari start time";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../slider.php';</script>";
    }else if(!preg_match("/\.(jpeg|png|jpg|gif|svg)$/", $image)){
        $message = "extension file hanya boleh png, jpg, gif, svg dan jpeg";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../slider.php';</script>";
    }else if($_FILES["files"]["size"] > 5242880){
        $message = "size file maksimal 2MB";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../slider.php';</script>";
    }else{
        // buat query
        $sql = "UPDATE slider
                SET name=:nama, sequence=:sequence, start_at=:start,
                end_at=:end, hyperlink=:link, image=:image
                WHERE id=:id";
        
        $stmt = $db->prepare($sql);
        
        // bind parameter ke query
        $params = array(
            ":id" => $id,
            ":nama" => $nama,
            ":sequence" => $sequence,
            ":start" => $start,
            ":end" => $end,
            ":link" => $link,
            ":image" => $image
        );

        $query = $stmt->execute($params);

        move_uploaded_file($_FILES["image"]["tmp_name"], '../uploaded/slider/'.$_FILES["image"]["name"]);

        if($query) {
            // kalau berhasil alihkan ke halaman index.php dengan status=sukses
            $message = "sukses update data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../slider.php';</script>";
        }else{
            $message = "failed update data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../slider.php';</script>";
        }
    }
}

?>