<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth2();
$id = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$table = mysqli_query($connect, "SELECT * FROM `lawyer` where id = $id ");
$lawyer = mysqli_fetch_assoc($table);
$firstImage = $lawyer['image'];
if (array_key_exists('btn', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $exp = $_POST['exp'];
    $pass = sha1($_POST['password']);
    if ($_FILES['image']['name'] != "") {
        unlink($lawyer['image']);
        $img_name = time() . $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = "./upload/$img_name";
        try {
            $update = "UPDATE `lawyer` SET `password`='$pass',`name`='$name',`image`='$location',`email`='$email',`address`='$address',`phone`='$phone',`age`=$age,`salary`=$salary,`yearsEX`=$exp WHERE id=$id";
            move_uploaded_file($tmp_name, $location);
            mysqli_query($connect, $update);
            header("location:/lawOffice/lawyer/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    } else {
        try {
            $update = "UPDATE `lawyer` SET `password`='$pass',`name`='$name',`email`='$email',`address`='$address',`phone`='$phone',`age`=$age,`salary`=$salary,`yearsEX`=$exp WHERE id=$id";
            mysqli_query($connect, $update);
            header("location:/lawOffice/lawyer/table.php");
        } catch (mysqli_sql_exception) {
            echo "invalid inputs";
        }
    }
}
?>

    <div><br></div>
    <div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold" >lawyer edit site</div>
        <form id="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control" value="<?= $lawyer['name'] ?>" name='name' placeholder="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">age</label>
                <input type="number" class="form-control" value="<?= $lawyer['age'] ?>" name='age' placeholder="age" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">address</label>
                <input type="text" class="form-control" value="<?= $lawyer['address'] ?>" name='address' placeholder="address" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">phone</label>
                <input type="text" class="form-control" value="<?= $lawyer['phone'] ?>" name='phone' placeholder="phone" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">salary</label>
                <input type="number" class="form-control" value="<?= $lawyer['salary'] ?>"  name='salary' placeholder="salary" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">years of experience</label>
                <input type="number" class="form-control" value="<?= $lawyer['yearsEX'] ?>" name='exp' placeholder="experience" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">email</label>
                <input type="text" class="form-control" value="<?= $lawyer['email'] ?>" name='email' placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">password</label>
                <input type="text" class="form-control" name='password' placeholder="password" required>
            </div>
   
            <div class="form-group">
                <label>image</label>
                <input type="file" class="form-control-file" name='image' >
                <img src="<?= $lawyer['image'] ?>" width="100px" alt="old profile pic" class="pt-3">
            </div>
            <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>
        </form>
        

    </div>
   

    <?php
    include '/xampp/htdocs/lawOffice/shared/footer.php';
    ?>