<?php include("php/config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustStore</title>
    <link rel="stylesheet" href="asset/css/index.css?v=<?php echo time(); ?>">
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
            <a href="login.html" class="login">Login</a>
            <a href="signup.html" class="register">Register</a>
        </div>
    </nav>
    <section>
        <div style="z-index: -99;" id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
            <?php
                $getData = $db->prepare("SELECT * FROM slider ORDER BY sequence ASC");
                $getData->execute();
                $data = $getData->fetchAll();
                $cek = 1;
                foreach($data as $datas){
                    if($cek == 1){
                        echo "<div class='carousel-item active'>
                            <img class='d-block w-75' style='height: 40rem; margin: auto;' src='uploaded/slider/".$datas['image']."'>
                          </div>";
                          $cek++;
                    }else{
                        echo "<div class='carousel-item'>
                            <img class='d-block w-75' style='height: 40rem; margin: auto;' src='uploaded/slider/".$datas['image']."'>
                          </div>";
                    }
                }
            ?>
            </div>
        </div>
        <br>
        <div class="categories">
            <?php
                $getData = $db->prepare("SELECT * FROM category ORDER BY ID ASC");
                $getData->execute();
                $data = $getData->fetchAll();
                foreach($data as $datas){
                    echo "<a href=''>";
                    echo "<div class='ctg'>";
                    echo "<img width='10' height='10' src='uploaded/category/".$datas['icon']."'>";
                    echo "<p>".$datas['icon']."</p>";
                    echo "</div>";
                }
            ?>
        </div>
        <br>
        <div class="cards">
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
            <a href="">
                <div class="card">
                    <img src="../img/Alphard.jpg" alt="">
                    <div class="content">
                        <p>Lorem ipsum dolor sit amet.</p>
                        <p class="price"><b>Rp100.000</b></p>
                    </div>
                </div>
            </a>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="script.js"></script>

</body>
</html>