<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
 if ($_SESSION['role']==2||($_SESSION['role'] !=0 && $_SESSION['id'] != $_GET['id'])) {
     header("location:/odc/Company/index.php");
 }
$id = $_GET['id'];
$table = mysqli_query($connect, "SELECT * FROM `admindata` where adminId=$id");
$person = mysqli_fetch_assoc($table);
?>
<div class="container-fluid col-md-3 mt-5">
    <div class=>
        <img class="card" width="200px" src="<?= $person['image'] ?>" alt="profile image">
    </div>
    <br>
    <h5>id : <?= $person['adminID']  ?></h5>
    <h5>name : <?= $person['adminName']  ?></h5>
    <h5> email : <?= $person['email']  ?></h5>
    <h5> age : <?= $person['age']  ?></h5>
    <h5> address : <?= $person['address']  ?></h5>
    <h5> phone : <?= $person['phone']  ?></h5>
    <h5> role : <?= $person['roleName']  ?></h5>
    
</div>

<?php
  include '/xampp/htdocs/lawOffice/shared/footer.php';
?>