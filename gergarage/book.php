<?php
include('session.php');



if(isset($_GET['date'])){
    $date = $_GET['date'];
}

if(isset($_POST['submit'])){
    $name = $_POST['fname'];
    $sName = $_POST['sName'];
    echo '<script type="text/javascript">alert("'.$sName.'");</script>';

    $email = $_POST['email'];
    $timeslot = $_POST['timeslot'];
    $stmt = $link->prepare("INSERT INTO booking (name, timeslot, email, date) VALUES (?,?,?,?)");
    $stmt->bind_param('ssss', $name, $timeslot, $email, $date);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Booking Successfull</div>";
    $stmt->close();
    $link->close();
}



$duration = 40;
$cleanup=0;
$start ="10:00";
$end= "18:00";

function timeslots($duration,$cleanup,$start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval ("PT".$duration."M");
    $cleanupInterval = new DateInterval ("PT".$cleanup."M");
    $slots = array();

    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
        break;

        }
        $slots[] = $intStart->format("H:iA")."-".$endPeriod->format("H:iA");

    }
    return $slots;
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
    <div class="container p-3">
        <h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1>
        <hr>
        <div class="row">
            <form action="register.php" method="post">
                <div class="col-md-12">
                    <?php echo isset ($msg)?$msg:"";?>
                </div>
                <?php
                        $timeslots = timeslots($duration,$cleanup,$start, $end);
                        foreach($timeslots as $ts){
                    ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <input type="submit" name="timeslot" class="btn btn-success book" value="<?php echo $ts;?>" />
                    </div>
                </div>
                <?php } ?>
                <input type="hidden" name="date" value="<?php echo $date; ?>" />
            </form>
        </div>
    </div>
    </div>
    </div>





    <!--Text box displayed when clicked on a timeslot-->
    <script>
    $(".book").click(function() {
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#timeslot").val(timeslot);
        $("#myModal").modal("show");
    })
    </script>

</body>

<?php

    include("footer.php")
?>

</html>