<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth2();
if ($_SESSION['role'] == 2 && $_SESSION['id'] != $_GET['id']) {
     header("location:/lawOffice/articles/table.php?error=1");
}
$id = $_GET['id'];
$table = mysqli_query($connect, "SELECT * FROM `lawyer` where id=$id");
$lawyer = mysqli_fetch_assoc($table);
?>
<div class="container-fluid col-md-3 mt-5">
    <div class=>
        <img class="card" width="200px" src="<?= $lawyer['image'] ?>" alt="profile image">
    </div>
    <br>
    <h5>id : <?= $lawyer['id']  ?></h5>
    <h5>name : <?= $lawyer['name']  ?></h5>
    <h5> email : <?= $lawyer['email']  ?></h5>
    <h5> age : <?= $lawyer['age']  ?></h5>
    <h5> address : <?= $lawyer['address']  ?></h5>
    <h5> phone : <?= $lawyer['phone']  ?></h5>
    <h5> salary : <?= $lawyer['salary']  ?></h5>
    <h5> experience : <?= $lawyer['yearsEX']  ?></h5>
    
</div>

<?php
  include '/xampp/htdocs/lawOffice/shared/footer.php';
?>