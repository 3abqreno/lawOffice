<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$table = mysqli_query($connect, "SELECT * FROM `admindata` where adminId = $id ");
$person = mysqli_fetch_array($table);
$role = $person['roleID'];
$firstImage = $person['image'];
if (array_key_exists('btn', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $role = $_POST['role'];
    if ($_FILES['image']['name'] != "") {
        unlink($person['image']);
        $img_name = time() . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "./upload/$img_name";
        try {
            $insert = "UPDATE `admin` SET `password`='$pass',`name`='$name',`image`='$location',`roleID`=$role,`email`='$email',`address`='$address',`phone`='$phone',`age`=$age WHERE id=$id";
            echo $insert;
            move_uploaded_file($tmp_name, $location);
            mysqli_query($connect, $insert);
            header("location:/lawOffice/admin/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    } else {
        try {
            $insert = "UPDATE `admin` SET `password`='$pass',`name`='$name',`roleID`=$role,`email`='$email',`address`='$address',`phone`='$phone',`age`=$age WHERE id=$id";

            echo $insert;
            mysqli_query($connect, $insert);
            header("location:/lawOffice/admin/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    }
}
?>

<div><br></div>
<div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold">edit admin data site</div>
    <form id="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputEmail1">name</label>
            <input type="text" value="<?= $person['adminName'] ?>" class="form-control" name='name' placeholder="name" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">age</label>
            <input type="number" value="<?= $person['age'] ?>" class="form-control" name='age' placeholder="age" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">address</label>
            <input type="text" value="<?= $person['address'] ?>" class="form-control" name='address' placeholder="address" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">phone</label>
            <input type="text" value="<?= $person['phone'] ?>" class="form-control" name='phone' placeholder="phone" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">email</label>
            <input type="text" value="<?= $person['email'] ?>" class="form-control" name='email' placeholder="email" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">password</label>
            <input type="text" class="form-control" name='password' placeholder="password" required>
        </div>

        <div class="form-group">
            <label>image</label>
            <input type="file" class="form-control-file" name='image'>
            <img src="<?= $person['image'] ?>" width="100px" alt="old profile pic" class="pt-3">
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Options</label>
            </div>
            <select class="custom-select" name="role" id="inputGroupSelect01" required>

                <?php
                $dep = mysqli_query($connect, "SELECT * FROM `roles`");
                foreach ($dep as $dp) { ?>
                    <option value="<?php echo $dp['id'] ?>"><?php echo $dp['name'] ?></option>
                <?php }
                ?>
            </select>

        </div>
        <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>
    </form>


</div>


<?php
include '/xampp/htdocs/lawOffice/shared/footer.php';
?>