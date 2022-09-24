<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
if (array_key_exists('id', $_GET)) {
    $id=$_GET['id'];
    $p = mysqli_query($connect, "SELECT * FROM `roles` where id=$id");
    $del=mysqli_fetch_assoc($p);
    try{
    $remove = "DELETE FROM `roles` WHERE roles.id='" . $_GET['id'] . "'";
    mysqli_query($connect, $remove);
    header("location:table.php");
    }
    catch(mysqli_sql_exception){
        echo"couldn't delete role while employees are working on it";
    }
}

if (array_key_exists('btn', $_GET)) {
}
$table = mysqli_query($connect, "SELECT * FROM `roles`");

?>


<div class="container-fluid pt-2">
    <table class="table table-striped table-hover table-borderless">

        <thead class="font-weight-bold">
            <td> employee id </td>
            <td>name</td>
            <td>permission code</td>
            <td>action</td>
        </thead>
        <?php
        foreach ($table as $role) { ?>
            <tr></tr>
            <td><?php echo $role['id'] ?></td>
            <td><?php echo $role['name'] ?></td>
            <td><?php echo $role['perm'] ?></td>
            <td>
                <div class="dropdown">
                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i>
                    </button>
                    <div class="dropdown-menu container" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="edit.php?id=<?= $role['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a class="dropdown-item" href="table.php?id=<?= $role['id']?>"><i class="fa-solid fa-trash-can"></i></a>
                    </div>
                </div>
            </td>
           
        <?php
        }

        ?>

</div>

<?php
include '/xampp/htdocs/odc/Company/shared/footer.php';
?>