<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
 auth();
if (array_key_exists('id', $_GET)) {
    $id=$_GET['id'];
    $p = mysqli_query($connect, "SELECT * FROM `article` where id=$id");
    $del=mysqli_fetch_assoc($p);
    unlink($del['image']);  
    $remove = "DELETE FROM `article` WHERE article.id='" . $_GET['id'] . "'";
    mysqli_query($connect, $remove);
    header("location:table.php");
}
$userEmail=$_SESSION['email'];
$table = mysqli_query($connect, "SELECT * FROM `article` where  email = '$userEmail'");

?>


<div class="container pt-2">
 
    <?php foreach($table as $article) {?>
        <div>
        <div class="container  pt-3">
        <img width="300" src="<?= $article['image'] ?>"  alt="old profile pic" class="pt-5 card">
        </div>
       <div class="container col-md-7 ">
       auther : <?= $article['auther']?>
       <br>
        <?= $article['description'] ?>
        <br>
       <?= $article['update_time'] ?>
       <br><br>
       <a class="btn btn-primary" href="/lawOffice/articles/edit.php?id=<?= $article['id'] ?>">edit</a>
       <a class="btn btn-danger" href="/lawOffice/articles/myarticles.php?id=<?= $article['id'] ?>">delete</a>
       </div>
      

        </div>
       
        <?php }?>
</div>

<?php
  include '/xampp/htdocs/lawOffice/shared/footer.php';
?>