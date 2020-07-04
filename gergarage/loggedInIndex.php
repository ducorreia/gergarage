<?php
include("session.php");

?>
<!-- Page accessed after logged in -->
<!DOCTYPE html>
<html lang="en">
<title>The best solution to your vehicle</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ger's Garage</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Home</a>
                </li>

        <!-- If used to display a different nav to the adm and an ordinary user  -->
                <?php
        if($_SESSION['user_type'] == 'a') {
          echo '<li class="nav-item">';
          echo '  <a class="nav-link" href="timetable.php">Bookings</a>';
          echo '</li>';
          echo '<li class="nav-item">';
          echo '  <a class="nav-link" href="invoice.php">Invoice</a>';
          echo '</li>';
        }else{
         echo '<li class="nav-item">
            <a class="nav-link" href="appointment.php">Appointment</a>
          </li>';
          echo ' <li class="nav-item">
          <a class="nav-link" href="history.php">History</a>
        </li>'; }
      ?>

                <li class="nav-item">
                    <a class="nav-link" href="service.php">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="aboutUs.php">About us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signOut.php">Logout</a>
                </li>

            </ul>
        </div>
    </nav>
    <?php 
        include("header.php");
    ?>


</body>

<?php
  include("footer.php")
?>

</html>