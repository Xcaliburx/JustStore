<?php include("php/auth.php"); 

if($role != "admin"){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustStore</title>
    <link rel="stylesheet" href="asset/css/staff.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
    <nav class="d-flex flex-row">
        <a href="index.php"><h1>JustStore</h1></a>
        <div class="title-right">
            <div class="srch">
                <input type="text" placeholder="Search...">
                <button>
                    <img src="asset/img-used/search.svg" alt="" width="20" height="20">
                </button>
            </div>
            <a href="">
                <img src="asset/img-used/shopping-cart.svg" alt="" width="20" height="20">
            </a>
            <div class="dropdown-person">
                <button class="dropbtn">
                    <img src="asset/img-used/people.svg" alt="" width="20" height="20">
                </button>
                <div class="dropdown-content">
                    <a href="staff.php">Manage Staffs/Admin</a>
                    <a href="slider.php">Manage Slider</a>
                    <div class="line"></div>
                    <a href="courier.php">Manage Couriers</a>
                    <a href="category.php">Manage Categories</a>
                    <a href="product.php">Manage Products</a>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropbtn">
                    <img src="<?php echo "uploaded/profilepic/".$_SESSION["user"]["profile_picture"] ?>" alt="" width="20" height="20">
                    <p><?php echo  $_SESSION["user"]["name"] ?></p>
                    <img src="asset/img-used/down-arrow.svg" alt="" width="10" height="10">
                </button>
                <div class="dropdown-content">
                    <a href="product.html#family">Shopping History</a>
                    <a href="product.html#commercial">My Profile</a>
                    <a href="php/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <div class="prod">
            <h1>Staff/Admin</h1>
            <a href="createstaff.php" class="add">
                + Add
            </a>
        </div>
        <div class="search">
            <label for="">Search:</label>
            <input type="text">
        </div>
        <div class="tables">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $getData = $db->prepare("SELECT * FROM account 
                                            WHERE role='admin' OR role='staff'");
                    $getData->execute();
                    $data = $getData->fetchAll();
                    foreach($data as $datas){
                        echo "<tr>";
                        echo "<td class='td'>".$datas['name']."</td>";
                        echo "<td class='td'>".$datas['gender']."</td>";
                        echo "<td class='td'>".$datas['phone']."</td>";
                        echo "<td class='mail'>".$datas['email']."</td>";
                        echo "<td>
                            <div class='action'>
                                <a href='editstaff.php?email=".$datas['email']."' class='view'>
                                    <img src='asset/img-used/eye.svg' alt=''>
                                </a>";
                        echo "<a href='php/deletestaff.php?email=".$datas['email']."' class='view'>
                                        <img src='asset/img-used/icons8-trash-48.png' alt=''>
                                </a>
                            </div>
                        </td>";
                    }
                ?>
                </tr>
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>