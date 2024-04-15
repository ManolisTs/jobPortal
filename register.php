<?php
    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $user_type = isset($_POST['user_type']) ? 1 : 0;

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

            $user_id = random_num(20);
            $query = "insert into users (user_id,user_type,user_name,password) values ('$user_id','$user_type','$user_name','$password')";

            mysqli_query($con, $query);

            header("Location: app.php");
            die;

        } else {
            echo '<script>alert("Please enter valid information!")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εργασιούλης Α.Ε.</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- My CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 pt-5">
                <h1 class="text-center text-primary">Are you a Company or an Employer?</h1>
                <h2 class="text-center text-success">Register to add your Job Positions!!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-5">
                <form autocomplete="off" class="col-xl-3 col-md-6" method="post">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="user_name">Username</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Enter your Username" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group pl-4">
                        <input type="checkbox" id="user_type" name="user_type" class="form-check-input" />
                        <label class="form-check-label" for="user_type"> I am an employer</label>
                    </div>
                    <input id="button" type="submit" class="btn btn-primary btn-block mb-4 col-12" value="Sign In" />
                    <div class="text-center">
                        <p>Already a member? <a href="app.php">Log in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>