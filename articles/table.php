<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
if(array_key_exists('error',$_GET)){
  ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>you didn't have access to the page requested</strong> you got back to the articles page 
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div> <?php
}
if (array_key_exists('id', $_GET)) {
    $id=$_GET['id'];
    $p = mysqli_query($connect, "SELECT * FROM `article` where id=$id");
    $del=mysqli_fetch_assoc($p);
    unlink($del['image']);  
    $remove = "DELETE FROM `article` WHERE article.id='" . $_GET['id'] . "'";
    mysqli_query($connect, $remove);
    header("location:table.php");
}

$table = mysqli_query($connect, "SELECT * FROM `article`  ");

?>


<div class="container pt-2">
 
    <?php foreach($table as $article) {?>
        <div>
        <div class="container  pt-3">
        <img width="300px" src="<?= $article['image'] ?>"  alt="old profile pic" class="pt-5 card">
        </div>


       <div class="container col-md-7 ">
       auther : <?= $article['title']?>
       <br>
       title : <?= $article['auther']?>
       <br>
        <?= $article['description'] ?>
        <br>
       <?= $article['update_time'] ?>
       <?php  if(($_SESSION['role']==1)||($_SESSION['role']==0)||($_SESSION['email']==$article['email'])){
        
    ?> 
    <br><br>
    <a class="btn btn-primary" href="/lawOffice/articles/edit.php?id=<?= $article['id'] ?>">edit</a>
    <a class="btn btn-danger pr-3" href="/lawOffice/articles/table.php?id=<?= $article['id'] ?>">delete</a>

    <?php } ?>
       </div>
      

        </div>
       
        <?php }?>
</div>

<?php
  include '/xampp/htdocs/lawOffice/shared/footer.php';
?>