<?php

session_start();

if (isset($_SESSION["userId"])) {
    header("location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>CoinCap</title>
    <link rel="icon" href="img/favicon-32x32.png" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/datatables.min.css" />
    <link rel="stylesheet" href="css/login.css" />
    <!-- Custom styles -->
</head>

<body>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emailexists") {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Email address is already in use, please sign in.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else if ($_GET["error"] == "userdoesnotexist") {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>User does not exist, please register first or use different account.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        } else if ($_GET["error"] == "wrongpassword") {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Wrong password, please try again.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }
    if (isset($_GET["message"])) {
        if ($_GET["message"] == "usercreated") {
            echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                <strong>User successfully created, please sign in now.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }
    ?>
    <div class="container" style="margin-top: 50px;">
        <a class="btn btn-blue-grey mb-2" href="index.php" role="button">Back to Home</a>
        <div class="row justify-content-center">
            <div class="container-custom" id="container">
                <div class="form-container sign-up-container">
                    <form action="php/sign_in_up_inc.php" method="post">
                        <h1>Create Account</h1>
                        <input type="text" placeholder="Name" name="name" />
                        <input type="email" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <button class=" btn btn-primary btn-rounded text-uppercase" type="submit" name="signUp">Sign Up</button>
                    </form>
                </div>
                <div class="form-container sign-in-container">
                    <form action="php/sign_in_up_inc.php" method="post">
                        <h1>Sign in</h1>
                        <input type="email" placeholder="Email" name="email" />
                        <input type="password" placeholder="Password" name="password" />
                        <button class="btn btn-primary btn-rounded text-uppercase" type="submit" name="signIn">Sign In</button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay bg-primary">
                        <div class="overlay-panel overlay-left">
                            <h1>Welcome Back!</h1>
                            <p>Sign in with your personal info.</p>
                            <button class="btn btn-outline-light rounded text-uppercase" id="sIn">Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Sign up</h1>
                            <p>To create your portfolio please enter your personal details and sign up.</p>
                            <button class="btn btn-outline-light rounded text-uppercase" id="sUp">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/b-1.6.5/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
<script type="text/javascript">
    const signUpButton = document.getElementById('sUp');
    const signInButton = document.getElementById('sIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

</html>