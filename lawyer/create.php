<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth2();
if (array_key_exists('btn', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];
    $exp = $_POST['exp'];
    $pass = sha1($_POST['password']);
    $img_name=time().$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $location = "./upload/$img_name";
    try{
    $insert = "INSERT INTO `lawyer` VALUES (null,'$name',$age,'$address',$salary,$exp,'$phone','$email','$pass','$location' )";
    echo $insert;
    mysqli_query($connect, $insert);
    move_uploaded_file($tmp_name,$location);
    header("location:/lawOffice/lawyer/table.php");
    }
    catch(mysqli_sql_exception){
        echo "invalid inputs";
    }
}
?>

    <div><br></div>
    <div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold" >lawyer register site</div>
        <form id="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control" name='name' placeholder="name" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">age</label>
                <input type="number" class="form-control" name='age' placeholder="age" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">address</label>
                <input type="text" class="form-control" name='address' placeholder="address" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">phone</label>
                <input type="text" class="form-control" name='phone' placeholder="phone" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">salary</label>
                <input type="number" class="form-control" name='salary' placeholder="salary" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">years of experience</label>
                <input type="number" class="form-control" name='exp' placeholder="experience" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">email</label>
                <input type="text" class="form-control" name='email' placeholder="email" required>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">password</label>
                <input type="text" class="form-control" name='password' placeholder="password" required>
            </div>
   
            <div class="form-group">
                <label>image</label>
                <input type="file" class="form-control-file" name='image' required>
            </div>
            <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>
        </form>
        

    </div>
   

    <?php
    include '/xampp/htdocs/lawOffice/shared/footer.php';
    ?>