<?php
include '../function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $type = $_POST['type'];
   if($type == 'loadUserRegistrationForm'){
    $html = '
    <form action="" mrthod="POST" id="newRegistloginform">
    <h3 class="mb-5">Create An Account</h3>

    <div class="form-outline mb-4">
      <label class="form-label" for="email">Email</label>
      <input type="email" name="mail" id="email" class="form-control" required/>

    </div>

    <div class="form-outline mb-4">
    <label class="form-label" for="username">Username</label>
    <input type="text" name="userName" id="username" class="form-control" required />

  </div>

    <div class="form-outline row mb-4">
<div class="col-md-6">
      <label class="form-label"  for="password">Password</label>
      <input type="password" name="password" class="form-control" required/>
</div>
<div class="col-md-6">
    <label class="form-label"for="password">Confirm Password</label>
    <input type="password"  name="confirmPassword"   class="form-control" required/>
    </div>

  </div>


    <button class="btn btn-primary btn-lg" type="submit">Create</button>
    </form>

    ';
    echo $html;
   }
if($type=='checkLogin'){
    $mail = $_POST['username'];
    $password = $_POST['password'];
    $result = checkLogin($mail,$password);

    if($result){
        echo '1';
        $_SESSION['login']=1;

    }
    else{
        echo '0';
    }
}

if($type == 'newUserRegister'){
  $mail = $_POST['mail'];
  $username = $_POST['userName'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  if(($mail !='') ||($username != '') || ($password !='') || ($confirmPassword != '')){
    if($password != $confirmPassword){
      $data = [
        'status' => '0',
        'msg' => 'Password must be same'
    ]; 
    }
    else{
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $result = setNewUserDetails($mail,$username,$hashed_password);
      if($result){
        $data = [
          'status' => '1',
          'msg' => 'Thank you'
      ]; 
      }else{
        $data = [
          'status' => '0',
          'msg' => 'Username already exist'
      ];
      }
    }
  }else{
    $data = [
      'status' => '0',
      'msg' => 'All field are required'
  ];  
  }
 echo json_encode($data);
}
if($type=='logout'){
  logout();
}

}
?>