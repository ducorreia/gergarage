<?php
include('session.php');


if(array_key_exists('type', $_POST)) { 
    $type = mysqli_real_escape_string($link, $_POST['type']);
    $make = mysqli_real_escape_string($link, $_POST['make']);
    $license = mysqli_real_escape_string($link, $_POST['license']);
    $engine_type = mysqli_real_escape_string($link, $_POST['engine_type']);

    $sql = "INSERT INTO `vehicle` ("
    ."    `type`"
    ."    ,`make`"
    ."    ,`license_number`"
    ."    ,`vehicle_engine_type`"
    ."    ,`status`"
    ."    ) "
    ."VALUES ("
    ."    '$type'"
    ."    ,'$make'"
    ."    ,'$license'"
    ."    ,'$engine_type'"
    ."    ,'B'"
    ."    );";

    if(mysqli_query($link, $sql)){
        // Success
        $id_vehicle = mysqli_insert_id($link);
      
    } else{
        // error
        echo "<script>alert(\"ERROR: Could not able to execute $sql. " . mysqli_error($link) . "\")</script>";
    }
    
    
    $date = mysqli_real_escape_string($link, $_POST['date']);
    $time = mysqli_real_escape_string($link, $_POST['time']);
    $comment = mysqli_real_escape_string($link, $_POST['comment']);
    $user_id = mysqli_real_escape_string($link, $_SESSION['id_user']);
    $maintenance_id = mysqli_real_escape_string($link, $_POST['service_type']);
    
    $sql = "INSERT INTO `booking` ("
    ."    `date`"
    ."    ,`timeslot`"
    ."    ,`comment`"
    ."    ,`user_id_user`"
    ."    ,`maintenance_id_maintenance`"
    ."    ,`vehicle_id_vehicle`"
    ."    ) "
    ."VALUES ("
    ."    '$date'"
    ."    ,'$time'"
    ."    ,'$comment'"
    ."    ,$user_id"
    ."    ,$maintenance_id"
    ."    ,$id_vehicle"
    .");";
    
    if(mysqli_query($link, $sql)){
        // Success
        echo "<script>alert('booked successfuly');</script>";
        echo "<script>window.location.replace('./loggedInIndex.php');</script>";
        
        //header("Location:loggedInIndex.php");
    } else{
        // error
        echo "<script>alert(\"ERROR: Could not able to execute $sql. " . mysqli_error($link) . "\")</script>";
    }
    
    mysqli_close($link);
}

?>


<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />


<head>
    <div id="interface">

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
                <li class="nav-item ">
                    <a class="nav-link" href="loggedInIndex.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="appointment.php">Appointment</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">History</a>
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
    <!-- Form to make a booking -->
    <div class="container">
        <div class="main-login main-center">
            <form method="post">
                <div class="form-row">
                    <div class="col-4">
                        <label for="">Name</label>
                        <input type="name" class="form-control" name="fname"
                            value="<?php echo $_SESSION['user_name']; ?>" />
                    </div>

                    <div class="col">
                        <label for="">Surname</label>
                        <input type="name" class="form-control" name="sName"
                            value="<?php echo $_SESSION['user_surname']; ?>" readonly />

                    </div>
                    <div class="col">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="<?php echo $_SESSION['user_email']; ?>" readonly />

                    </div>
                    <div class="col">
                        <label for="">Date</label>
                        <input type="date" class="form-control" name="date"
                            value="<?php echo date('Y-m-d', strtotime($_POST['date'])); ?>" readonly />

                    </div>
                    <div class="col">
                        <label for="">Time</label>
                        <input type="text" class="form-control" name="time" value="<?php echo $_POST['timeslot']; ?>"
                            readonly />

                    </div>
                </div>



                <div class="form-group">
                    <label for="make">Make</label>
                    <select class="form-control" id="make" name="make" onchange="ChangeVehicleList()">
                        <option value="">-- Vehicle --</option>
                        <option value="TOYOTA">Toyota</option>
                        <option value="VOLVO">Volvo</option>
                        <option value="VOLKSWAGEN">Volkswagen</option>
                        <option value="BMW">BMW</option>

                    </select>
                    <br>

                    <label for="type">Type</label>
                    <select class="form-control" name="type" id="type" required>
                    </select>
                    <br>

                    <label for="engine_type">Engine Type</label>
                    <select class="form-control" name="engine_type" id="engine_type">
                        <option>Diesel</option>
                        <option>Petrol</option>
                        <option>Hybrid</option>
                        <option>Eletric</option>
                    </select>
                    <br>

                    <div class="form-group">
                        <label for="license">License:</label>
                        <input name="license" type="license" class="form-control" placeholder="Enter License number"
                            id="license" required>
                    </div>
                    <br>


                    <label for="service_type">Service Type</label>
                    <select class="form-control" name="service_type" id="service_type" required>
                        <option></option>
                        <option value="1">Annual Service</option>
                        <option value="2">Major Service</option>
                        <option value="3">Repair / Fault</option>
                        <option value="4">Major Repair</option>
                    </select>
                    <br>

                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" name="comment" rows="3" id="comment"></textarea>
                    </div>

                    <button name="reg_vehicle" type="submit" class="btn btn-primary">Register Vehicle</button>
                </div>



            </form>
        </div>
    </div>
</body>

<script>
var vehiclesAndModels = {};
vehiclesAndModels['TOYOTA'] = ['Allion', 'Estima', 'Echo'];
vehiclesAndModels['VOLVO'] = ['V70', 'XC60', 'XC90'];
vehiclesAndModels['VOLKSWAGEN'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
vehiclesAndModels['BMW'] = ['M6', 'X5', 'Z3'];

function ChangeVehicleList() {
    var vehicleList = document.getElementById("make");
    var modelList = document.getElementById("type");
    var selectVehicle = vehicleList.options[vehicleList.selectedIndex].value;
    while (modelList.options.length) {
        modelList.remove(0);
    }
    var vehicles = vehiclesAndModels[selectVehicle];
    if (vehicles) {
        var i;
        for (i = 0; i < vehicles.length; i++) {
            var vehicle = new Option(vehicles[i], vehiclesAndModels[i]);
            modelList.options.add(vehicle);
        }
    }
}
</script>


</body>

<?php
  include("footer.php")
?>

</html>