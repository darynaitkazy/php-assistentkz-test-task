<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include 'logic.php';
    include 'logicForLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <?php
            if (isset($_REQUEST['edit_data_btn'])) {
                $id = $_REQUEST['edit_id'];
                $sql = "SELECT * FROM data WHERE id=$id";
                $query = mysqli_query($conn, $sql);
                foreach($query as $q) {
        ?>
        <form method="post">
            <input type="hidden" name="edit_id" value="<?php echo $q['id']; ?>">
            <textarea name="edit_message"  class="form-control bg-dark text-white my-3"><?php echo $q['content']; ?></textarea>
            <button type="submit" name="update_btn" class="btn btn-primary">Изменить отзыв</button>
        </form>
        <?php
                }   
            }
        ?>
    </div>
</body>
</html>