<?php
include '/xampp/htdocs/lawOffice/shared/header.php';
include '/xampp/htdocs/lawOffice/shared/nav.php';
include '/xampp/htdocs/lawOffice/general/env.php';
include '/xampp/htdocs/lawOffice/general/functions.php';
if(isset($_POST['email'])){
    $email=$_POST['email'];
    $pass=sha1($_POST['pass']);
    $admin=mysqli_query($connect,"SELECT * FROM admin where email = '$email' and `password` ='$pass' ");
    $row=mysqli_num_rows($admin);
    if($row){
        $adminData=mysqli_fetch_assoc($admin);
        $roleID=$adminData['roleID'];
        $roledata=mysqli_query($connect,"SELECT * from roles where id=$roleID");
        $role=mysqli_fetch_assoc($roledata);
        $_SESSION['name']=$adminData['name'];
        $_SESSION['email']=$adminData['email'];
        $_SESSION['ID']=$adminData['id'];
        $_SESSION['role']=$role['perm'];
        header("location:/lawOffice/articles/table.php");
    }
    else {
        $lawyer=mysqli_query($connect,"SELECT * FROM lawyer where email = '$email' and `password` ='$pass' ");
        $row=mysqli_num_rows($lawyer);
        if($row){
            $lawyerData=mysqli_fetch_assoc($lawyer);
            $roleID=2;
            $_SESSION['name']=$lawyerData['name'];
            $_SESSION['email']=$lawyerData['email'];
            $_SESSION['ID']=$adminData['id'];
            $_SESSION['role']=$roleID;
            header("location:/lawOffice/articles/table.php");
        }
    }
}
if(array_key_exists('error',$_GET)){
    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>you didn't have access to the page requested</strong> plaese login 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div> <?php
  }
?>

<div><br><br><br></div>
<div class="container add pt-3 pb-3">
<form id="3555"  method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">email</label>
                <input type="text" class="form-control" name='email' placeholder="email" required>
            </div>
            <div class="form-group">
                <label>password</label>
                <input type="password" class="form-control" name='pass' placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="btn" value='1'>Submit</button>

        </form>
        
</div>


<?php
    include '/xampp/htdocs/lawOffice/shared/footer.php';
    ?>