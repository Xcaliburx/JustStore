<?php
include("config.php");

if(isset($_POST['update'])){

    $id = $_POST['id'];
    $nama = $_POST['name'];
    $image = $_FILES["files"]["name"];
    $date = gmdate("Y-m-d H:i:s", time()+60*60*7);

    if(strlen($nama) < 3){
        $message = "name minimal 3 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../category.php';</script>";
    }else if(!preg_match("/\.(jpeg|png|jpg|gif|svg)$/", $image)){
        $message = "extension file hanya boleh png, jpg, gif, svg dan jpeg";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../category.php';</script>";
    }else if($_FILES["files"]["size"] > 2097152){
        $message = "size file maksimal 2MB";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../category.php';</script>";
    }else{
        // buat query
        $sql = "UPDATE category
                SET name=:nama, icon=:icon, last_updated=:date
                WHERE ID=:id";
        
        $stmt = $db->prepare($sql);
        
        // bind parameter ke query
        $params = array(
            ":id" => $id,
            ":nama" => $nama,
            ":icon" => $image,
            ":date" => $date
        );

        $query = $stmt->execute($params);

        move_uploaded_file($_FILES["files"]["tmp_name"], '../uploaded/category/'.$_FILES["files"]["name"]);

        if($query) {
            $message = "sukses update data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../category.php';</script>";
        }else{
            $message = "failed update data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../category.php';</script>";
        }
    }
}
?>
