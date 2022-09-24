<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
auth();
auth1();
if (array_key_exists('btn', $_POST)) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pass = sha1($_POST['password']);
    $role = $_POST['role'];
    $img_name=time().$_FILES['image']['name'];
    $tmp_name=$_FILES['image']['tmp_name'];
    $location = "./upload/$img_name";
    try{
    $insert = "INSERT INTO `admin` VALUES (null,'$name',$age,'$address','$phone','$email','$pass','$location',$role )";
     mysqli_query($connect, $insert);
    move_uploaded_file($tmp_name,$location);
    header("location:/lawOffice/admin/table.php");
    }
    catch(mysqli_sql_exception){
        echo "invalid inputs";
    }
}
?>

    <div><br></div>
    <div class="container add pt-3 pb-3">
    <div class="container text-center font-weight-bold" >Admin register site</div>
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