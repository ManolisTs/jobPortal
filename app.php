<?php
    session_start();

    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

            $query = "select * from users where user_name = '$user_name' limit 1";

            $result = mysqli_query($con, $query);

            if($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                $user_type = $user_data['user_type'];
                
                $_SESSION['user_id'] = $user_data['user_id'];
                
                if($user_data["password"] == $password) {
                    $_SESSION['user_type'] = $user_type; // Set the user_type session variable
                    
                    if($user_type == 0) {
                        header("Location: candidateHome.php");
                        die;
                    } else {
                        header("Location: employerHome.php");
                        die;
                    }
                } else {
                    echo '<script>alert("Wrong username or password!")</script>';
                }
            }
            

            echo '<script>alert("Wrong username or password!")</script>';
        } else {
            echo '<script>alert("Missing username or password!")</script>';
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
                    <h1 class="text-center welcome-text">Welcome to Ergasioulis</h1>
                </div>
                <div class="col-12">
                    <h1 class="text-center text-primary"> the best job search platform!!</h1>
                </div>
            <div class="row mx-auto">
                <div class="d-flex flex-wrap justify-content-evenly mx-auto col-12 pt-5">
                    <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                        <div class="card-header mt-2 mx-auto rounded-circle">1</div>
                        <div class="card-body">
                            <h5 class="card-title">Sign In</h5>
                        </div>
                    </div>
                    <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                        <div class="card-header mt-2 mx-auto rounded-circle">2</div>
                        <div class="card-body">
                            <h5 class="card-title">Log In</h5>
                        </div>
                    </div>
                    <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                        <div class="card-header mt-2 mx-auto rounded-circle">3</div>
                        <div class="card-body">
                            <h5 class="card-title">Find Job/Candidate</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pt-5">
                <h1 class="text-center text-primary">Are you a Candidate or an Employer?</h1>
                <h2 class="text-center text-success">Login and add or find a new Job Position!!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-5">
                <form action="app.php" autocomplete="off" class="col-xl-3 col-md-6" method="post">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="user_name">Username</label>
                        <input type="text" id="user_name" name="user_name" placeholder="Enter your Username" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your Password" autocomplete="false" class="form-control" />
                    </div>
                    <input id="button" type="submit" class="btn btn-primary btn-block mb-4 col-12" value="login" />
                    <div class="text-center">
                        <p>Not a member? <a href="register.php">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>