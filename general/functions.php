<?php 

function auth(){
    if(!isset($_SESSION['role'])){
        header("location:/lawOffice/login/login.php?error=1");
    }
    else return true;
}
function auth1(){

        if($_SESSION['role']!=0){
            header("location:/lawOffice/articles/table.php?error=1");
        }
        else return true;
}

function auth2(){
        if($_SESSION['role']==2){
            header("location:/lawOffice/articles/table.php?error=1");
        }
        else return true;
}




?>