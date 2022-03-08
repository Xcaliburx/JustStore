<?php
include("config.php");

if(isset($_POST['addcor'])){

    $nama = $_POST['name'];
    $cost = $_POST['cost'];
    $image = $_FILES["files"]["name"];
    $date = gmdate("Y-m-d H:i:s", time()+60*60*7);

    if(strlen($nama) < 3){
        $message = "name minimal 3 huruf";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../courier.php';</script>";
    }else if($cost <= 5000){
        $message = "cost minimal 5000";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../courier.php';</script>";
    }else if(!preg_match("/\.(jpeg|png|jpg|gif|svg)$/", $image)){
        $message = "extension file hanya boleh png, jpg, gif, svg dan jpeg";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../courier.php';</script>";
    }else if($_FILES["files"]["size"] > 2097152){
        $message = "size file maksimal 2MB";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<script>window.location.href='../courier.php';</script>";
    }else{
        // buat query
        $sql = "INSERT INTO courier (Name, Cost, Icon, last_updated)
                VALUES (:nama, :cost , :icon, :date)";
        
        $stmt = $db->prepare($sql);
        
        // bind parameter ke query
        $params = array(
            ":nama" => $nama,
            ":cost" => $cost,
            ":icon" => $image,
            ":date" => $date
        );

        $query = $stmt->execute($params);

        move_uploaded_file($_FILES["files"]["tmp_name"], '../uploaded/courier/'.$_FILES["files"]["name"]);

        if($query) {
            $message = "sukses input data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../courier.php';</script>";
        }else{
            $message = "failed input data";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<script>window.location.href='../courier.php';</script>";
        }
    }
}
?>
