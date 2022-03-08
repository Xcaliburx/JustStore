<?php include("php/auth.php"); 

if($role != "admin"){
    header("Location: index.php");
}

if(isset($_GET['email'])){
    $email = $_GET['email'];
    $getData = $db->prepare("SELECT * FROM account 
                            WHERE email='$email' LIMIT 1");
    $getData->execute();
    $data = $getData -> fetch();
    if(!$data){
        die('no data');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustStore</title>
    <link rel="stylesheet" href="asset/css/add-staff.css">
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
                    <p><?php echo $_SESSION["user"]["name"] ?></p>
                    <img src="asset/img-used/down-arrow.svg" alt="" width="10" height="10">
                </button>
                <div class="dropdown-content">
                    <a href="product.html#family">Shopping History</a>
                    <a href="profile.php">My Profile</a>
                    <a href="php/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <section>
        <?php if($data['role'] == 'staff') : ?>
            <h1>Staff Information</h1>
        <?php elseif($data['role'] == 'admin') : ?>
            <h1>Admin Information</h1>
        <?php endif; ?>
        <div class="line"></div>
        <div class="form">
            <form action="php/updatestaff.php" method="POST">
                <div class="input">
                    <label for="">Name</label>
                    <input type="text" name="name" 
                    value="<?php echo $data['name'] ?>" 
                    placeholder="e.g. John Doe">
                </div>
                <div class="genders">
                    <label for="">Gender</label>
                    <div class="gender">
                        <?php if($data['gender'] == 'male') : ?>
                            <input type="radio" name="gender" value="male" checked>
                            <label for="">Male</label>
                            <input type="radio" name="gender" value="female">
                            <label for="">Female</label>
                        <?php elseif($data['gender'] == 'female') : ?>
                            <input type="radio" name="gender" value="male">
                            <label for="">Male</label>
                            <input type="radio" name="gender" value="female" checked>
                            <label for="">Female</label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="address">
                    <label for="">Address</label>
                    <textarea  name="address" id="" cols="30" rows="4" placeholder="Address"><?php echo $data['address'] ?></textarea>
                </div>
                <div class="input">
                    <label for="">Phone</label>
                    <input value="<?php echo $data['phone'] ?>"  type="text" name="phone" placeholder="e.g. 085716343xxx">
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input style="border: none; background:transparent" value="<?php echo $data['email'] ?>" type="text" name="email" placeholder="example@mail.com">
                </div>
                <div class="input">
                    <label for="">Password</label>
                    <input type="password" value="<?php echo $data['password'] ?>"  name="password" placeholder="Password">
                </div>
                <div class="input">
                    <label for="">Re-Password</label>
                    <input type="password" value="<?php echo $data['password'] ?>"  name="re-password" placeholder="Confirm Password">
                </div>
                <button id="sign" type="submit" name="update">Save Changes</button>
            </form>
        </div>
    </section>
</body>
</html>