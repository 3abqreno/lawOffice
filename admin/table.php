<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
if (array_key_exists('id', $_GET)) {
    $id=$_GET['id'];
    $p = mysqli_query($connect, "SELECT * FROM `admin` where id=$id");
    $del=mysqli_fetch_assoc($p);
    unlink($del['image']);  
    $remove = "DELETE FROM `admin` WHERE admin.id='" . $_GET['id'] . "'";
    mysqli_query($connect, $remove);
    header("location:table.php");
}

$table = mysqli_query($connect, "SELECT * FROM `admindata` order by roleID asc ");

?>


<div class="container-fluid pt-2">
    <table class="table table-striped table-hover table-borderless">

        <thead class="font-weight-bold">
            <td> amdin id </td>
            <td>name</td>
        </thead>
        <?php
        foreach ($table as $person) { ?>
            <tr></tr>
            <td><?php echo $person['adminID'] ?> </td>
            <td><?php echo $person['adminName'] ?></td>
            <td><?php echo $person['roleName'] ?></td>
            <td>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                    </button>
                    <div class="dropdown-menu container" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="profile.php?id=<?= $person['adminID'] ?>"><i class="fa-solid fa-eye"></i></a>
                        <a class="dropdown-item" href="edit.php?id=<?= $person['adminID'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="dropdown-item" href="table.php?id=<?= $person['adminID']?>"><i class="fa-solid fa-trash-can"></i></a>
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