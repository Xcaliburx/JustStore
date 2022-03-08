<?php include("php/auth.php"); 

if($role == "user"){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustStore</title>
    <link rel="stylesheet" href="asset/css/manage-prod.css">
    <link rel="stylesheet" href="asset/css/chosen.min.css">
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
            <?php if($role == "admin") : ?>
                <div class="dropdown-content">
                    <a href="product.html#family">Manage Staffs/Admin</a>
                    <a href="slider.php">Manage Slider</a>
                    <div class="line"></div>
                    <a href="courier.php">Manage Couriers</a>
                    <a href="category.php">Manage Categories</a>
                    <a href="product.html#luxury">Manage Products</a>
                </div>
            <?php elseif($role == "staff") : ?>
                <div class="dropdown-content">
                    <a href="courier.php">Manage Couriers</a>
                    <a href="category.php">Manage Categories</a>
                    <a href="product.php">Manage Products</a>
                </div>
            <?php endif; ?>
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
    <section class="information">
        <h2>Product Information</h2>
        <div class="line"></div>
        <form action="">
            <div class="input">
                <label for="">Name</label>
                <input type="text">
            </div>
            <div class="input">
                <label for="">Description</label>
                <textarea name="" id="" cols="60" rows="4"></textarea>
            </div>
            <div class="input">
                <label for="">Price</label>
                <input type="text">
            </div>
            <div class="input">
                <label for="">Stock</label>
                <input type="text">
            </div>
            <div class="input">
                <label for="">Category</label>
                <select name="" id="selection" style="width: 450px;"multiple>
                    <option value="" selected>Men's Fashion</option>
                    <option value="" selected>Women's Fashion</option>
                    <option value="">Kids & Baby Fashion</option>
                </select>
            </div>
            <h2>Product Photos</h2>
            <div class="line"></div>
            <div class="file">
                <input type="file">
            </div>
            <div class="pictures">
                <div class="picts-catalog">
                    <div class="pict">
                        <img src="../img/Alphard.jpg" alt="">
                    </div>
                    <div class="act">
                        <input type="radio" name="picture">
                        <div class="button">
                            <button>
                                <img src="../img/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="picts-catalog">
                    <div class="pict">
                        <img src="../img/Alphard.jpg" alt="">
                    </div>
                    <div class="act">
                        <input type="radio" name="picture">
                        <div class="button">
                            <button>
                                <img src="../img/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="picts-catalog">
                    <div class="pict">
                        <img src="../img/Alphard.jpg" alt="">
                    </div>
                    <div class="act">
                        <input type="radio" name="picture">
                        <div class="button">
                            <button>
                                <img src="../img/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="picts-catalog">
                    <div class="pict">
                        <img src="../img/Alphard.jpg" alt="">
                    </div>
                    <div class="act">
                        <input type="radio" name="picture">
                        <div class="button">
                            <button>
                                <img src="../img/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="picts-catalog">
                    <div class="pict">
                        <img src="../img/Alphard.jpg" alt="">
                    </div>
                    <div class="act">
                        <input type="radio" name="picture">
                        <div class="button">
                            <button>
                                <img src="../img/trash.svg" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button>Save</button>
        </form>

    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.js" integrity="sha256-DrT5NfxfbHvMHux31Lkhxg42LY6of8TaYyK50jnxRnM=" crossorigin="anonymous"></script>
    <script src="chosen.jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#selection').chosen();
        });
    </script>
</body>
</html>