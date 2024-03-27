<?php
include 'db.php';

function checkLogin($userName, $password) {
    global $conDB;
    $query = "SELECT username, password FROM user WHERE username='$userName'";
    $sql = mysqli_query($conDB, $query);
    
    if ($sql && mysqli_num_rows($sql) == 1) {
        $data = mysqli_fetch_assoc($sql);
        $hashed_password = $data['password'];
        
        if (password_verify($password, $hashed_password)) {
            setSession($userName);
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function checkLoginAuth() {
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit();
    }
}

function setNewUserDetails($mail, $username, $hashed_password) {
    global $conDB;
    $check_query = "SELECT COUNT(*) AS count FROM user WHERE username = '$username'";
    $check_result = mysqli_query($conDB, $check_query);
    $row = mysqli_fetch_assoc($check_result);

    if ($row['count'] > 0) {
        return false;
    } else {
        $query = "INSERT INTO user (username, password, email) VALUES ('$username', '$hashed_password', '$mail')";
        $sql = mysqli_query($conDB, $query);        

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }
}

function setSession($username) {
    $_SESSION['username'] = $username;
}

function isLoggedIn() {
    return isset($_SESSION['username']);
}

function logout() {
    $_SESSION = array();
    session_destroy();
    header('Location: ../../index.php');
}

function getIdByUserName($usrnm) {
    global $conDB;
    $query = "SELECT id FROM user WHERE username = '$usrnm'";
    $sql = mysqli_query($conDB, $query);

    if ($sql) {
        $data = mysqli_fetch_assoc($sql);
        return $data['id'];
    } else {
        return 0;
    }
}

function setNewHotel($name, $address, $description, $userid) {
    global $conDB;
    
    $name = mysqli_real_escape_string($conDB, $name);
    $address = mysqli_real_escape_string($conDB, $address);
    $description = mysqli_real_escape_string($conDB, $description);
    $userid = (int)$userid;
    
    $query = "INSERT INTO hotel (name, address, description, ownerid) VALUES ('$name', '$address', '$description', $userid)";
    $sql = mysqli_query($conDB, $query);
    
    if ($sql) {
        return true;
    } else {
        return false;
    }
}
function getHotelDetails($id='') {
    global $conDB;
    $query = "SELECT * FROM hotel";
    if($id!=''){
        $query .= " WHERE id = $id"; 
    }
    $sql = mysqli_query($conDB, $query);
    $data = array();

    if ($sql && mysqli_num_rows($sql) > 0) {
        while ($row = mysqli_fetch_assoc($sql)) {
            $data[] = $row;
        }
    }

    return $data;
}

function updateHotelDetails($id, $name, $address, $description){
    global $conDB;
    $query = "UPDATE hotel set name = '$name', address='$address',description='$description' WHERE id =$id";
    $sql= mysqli_query($conDB,$query);
    if($sql){
        return true;
    }
    else{
        return false;
    }
}
function gettOwnerIdFromId($id){
    global $conDB;
    $query = "SELECT ownerid FROM hotel WHERE id = '$id'";
    $sql = mysqli_query($conDB, $query);

    if ($sql) {
        $data = mysqli_fetch_assoc($sql);
        return $data['ownerid'];
    } else {
        return 0;
    }
}

function deleteHotelDetails($id) {
    global $conDB;
    $id = mysqli_real_escape_string($conDB, $id);
    $query = "DELETE FROM hotel WHERE id = '$id'";
    $sql = mysqli_query($conDB, $query);
    if ($sql) {
        return true; 
    } else {
        return false; 
    }
}


function allTotalNumber(){
    global $conDB;
    $data = array();
    $query = "SELECT * FROM hotel";
    $sql = mysqli_query($conDB, $query);
    if($sql){
        $noOfHotels = mysqli_num_rows($sql);
    }
    $query2="SELECT * FROM user";
    $sql2 = mysqli_query($conDB, $query2);
    if($sql2){
        $noOfusers = mysqli_num_rows($sql2);
    }
  $data = [
        'noOfHotels' => $noOfHotels,
        'noOfusers' => $noOfusers
    ];
    return $data;
}

?>
