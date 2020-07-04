<?php
    include('session.php');
//Query to retrieve data from booking using id reference
    $stmt = mysqli_prepare($link,"SELECT b.`id_booking` "
        ."    ,b.`date` "
        ."    ,b.`timeslot` "
        ."    ,u.`fname` "
        ."    ,u.`sName` "
        ."    ,u.`mNumber` "
        ."    ,v.`type` "
        ."    ,v.`make` "
        ."    ,v.`vehicle_engine_type` "
        ."    ,m.`type_maintenance` "
        ."    ,m.`cost` "
        ."    ,m.`description` "
        ."    ,s.`description` "
        ."    ,s.`cost` "
        ."    ,s.`quantity` "
        ."    ,me.`name` "
        ."FROM booking b "
        ."LEFT JOIN user u "
        ."    ON u.id_user = b.user_id_user "
        ."LEFT JOIN vehicle v "
        ."    ON v.id_vehicle = b.vehicle_id_vehicle "
        ."LEFT JOIN maintenance m "
        ."    ON m.id_maintenance = b.maintenance_id_maintenance "
        ."LEFT JOIN supply s "
        ."    ON s.maintenance_id_maintenance = m.id_maintenance "
        ."LEFT JOIN mechanic me "
        ."    ON me.id_mechanic = b.mechanic_id_mechanic "
        ."WHERE b.id_booking = ?; "
    );
    mysqli_stmt_bind_param($stmt,'i',$_GET['id_booking']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8"/>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
    <title></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Ger's Garage</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link" href="loggedInIndex.php">Home</a>
        </li>
      <li class="nav-item">
        <a class="nav-link" href="timetable.php">Bookings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Invoice</a>
      </li>
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
<form method="get">
<div class="simple-login-container p -3">
        <h2 class="text-center">Create an Invoice</h2>
        <div class="row ">
        
        <div class="col-sm-4 offset-sm-4 text-center form-group">
            <input type="number" class="form-control" placeholder="Enter your Booking ID " name="id_booking" required>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 offset-sm-4 text-center form-group">
            <input type="submit"  value="Submit"  class="btn bg-info btn-block"/>
        </div>
    </div>
    </form>

 <!--Show information-->
    <div class="container">
	<div class="main-center">
			<form method="post">

    <div class="row">
    <div class="col-4">
     <label for="">Booking ID</label>
      <input type="number" class="form-control" name="id_booking" value="<?php echo $row['id_booking'];?>" readonly/>
      </div>
     
    <div class="col-4">
     <label for="">Date</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['date'];?>" readonly/>
      </div>
     
      <div class="col-4">
     <label for="">Time</label>
      <input type="text" class="form-control" name="timeslot" value="<?php  echo $row['timeslot'];?>" readonly/>
      </div>
      </div>

      <div class="row">
    <div class="col-4">
     <label for="">First Name</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['fname'];?>" readonly/>
      </div>
          
    <div class="col-4">
     <label for="">Surname</label>
      <input type="text" class="form-control" name="date" value="<?php  echo $row['sName'];?>" readonly/>
      </div>
     
     
    <div class="col-4">
     <label for="">Mobile Number</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['mNumber'];?>" readonly/>
      </div>
      </div>

      <div class="row">
    <div class="col-4">
     <label for="">Type</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['type'];?>" readonly/>
      </div>
      
    <div class="col-4">
     <label for="">Make</label>
      <input type="text" class="form-control" name="date" value="<?php  echo $row['make'];?>" readonly/>
      </div>
          
    <div class="col-4">
     <label for="">Engine Type</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['vehicle_engine_type'];?>" readonly/>
      </div>
      </div>

      <div class="row">
    <div class="col-4">
     <label for="">Maintenance Type</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['type_maintenance'];?>" readonly/>
      </div>
    
           
    <div class="col-4">
     <label for="">Mechanic Name</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['name'];?>" readonly/>
      </div>

    <div class="col-4">
     <label for="">Cost</label>
      <input type="number" class="form-control" name="date" value="<?php echo $row['cost'];?>" readonly/>
      </div>

      </div>

      <div class="row">
      <div class="col-8">
     <label for="">Description</label>
      <input type="text" class="form-control" name="date" value="<?php echo $row['description'];?>" readonly/>
      </div>
    </div>
      
    </form>
   
</body>

<?php
  include("footer.php")
?>

</html>