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
                    <p><?php echo  $_SESSION["user"]["name"] ?></p>
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
        <h1>Add Staff/Admin</h1>
        <div class="line"></div>
        <div class="option">
            <div class="sub-opsi" data-panel="option1">
                <p>New Account</p>
            </div>
            <div class="option-content" id="option1">
                <form action="php/addstaff.php" method="POST">
                    <div class="input">
                        <label for="">Role</label>
                        <select name="role" id="">
                            <option value="" disabled selected>Choose Role...</option>
                            <option name="role" value="staff">Staff</option>
                            <option name="role" value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="input">
                    <label for="">Name</label>
                    <input type="text" placeholder="e.g. John Doe" name="name">
                </div>
                <div class="genders">
                    <label for="">Gender</label>
                    <div class="gender">
                        <input type="radio" name="gender" value="male">
                        <label for="">Male</label>
                        <input type="radio" name="gender" value="female">
                        <label for="">Female</label>
                    </div>
                </div>
                <div class="address">
                    <label for="">Address</label>
                    <textarea name="address" id="" cols="30" rows="4" placeholder="Address"></textarea>
                </div>
                <div class="input">
                    <label for="">Phone</label>
                    <input type="text" name="phone" placeholder="e.g. 085716343xxx">
                </div>
                <div class="input">
                    <label for="">Email</label>
                    <input type="text" name="email" placeholder="example@mail.com">
                </div>
                <div class="input">
                    <label for="">Password</label>
                    <input type="text" name="password" placeholder="Password">
                </div>
                <div class="input">
                    <label for="">Re-Password</label>
                    <input type="text" name="re-password" placeholder="Confirm Password">
                </div>
                <button id="sign" type="submit" name="register">Add New Account</button>
                </form>
            </div>
        </div>
        <div class="option">
            <div class="sub-opsi" data-panel="option2">
                <p>Update Role</p>
            </div>
            <div class="option-content" id="option2">
                <form action="php/updaterole.php" method="POST">
                    <div class="input">
                        <label for="">Role</label>
                        <select name="role" id="">
                            <option value="" disabled selected>Choose Role...</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="input">
                        <label for="">Email</label>
                        <input type="text" name="email" placeholder="example@mail.com">
                    </div>
                    <button type="submit" name="update">Update User Role</button>
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $('.sub-opsi').on('click', function(){
                var panel = $(this).attr('data-panel');
                if($('#'+panel).css('display') == 'block')
                {
                    $('#'+panel).css({display: 'none'});
                }
                else
                {
                    $('#'+panel).css({display: 'block'});
                }
                
            });
        });
    </script>
</body>
</html>