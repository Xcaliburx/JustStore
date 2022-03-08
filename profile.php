<?php require_once("php/auth.php"); 

$email = $_SESSION["user"]["email"];
$getData = $db->prepare("SELECT * FROM account 
                        WHERE email='$email' LIMIT 1");
$getData->execute();
$data = $getData -> fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustStore</title>
    <link rel="stylesheet" href="asset/css/profile.css">
    <link rel="stylesheet" href="/fontawesome/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
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
            <?php if($role == "admin") : ?>
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
                                <a href="profile.php">My Profile</a>
                                <a href="php/logout.php">Logout</a>
                            </div>
                        </div>
            <?php elseif($role == "staff") : ?>
                        <a href="">
                            <img src="asset/img-used/shopping-cart.svg" alt="" width="20" height="20">
                        </a>
                        <div class="dropdown-person">
                            <button class="dropbtn">
                                <img src="asset/img-used/people.svg" alt="" width="20" height="20">
                            </button>
                            <div class="dropdown-content">
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
                                <a href="profile.php">My Profile</a>
                                <a href="php/logout.php">Logout</a>
                            </div>
                        </div>
            <?php elseif($role == "user") : ?>
                        <a href="">
                            <img src="asset/img-used/shopping-cart.svg" alt="" width="20" height="20">
                        </a>
                        <div class="dropdown">
                            <button class="dropbtn">
                            <img src="<?php echo "uploaded/profilepic/".$_SESSION["user"]["profile_picture"] ?>" alt="" width="20" height="20">
                                <p><?php echo  $_SESSION["user"]["name"] ?></p>
                                <img src="asset/img-used/down-arrow.svg" alt="" width="10" height="10">
                            </button>
                            <div class="dropdown-content">
                                <a href="product.html#family">Shopping History</a>
                                <a href="profile.php">My Profile</a>
                                <a href="php/logout.php">Logout</a>
                            </div>
                        </div>        
            <?php endif; ?>
        </div>
    </nav>
    <section class="d-flex justify-content-center align-items-center">
        <div class="profile">
            <div class="picts">
                <img src="<?php echo "uploaded/profilepic/".$_SESSION["user"]["profile_picture"]?>" width="150" height="150" alt="" id="profile">
                <button type="button" class="edit" data-toggle="modal" data-target="#profs">
                    <img src="asset/img-used/pencil.svg" alt="" width="20" height="15">
                </button>
            </div>
            <div class="line"></div>
            <form action="php/updateprofile.php" method="POST">
                <div class="input">
                    <label for="">Name</label>
                    <input type="text" name="name" 
                    value="<?php echo  $data["name"] ?>" 
                    placeholder="e.g. John Doe">
                </div>
                <div class="genders">
                    <label for="">Gender</label>
                    <div class="gender">
                        <?php if($data["gender"] == 'male') : ?>
                            <input type="radio" name="gender" value="male" checked>
                            <label for="">Male</label>
                            <input type="radio" name="gender" value="female">
                            <label for="">Female</label>
                        <?php elseif($data["gender"] == 'female') : ?>
                            <input type="radio" name="gender" value="male">
                            <label for="">Male</label>
                            <input type="radio" name="gender" value="female" checked>
                            <label for="">Female</label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="address">
                    <label for="">Address</label>
                    <textarea  name="address" id="" cols="30" rows="4" placeholder="Address"><?php echo $data["address"] ?></textarea>
                </div>
                <div class="input">
                    <label for="">Phone</label>
                    <input value="<?php echo $data["phone"] ?>"  type="text" name="phone" placeholder="e.g. 085716343xxx">
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input style="border: none; background:transparent" value="<?php echo $data["email"] ?>" type="text" name="email" placeholder="example@mail.com">
                </div>
                <div class="buttons">
                    <button id="sign" type="submit" name="update">Update</button>
                    <button type="button" id="change" data-toggle="modal" 
                    data-target="#pass" data-email="<?php echo $data['email']?>">
                        Change Password
                    </button>
                </div>
            </form>
            <div class="modal fade" id="profs" tabindex="-1" aria-labelledby="profileLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="profileLabel">Change Profile Picture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="file">
                                    <input type="file">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="change">
                                Change Picture
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pass" tabindex="-1" aria-labelledby="passLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="php/updatepassword.php" method="POST">
                                <div class="input">
                                    <label for="">Email</label>
                                    <input type="text" name="email" placeholder="Current Email" class="email">
                                </div>
                                <div class="input">
                                    <label for="">Current Password</label>
                                    <input type="password" placeholder="Current Password" name="currpass" class="currpass">
                                </div>
                                <div class="input">
                                    <label for="">New Password</label>
                                    <input type="password" placeholder="New Password" name="newpass" class="newpass">
                                </div>
                                <div class="input">
                                    <label for="">Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" name="checkpass" class="checkpass">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="change" id="change" name="change">
                                        Change Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#change', function(){
            var email = $(this).data('email');

            $('.modal-body .email').val(email);
        });
    </script>
</body>
</html>