<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$table = mysqli_query($connect, "SELECT * FROM `article` where id = $id ");
$article = mysqli_fetch_assoc($table);
$firstImage = $article['image'];
if (array_key_exists('btn', $_POST)) {
    $title = $_POST['title'];
    $post = $_POST['post'];
    if ($_FILES['image']['name'] != "") {
        unlink($article['image']);
        $img_name = time() . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "./upload/$img_name";
        try {
            $update = "UPDATE `article` SET `title`='$title',`description`='$post',`image`='$location' where id =$id";
            echo $update;
            move_uploaded_file($tmp_name, $location);
            mysqli_query($connect, $update);
            header("location:/lawOffice/articles/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    } else {
        try {
            $update = "UPDATE `article` SET `title`='$title',`description`='$post' where id =$id";
            echo $update;
            mysqli_query($connect, $update);
            header("location:/lawOffice/articles/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    }
}
?>

<div><br></div>
<div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold">Admin register site</div>
    <form id="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">title</label>
            <input type="text" class="form-control" value="<?= $article['title'] ?>" name='title' placeholder="title" required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">article</label>
            <textarea class="form-control" name="post" id="exampleFormControlTextarea1" rows="3"><?= $article['description'] ?></textarea>
        </div>

        <div class="form-group">
            <label>image</label>
            <input type="file" class="form-control-file" name='image' >
        </div>


        <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>
    </form>

</div>


<?php
include '/xampp/htdocs/lawOffice/shared/footer.php';
?>