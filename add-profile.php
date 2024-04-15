<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("CandidateController.php");

    $user_data = check_login($con);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_candidate"])) {

        $candidateController = new CandidateController($con);

        $candidate = new Candidate(
            $user_data['user_id'],
            $_POST['candidate_name'],
            $_POST['candidate_category'],
            $_POST['candidate_town'],
            $_POST['candidate_years'],
            isset($_POST['candidate_driver_license']) ? 1 : 0,
            isset($_POST['candidate_travel']) ? 1 : 0
        );

        $result = $candidateController->addCandidate($candidate);

        if($result) {
            $inserted_candidate_id = $result;
        
            $query = "select * from candidate_profile where candidate_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $inserted_candidate_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $candidate_data = $result->fetch_assoc();
        
            } else {
                echo '<script>alert("No candidate information found in the database!")</script>';
            }
        } else {
            echo '<script>alert("Something went wrong!")</script>';
        }
    }
?>
<?php
    include("./navmenu/header.php");
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
                <h1 class="text-center text-primary">Add or Update Candidate Profile</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-5">
                <form id="add_profile_form" action="add-profile.php" class="col-xl-5 col-lg-6 col-md-8 col-sm-9 col-10" method="post">
                    <div class="form-group">
                        <label class="form-label" for="candidate_name">Candidate Full Name:</label>
                        <input type="text" name="candidate_name" id="candidate_name" placeholder="Type your full name" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="candidate_category">Candidate Preferred Job Category:</label>
                        <select name="candidate_category" id="candidate_category" class="form-control">
                            <option value="">Please choose a category</option>
                            <option value="engineer">Engineer</option>
                            <option value="logistics">Logistics</option>
                            <option value="science">Science</option>
                            <option value="constructor">Constructor</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="candidate_town">Candidate Preferred Town to Work:</label>
                        <input type="text" name="candidate_town" id="candidate_town" placeholder="Type your preferred town to work" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="candidate_years">Candidate Experience Years:</label>
                        <input type="number" name="candidate_years" id="candidate_years" placeholder="Type your years of work experience" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group pl-4">
                        <input type="checkbox" name="candidate_driver_license" id="candidate_driver_license" class="form-check-input" />
                        <label class="form-check-label" for="candidate_driver_license">I have a Driver License</label>
                    </div>
                    <div class="form-group pl-4">
                        <input type="checkbox" name="candidate_travel" id="candidate_travel" class="form-check-input" />
                        <label class="form-check-label" for="candidate_travel">I am able to travel for job</label>
                    </div>
                    <input id="button" type="submit" name="add_candidate" class="btn btn-primary btn-block mb-4 col-12" value="Add" />
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-2">
                <div id="view_profile" class="col-12 d-flex justify-content-center pt-2" style="display: none;"></div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        alert("Profile added successfully");
        var viewProfileElement = document.getElementById("view_profile");
        var addFormElement = document.getElementById("add_profile_form");
        if (viewProfileElement) {
            addFormElement.style.display = 'none';
            viewProfileElement.style.display = "block";
            viewProfileElement.innerHTML = "<div class='card col-4 mb-5' style='background-color: lightsalmon;'>" +
                    "<div class='card-body'>" +
                    "<h2 class='card-title'>Candidate Profile</h2>" +
                    "<p class='card-text'>Name: <?php echo $candidate_data['candidate_name']; ?></p>" +
                    "<p class='card-text'>Category: <?php echo $candidate_data['candidate_category']; ?></p>" +
                    "<p class='card-text'>Town: <?php echo $candidate_data['candidate_town']; ?></p>" +
                    "<p class='card-text'>Experience Years: <?php echo $candidate_data['candidate_years']; ?></p>" +
                    "<p class='card-text'>Driver License: <?php echo ($candidate_data['candidate_driver_license'] ? 'Yes' : 'No'); ?></p>" +
                    "<p class='card-text'>Travel for Job: <?php echo ($candidate_data['candidate_travel'] ? 'Yes' : 'No'); ?></p>" +
                "</div>" +
            "</div>";
        }
    </script>
</body>
</html>