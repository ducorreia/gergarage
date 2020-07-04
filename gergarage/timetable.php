<!-- Used to book the alocate the mechanics to each service -->
<!-- Accessed by the adm -->
<?php
    include('session.php');

    if (array_key_exists('id_mechanic', $_POST)) {
        $bookings_mechanics = array_map(function ($a, $b) {
            return ["id_booking"=>$a,"id_mechanic"=>$b];
        }, $_POST['id_booking'], $_POST['id_mechanic']);
        
        foreach ($bookings_mechanics as $booking_mechanic) {
            if (empty(trim($booking_mechanic['id_mechanic']))) {
                continue;
            }
            $id_booking = mysqli_real_escape_string($link, $booking_mechanic['id_booking']);
            $id_mechanic = mysqli_real_escape_string($link, $booking_mechanic['id_mechanic']);
            
            $stmt = "UPDATE booking b SET b.mechanic_id_mechanic = $id_mechanic WHERE b.mechanic_id_mechanic IS NULL AND b.id_booking = $id_booking; ";

            if (mysqli_query($link, $stmt)) {
                // success
            } else {
                // error
                echo "<script>alert(\"ERROR: Could not able to execute $stmt. " . mysqli_error($link) . "\")</script>";
            }
        }
    }
 
    $stmt = mysqli_prepare(
        $link,
        "SELECT b.`id_booking` "
        ."    ,b.`date` "
        ."    ,b.`timeslot` "
        ."    ,b.`comment` "
        ."    ,u.`id_user` "
        ."    ,u.`fname` "
        ."    ,u.`sName` "
        ."FROM booking b "
        ."INNER JOIN user u "
        ."    ON u.`id_user` = b.`user_id_user` "
        ."WHERE b.`mechanic_id_mechanic` IS NULL; "
    );
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $rows[] = $row;
    }
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title></title>

    <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>

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
                    <a class="nav-link disabled" href="#">Bookings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="invoice.php">Invoice</a>
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
   include('header.php');
?>
    <form method="post">
        <table>
            <tr>
                <th>id_booking</th>
                <th>date</th>
                <th>timeslot</th>
                <th>comment</th>
                <th>id_user</th>
                <th>fname</th>
                <th>sName</th>
                <th>mechanic</th>
            </tr>

            <?php
    $i = 0;
    foreach ($rows as $row) {
        echo '<tr>';
        echo '    <td>'.$row['id_booking'].'</td>';
        echo '    <td>'.$row['date'].'</td>';
        echo '    <td>'.$row['timeslot'].'</td>';
        echo '    <td>'.$row['comment'].'</td>';
        echo '    <td>'.$row['id_user'].'</td>';
        echo '    <td>'.$row['fname'].'</td>';
        echo '    <td>'.$row['sName'].'</td>';
        echo '    <td>';
        echo '        <input type="hidden" name="id_booking['.$i.']" value="'.$row['id_booking'].'" />';
        echo '        <select class="form-control" name="id_mechanic['.$i.']" id="id_mechanic">';
        echo '            <option></option>';
        echo '            <option value="1">Aric</option>';
        echo '            <option value="2">Pamela</option>';
        echo '            <option value="3">Guadalupe</option>';
        echo '            <option value="4">Glen</option>';
        echo '            <option value="5">Andre</option>';
        echo '            <option value="6">Korbin</option>';
        echo '            <option value="7">Rosanna</option>';
        echo '            <option value="8">Roma</option>';
        echo '            <option value="9">Angeline</option>';
        echo '            <option value="10"Cristina></option>';
        echo '        </select>';
        echo '    </td>';
        echo '</tr>';
        $i++;
    }
    ?>

        </table>

        <input type="submit" value="Submit" />
    </form>
   
</body>

<?php
  include("footer.php")
?>
</html>