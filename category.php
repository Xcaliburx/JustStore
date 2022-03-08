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
    <link rel="stylesheet" href="asset/css/category.css">
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
    <section>
        <div class="bar">
            <h1>Category</h1>
            <form class="search-add"  action="" method="POST">
                <div class="srch-courier">
                    <input name="search" type="text" placeholder="Search...">
                    <button name="searchbut" type="submit">
                        <img src="asset/img-used/search.svg" alt="" width="20" height="20">
                    </button>
                </div>
                <button class="add" type="button" data-toggle="modal" data-target="#add">+ Add</button>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Icon</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $getData = $db->prepare("SELECT * FROM category ORDER BY ID ASC");
                    $getData->execute();
                    $data = $getData->fetchAll();
                    
                    foreach($data as $datas){
                        echo "<tr>";
                        echo "<td class="."td".">".$datas['name']."</td>";
                        echo "<td class="."td".">
                        <img style='height: 50px; margin-right: 5px;' src='uploaded/category/".$datas['icon']."'>".$datas['icon']."</td>";
                        echo "<td>
                            <div class='action'>
                            <button type='button' class='edit' data-toggle='modal' data-target='#edit-1'
                            data-id='".$datas['ID']."'
                            data-name='".$datas['name']."'
                            data-icon='".$datas['icon']."'
                            data-updated='".$datas['last_updated']."' id='update'>
                            <img src='asset/img-used/edit.svg' alt=''>
                            </button>";
                        echo "<a href='php/deletecategory.php?id=".$datas['ID']."'> 
                                <img src='asset/img-used/icons8-trash-48.png' style='height: 30px; width: 30px; margin: 10px;'>
                              </a>";
                    }
                ?>
            </tbody>

        </table>
        <!-- Modal -->
        <!-- Add -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLabel">Add Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="php/addcategory.php" method="POST" enctype="multipart/form-data">
                            <div class="input">
                                <label for="">Name</label>
                                <input name="name" type="text">
                            </div>
                            <div class="input">
                                <label for="">Icon</label>
                                <div class="file">
                                    <input type="file" name="files">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button name="addcat" type="submit">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit -->
        <div class="modal fade" id="edit-1" tabindex="-1" aria-labelledby="editLabel-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLabel-1">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="php/updatecategory.php" method="POST" enctype="multipart/form-data" class="form">
                            <div class="input">
                                <label for="">ID</label>
                                <div class="txt">
                                <input type="text" name="id" style="border: none; background:transparent" class="id">
                                </div>
                            </div>
                            <div class="input">
                                <label for="">Name</label>
                                <input type="text" name="name" class="name">
                            </div>
                            <div class="input">
                                <label for="">Icon</label>
                                <div class="file">
                                    <input type="file" name="files" class="icon">
                                </div>
                            </div>
                            <div class="input">
                                <label for="">Last Updated</label>
                                <div class="txt">
                                    <p>2020-10-31 06:03:36</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#update', function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var icon = $(this).data('icon');
            var updated = $(this).data('updated');

            $('.modal-body .id').val(id);
            $('.modal-body .name').val(name);
            $('.modal-body .icon').val(icon);
            $('.modal-body #updated p').html(updated);

        });
    </script>                
</body>
</html>