<?php

session_start();
if (isset($_GET['logout'])) {
  session_unset();
  session_destroy();
  header("location:/lawOffice/login/login.php");
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-info text-danger myNav">
  <a class="navbar-brand" href="/lawOffice/index.php">Office</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if (false) { ?>
    <a class="navbar-brand" href="/odc/Company/admin/profile.php?id=<?= $_SESSION['id'] ?>">profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  <?php } ?>

  <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
    <ul class="navbar-nav mr-auto">
    <?php 
    if(isset($_SESSION['role'])){
    if( $_SESSION['role']==0){?>
      <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              admin
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/lawOffice/admin/table.php"">admins</a>
              <a class="dropdown-item" href="/lawOffice/admin/create.php">Create</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              roles
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/lawOffice/roles/table.php">table</a>
              <a class="dropdown-item" href="/lawOffice/roles/create.php">Create</a>
            </div>
          </li>

     <?php } 
     if($_SESSION['role']!=2){
     ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          lawers
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="/lawOffice/lawyer/table.php">Table</a>
          <a class="dropdown-item" href="/lawOffice/lawyer/create.php">Create</a>
        </div>
      </li>
     <?php }}?>
              <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle " href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Articles
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="/lawOffice/articles/table.php">view articles</a>
              <a class="dropdown-item" href="/lawOffice/articles/myarticles.php">my articles</a>
              <a class="dropdown-item" href="/lawOffice/articles/create.php">create article</a>
            </div>
          </li>  

    </ul>
<?php if(isset($_SESSION['name'])){ ?>
    <span class="pr-3"><a href="/lawOffice/login/login.php?logout=1" class="btn btn-danger my-2 my-sm-0" type="submit">logout</a></span>


  <?php } else { ?>
    </ul>
    <span class="pr-3"><a href="/lawOffice/login/login.php" class="btn btn-success my-2 my-sm-0" type="submit">login</a></span>
  <?php } ?>

  </div>
</nav>