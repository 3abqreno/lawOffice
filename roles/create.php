<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
if (array_key_exists('btn', $_POST)) {
    $roleName = $_POST['name'];
    $rolecode = $_POST['role'];
    $insert = "INSERT INTO `roles` VALUES (null,'$roleName',$rolecode)";
    mysqli_query($connect, $insert);
    header("location:/lawOffice/roles/table.php");
  
}
?>

    <div><br></div>
    <div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold" >register site</div>
        <form id="3555" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Role name</label>
                <input type="text" class="form-control" name='name' placeholder="name" required>
            </div>
            <select class="custom-select pb" name="role" id="inputGroupSelect01" required>
                    <option value="0" >fullAcess</option>
                    <option value="1" >semiAcess</option>

            </select>
            <br>
            <br>
            <button type="submit" class=" btn btn-primary" name="btn" value='1'>Submit</button>
            
        </form>
        

    </div>
   

    <?php
    include '/xampp/htdocs/odc/Company/shared/footer.php';
    ?>