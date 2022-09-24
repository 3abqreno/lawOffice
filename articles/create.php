<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
if (array_key_exists('btn', $_POST)) {  
    $title = $_POST['title'];
    $post = $_POST['post'];
    $auther = $_SESSION['name'];
    $email=$_SESSION['email'];
    $img_name = time() . $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $location = "./upload/$img_name";
    try {
        $insert = "INSERT INTO `article` VALUES (null,'$title','$post','$auther','$email','$location',DEFAULT,DEFAULT )";
        mysqli_query($connect, $insert);
        move_uploaded_file($tmp_name, $location);
        header("location:/lawOffice/articles/table.php");
    } catch (mysqli_sql_exception) {
        echo "invalid inputs";
    }
}
?>

<div><br></div>
<div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold">Admin register site</div>
    <form id="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" name='title' placeholder="title" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">article</label>
            <textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label>image</label>
            <input type="file" class="form-control-file" name='image' required>
        </div>


        <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>
    </form>


</div>


<?php
include '/xampp/htdocs/lawOffice/shared/footer.php';
?>