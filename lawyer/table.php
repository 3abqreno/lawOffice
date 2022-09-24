<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth2();
if (array_key_exists('id', $_GET)) {
    $id=$_GET['id'];
    $p = mysqli_query($connect, "SELECT * FROM `lawyer` where id=$id");
    $del=mysqli_fetch_assoc($p);
    unlink($del['image']);  
    $email=$del['email'];
    $remove = "DELETE FROM `lawyer` WHERE lawyer.id='" . $_GET['id'] . "'";
    mysqli_query($connect, $remove);
    $table=mysqli_query($connect,"SELECT * from article where email='$email'");
    foreach($table as $article){
        echo"hi";
            echo "../articles".$article['image'];
    unlink("../articles".$article['image']);  
    $remove = "DELETE FROM `article` WHERE article.id='" . $article['id'] . "'";
    mysqli_query($connect, $remove);
    }
    header("location:table.php");
}

$table = mysqli_query($connect, "SELECT * FROM `lawyer`");

?>


<div class="container-fluid pt-2">
    <table class="table table-striped table-hover table-borderless">

        <thead class="font-weight-bold">
            <td>lawyer id </td>
            <td>name</td>
        </thead>
        <?php
        foreach ($table as $person) { ?>
            <tr></tr>
            <td><?php echo $person['id'] ?> </td>
            <td><?php echo $person['name'] ?></td>
            <td>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                    </button>
                    <div class="dropdown-menu container" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="profile.php?id=<?= $person['id'] ?>"><i class="fa-solid fa-eye"></i></a>
                        <a class="dropdown-item" href="edit.php?id=<?= $person['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="dropdown-item" href="table.php?id=<?= $person['id']?>"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>
            </td>
           
        <?php
        }

        ?>

</div>

<?php
  include '/xampp/htdocs/lawOffice/shared/footer.php';
?>