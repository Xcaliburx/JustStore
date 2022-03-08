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
    <link rel="stylesheet" href="asset/css/slider.css">
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
        <div class="prod">
            <h1>Home Slider</h1>
            <button class="add" type="button" data-toggle="modal" data-target="#add">
                + Add
            </button>
        </div>
        <div class="tables">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Sequence</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Hyperlink</th>
                        <th scope="col">Start At</th>
                        <th scope="col">End At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $getData = $db->prepare("SELECT * FROM slider ORDER BY sequence ASC");
                        $getData->execute();
                        $data = $getData->fetchAll();
                        foreach($data as $datas){
                            echo "<tr>";
                            echo "<td class="."td".">".$datas['sequence']."</td>";
                            echo "<td class="."td".">".$datas['name']."</td>";
                            echo "<td class="."td".">
                            <img src='uploaded/slider/".$datas['image']."'></td>";
                            echo "<td class="."td".">
                            <a href='".$datas['hyperlink']."' class='hyperlink'>".$datas['hyperlink']."</a></td>";
                            echo "<td class="."td".">".$datas['start_at']."</td>";
                            echo "<td class="."td".">".$datas['end_at']."</td>";
                            echo "<td>
                                    <div class='action'>
                                    <button type='button' class='edit' 
                                    data-toggle='modal' data-target='#edit-1'
                                    data-id='".$datas['id']."' 
                                    data-sequence='".$datas['sequence']."'
                                    data-name='".$datas['name']."'
                                    data-start='".date('Y-m-d\TH:i:s', strtotime($datas['start_at']))."'
                                    data-end='".date('Y-m-d\TH:i:s', strtotime($datas['end_at']))."'
                                    data-link='".$datas['hyperlink']."'
                                    data-image='".$datas['image']."' id='update'>
                                    <img src='asset/img-used/edit.svg' alt=''>
                                </button>";
                            echo "<a href='php/deleteslider.php?id=".$datas['sequence']."'> 
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
                            <h5 class="modal-title" id="addLabel">Add Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="php/addslider.php" method="POST" enctype="multipart/form-data">
                                <div class="input">
                                    <label for="">Name</label>
                                    <input type="text" name="name">
                                </div>
                                <div class="input">
                                    <label for="">Sequence</label>
                                    <input type="number" name="sequence">
                                </div>
                                <div class="input">
                                    <label for="">Start At</label>
                                    <input type="datetime-local" name="start">
                                </div>
                                <div class="input">
                                    <label for="">End At</label>
                                    <input type="datetime-local" name="end">
                                </div>
                                <div class="input d-flex flex-row justify-content-between">
                                    <label for="">Hyperlink</label>
                                    <textarea name="hyperlink" id="" cols="40" rows="3"></textarea>
                                </div>
                                <div class="input">
                                    <label for="">Image</label>
                                    <div class="file">
                                        <input type="file" name="image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="add">Add Slider</button>
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
                            <h5 class="modal-title" id="editLabel-1">Edit Slider</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="php/updateslider.php" method="POST" enctype="multipart/form-data" class="form">
                                <div class="input">
                                    <label for="">ID</label>
                                    <div class="txt">
                                        <input type="text" name="id" style="border: none; background:transparent" class="id">
                                    </div>
                                </div>
                                <div class="input">
                                    <label for="">Sequence</label>
                                    <div class="txt">
                                        <input type="text" name="sequence" class="seq">
                                    </div>
                                </div>
                                <div class="input">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="name">
                                </div>
                                <div class="input">
                                    <label for="">Start At</label>
                                    <input type="datetime-local" name="start" class="start">
                                </div>
                                <div class="input">
                                    <label for="">End At</label>
                                    <input type="datetime-local" name="end" class="end">
                                </div>
                                <div class="input d-flex flex-row justify-content-between">
                                    <label for="">Hyperlink</label>
                                    <textarea class="link" name="hyperlink" cols="40" rows="3"></textarea>
                                </div>
                                <div class="input">
                                    <label for="">Image</label>
                                    <div class="file">
                                        <input type="file" name="image" class="image">
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
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $(document).on('click', '#update', function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var sequence = $(this).data('sequence');
            var link = $(this).data('link');
            var start = $(this).data('start');
            var end = $(this).data('end');
            var img = $(this).data('image');

            $('.modal-body .id').val(id);
            $('.modal-body .seq').val(sequence);
            $('.modal-body .name').val(name);
            $('.modal-body .link').val(link);
            $('.modal-body .start').val(start);
            $('.modal-body .end').val(end);
            $('.modal-body .image').val(img);
        });
    </script>
</body>
</html>