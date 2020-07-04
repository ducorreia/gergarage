<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8" />

<!-- Service page -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Ger's Garage</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="signIn.php">Sign in</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="signUp.php">Sign up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="aboutUs.php">About us</a>
            </li>
        </ul>
    </div>
</nav>

<?php
   include('header.php');
?>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand">
        <h1>Service</h1>
    </a>
</nav><br>
<!-- Cards -->
<div class="container-fluid">


    <div class="card" style="width: 82rem;">
        <div class="card-body">


            <div class="card-group">
                <div class="card">
                    <img class="card-img-top" src="img/m4.jpg" height="210">
                    <div class="card-body">
                        <h5 class="card-title">Major Service 100€</h5>
                        <p class="card-text">
                            <p>includes:
                                <p>✔ oil change
                                    <p>✔ oil filter
                                        <p>✔ 10 point check
                                            <p>✔ top up fluids
                                                <p>✔ air filter</p>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="img/m2.jpg" height="210">
                    <div class="card-body">
                        <h5 class="card-title">Annual Service 200€</h5>
                        <p class="card-text">
                            <p>includes:
                                <p>✔ oil change
                                    <p>✔ oil filter
                                        <p>✔ 10 point check
                                            <p>✔ top up fluids
                                                <p>✔ air filter
                                                    <p>✔ spark plug
                                                        <p>✔ reset service light
                                                            <p>✔ fuel filter
                                                                <p>✔ full cleaning</p>

                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="img/m3.jpg" height="210">
                    <div class="card-body">
                        <h5 class="card-title">Repair 50-100€</h5>
                        <p class="card-text">
                            <p>includes:
                                <p>✔ parts replacing
                                    <p>✔ check up
                                        <p>✔ general cleaning</p>
                    </div>
                </div>
                <div class="card">
                    <img class="card-img-top" src="img/m1.jpg" height="210">
                    <div class="card-body">
                        <h5 class="card-title">Major Repair 100-150€</h5>
                        <p class="card-text">
                            <p>includes:
                                <p>✔ parts replacing
                                    <p>✔ check up
                                        <p>✔ general cleaning</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

</body>

</html>

<?php
   include('footer.php');
?>