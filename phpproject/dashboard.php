<?php
include 'include/function.php';
checkLoginAuth();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include './screen/link.php' ?>
</head>
</head>
<body>
    <?php include 'screen/navbar.php';?>
    <section class="card-section">
    <div class="container" style="margin:15px auto;">
         <div class="row cardbox">
            <div class="col item">
                Number of Hotels <?php echo allTotalNumber()['noOfHotels']?>
            </div>
            <div class="col item">
                No of users <?php echo allTotalNumber()['noOfusers']?>
            </div>
            <div class="col item">
                 Revenue
            </div>
        </div>
  </div>
    </section>
    

</body>
</html>