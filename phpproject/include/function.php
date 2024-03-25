<?php
include 'db.php';
function checkLogin($userName,$password){

    global $conDB;
    $query = "SELECT username,password FROM user WHERE username='$userName' AND password='$password'";
    $sql = mysqli_query($conDB,$query);
    $data = mysqli_fetch_assoc($sql);

    if(mysqli_num_rows($sql)>0){
        return true;
    }
    else{
        return false;
    }
}

function checkLoginAuth(){
    if(!isset($_SESSION['login'])){
        header('Location: index.php');
        die();
    }
  
}
?>