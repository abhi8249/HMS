<?php 
include 'include/function.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include './screen/link.php' ?>
</head>
<body>
  
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem; background: #a3b8b9e0;">
          <div class="card-body p-5 text-center Loginform" id="formContainer">
            <form action="" id="loginform">
         
            <h3 class="mb-5">User Sign in</h3>

            <div class="form-outline mb-4">
              <label class="form-label" for="username">Username</label>
              <input type="text" id="username" name="username" class="form-control" required/>
        
            </div>

            <div class="form-outline mb-4">
              <label class="form-label" for="password">Password</label>
              <input type="password" name="password" id="typePasswordX-2" class="form-control" required/>
             
            </div>

            <div class="form-check d-flex justify-content-between mb-4">
                <div class="remmeberPass">
                    <input class="form-check-input" type="checkbox" value="" id="remPass" required/>
                    <label class="form-check-label mx-2" for="remPass"> Remember password </label>
                </div>    
                <div class="createnewacc">
                    <a href="javascript:void(0)" id="createAnAccount">Create an Account</a>
                </div>
            </div>

            <button class="btn btn-primary btn-lg" type="submit">Login</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
<script>

$(document).ready(function() {
    $(document).on('click', '.loginli', function() {
    $('.loginli').removeClass('active');
    $(this).addClass('active');

});
$(document).on('click','#createAnAccount',function(){

    $.ajax({
        url:'include/ajax/login.php',
        type:'POST',
        data:{'type':'loadUserRegistrationForm'},
        success:function(data){
        $('#formContainer').html(data);
        },
        error: function(error){
            console.log(error)
        }
    });
});

$(document).on('submit', '#loginform', function(e) {
    e.preventDefault();
    var formData = $(this).serialize(); 
    formData += '&type=checkLogin'; 
    $.ajax({
        url: 'include/ajax/login.php',
        type: 'POST',
        data: formData,
        success: function(data) {
            if(data.trim()=='1'){
                window.location.href = "dashboard.php";
            }else{
                sweetAlert('Sorry Wrong Password!','Error');
            }
            
        },
        error: function(xhr, status, error) {
            console.log(error); 
        }
    });
});

$(document).on('submit', '#newRegistloginform', function(e) {
    e.preventDefault();
    var formData = $(this).serialize(); 
    formData += '&type=newUserRegister'; 
    $.ajax({
        url: 'include/ajax/login.php',
        type: 'POST',
        data: formData,
        success: function(response) {
            console.log(response);
            var res = JSON.parse(response);
            console.log(res.status);
            if(res.status === '1'){ 
                console.log('ok');
                sweetAlert(res.msg,'success'); 
            }
            else{
                console.log('no');
                sweetAlert(res.msg,'error');
            }              
        },
        error: function(xhr, status, error) {
            console.log(error); 
        }
    });
});


});

</script>
</body>
</html>