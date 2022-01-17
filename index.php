<?php 
    session_start();
    include 'logic.php';
    include 'logicForLogin.php';
    include 'edit.php'; 
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="text-center">
            <?php
                if (isset($_SESSION["userLogin"])) { 
            ?>
            <h4>Вы админ</h4>
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php
                }
            ?>
            <?php 
                if (!isset($_SESSION["userLogin"])) { 
            ?>
            <a href="admin.php" class="btn btn-success">Вход для администратора</a>
            <a href="create.php" class="btn btn-outline-dark">Написать отзыв</a>
            <?php
                }
            ?>
        </div>
        <div class="row">
            <?php
                if (isset($_SESSION["userLogin"])) {
                    foreach($queryw as $qw) { ?>
                        <div class="col-12 d-flex jusify-content-center align-items-center">
                            <div class="text-white bg-dark mt-3 col-12">
                                <div class="card-body" style="width: 18rem;">
                                    <h5 class="card-title"><?php echo $qw['name'] ?></h5>
                                    <h5 class="card-title"><?php echo $qw['email'] ?></h5>
                                    <p class="card-text"><?php echo $qw['content'] ?></p>
                                    <img src="upload/<?php echo $qw['img'] ?>" width="100px" height="100px" style="margin-bottom: 20px;">
                                    
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="idw" value="<?php echo $qw['id']; ?>">
                                        <input type="hidden" name="namew" value="<?php echo $qw['name']; ?>">
                                        <input type="hidden" name="emailw" value="<?php echo $qw['email']; ?>">
                                        <input type="hidden" name="contentw" value="<?php echo $qw['content']; ?>">
                                        <input type="hidden" name="f_imagew" value="<?php echo $qw['img']; ?>">
                                        <button name="accept" class="btn btn-success">Accept</button>
                                        <button name="decline" class="btn btn-danger">Decline</button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>    
                
                <?php
                    }
                }    
                ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <select class="form-select form-select-sm mt-2" name="sorting" id="sorting">
                    <option value="byDate">по дате</option>
                    <option value="byName">по имени</option>
                    <option value="byEmail">по email</option>
                </select>
                <button name="select" class="btn btn-warning">Сортировать</button>
            </form>
            <?php
                foreach($query as $q) { ?>
                    <div class="col-12 d-flex jusify-content-center align-items-center">
                        <div class="text-white bg-dark mt-3 col-12">
                            <div class="card-body" style="width: 18rem;">
                                <h5 class="card-title"><?php echo $q['name'] ?></h5>
                                <h5 class="card-title"><?php echo $q['email'] ?></h5>
                                <p class="card-text"><?php echo $q['content'] ?></p>
                                
                                <img src="upload/<?php echo $q['img'] ?>" width="100px" height="100px" style="margin-bottom: 20px;">
                                <?php 
                                    if (isset($_SESSION["userLogin"])) {
                                ?>
                                
                                <form action="edit.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $q['id'] ?>">
                                    <button type="submit" name="edit_data_btn" class="btn btn-dark">Edit</button>
                                </form>
                                <form method="post">
                                    <input type="hidden" name="idd" value="<?php echo $q['id'] ?>">
                                    <button name="delete" class="btn btn-danger">Delete</button>
                                </form>
                                <?php
                                    if ($q['updated'] == 1) {
                                        ?>
                                        <p style="color: white;">Изменен администратором</p>
                                        <?php
                                    }
                                ?>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>    
            
            <?php 
                } ?>
        </div>
    </div>
</body>
</html>