<!-- Session login -->
<?php
include('config.php');
session_start();

$user_check = $_SESSION['id_user'];

$ses_sql = mysqli_query($link, "select id_user from user where id_user = $user_check");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$count = mysqli_num_rows($ses_sql);

$login_session = $row['id_user'];

if (!isset($_SESSION['id_user'])) {
   header("Location:signIn.php");
   die();
}

?>