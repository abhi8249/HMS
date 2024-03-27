<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid navbarsec">
    <a class="navbar-brand" href="#" style="width: 5%;"><img src="../assets/image/icon2.png" alt="" srcset="" style="width:100%;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'active'; ?>">
          <a class="nav-link" aria-current="page" href="../dashboard.php">Home</a>
        </li>
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF']) == 'hoteldetail.php') echo 'active'; ?>">
          <a class="nav-link" href="../hoteldetail.php">Hotel Details</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
        <span><?php echo "<h3 style='padding: 5px; margin: 0 6px;'>" . $_SESSION['username'] . "</h3>"; ?></span>
      </form>
      <div class="logout" style="width: 3%;" id="logout"><img src="../assets/image/power-off.png" style="width: 100%; padding: 7px;" alt="" srcset=""></div>
    </div>
  </div>
</nav>
