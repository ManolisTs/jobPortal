<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("JobController.php");

    $user_data = check_login($con);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_job"])) {

        $jobController = new JobController($con);

        $job = new Job(
            $user_data['user_id'],
            $_POST['job_name'],
            $_POST['job_category'],
            $_POST['company_name'],
            $_POST['job_town'],
            $_POST['date_posted'],
            $_POST['job_years'],
            $_POST['job_desc'],
            $_POST['job_res'],
            $_POST['job_req'],
            isset($_POST['job_driver_license']) ? 1 : 0,
            isset($_POST['job_travel']) ? 1 : 0
        );

        $result = $jobController->addJob($job);

        if($result) {
            $inserted_job_id = $result;
        
            $query = "select * from job_position where job_id = ?";
            $stmt = $con->prepare($query);
            $stmt->bind_param("s", $inserted_job_id);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                $job_data = $result->fetch_assoc();
            } else {
                echo '<script>alert("No job information found in the database!")</script>';
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
                <h1 class="text-center text-primary">Add a new Job Position</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-5">
                <form id="add_job_form" action="add-job.php" class="col-xl-5 col-lg-6 col-md-8 col-sm-9 col-10" method="post">
                    <div class="form-group">
                        <label class="form-label" for="job_name">Job Name:</label>
                        <input type="text" name="job_name" id="job_name" placeholder="Type the job name" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="job_category">Job Category:</label>
                        <select name="job_category" id="job_category" class="form-control">
                            <option value="">Please choose a category</option>
                            <option value="engineer">Engineer</option>
                            <option value="logistics">Logistics</option>
                            <option value="science">Science</option>
                            <option value="constructor">Constructor</option>
                            <option value="food">Food</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="company_name">Company Name:</label>
                        <input type="text" name="company_name" id="company_name" placeholder="Type the employer name" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job_town">Town:</label>
                        <input type="text" name="job_town" id="job_town" placeholder="Type the job position" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="date_posted">Date Posted:</label>
                        <input type="date" name="date_posted" id="date_posted" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job_years">Job Experience Years:</label>
                        <input type="number" name="job_years" id="job_years" placeholder="Type the job experience needed for this job position" autocomplete="false" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job_desc">Job Description</label>
                        <textarea name="job_desc" name="job_desc" id="job_desc" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job_res">Job Responsibilities:</label>
                        <textarea name="job_res" name="job_res" id="job_res" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="job_req">Job Requirements:</label>
                        <textarea name="job_req" name="job_req" id="job_req" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group pl-4">
                        <input type="checkbox" name="job_driver_license" id="job_driver_license" class="form-check-input" />
                        <label class="form-check-label" for="job_driver_license">Driver License needed</label>
                    </div>
                    <div class="form-group pl-4">
                        <input type="checkbox" name="job_travel" id="job_travel" class="form-check-input" />
                        <label class="form-check-label" for="job_travel">Candidate must be able to travel for job</label>
                    </div>
                    <input id="button" type="submit" name="add_job" class="btn btn-primary btn-block mb-4 col-12" value="Add" />
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center pt-2">
                <div id="view_job" class="col-12 d-flex justify-content-center pt-5" style="display: none;"></div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        var viewJobElement = document.getElementById("view_job");
        var addJobFormElement = document.getElementById("add_job_form");
        if (viewJobElement) {
            addJobFormElement.style.display = "none";
            viewJobElement.style.display = "block";
            viewJobElement.innerHTML = "<div class='card col-4 mb-5' style='background-color: lightsalmon;'>" +
                    "<div class='card-body'>" +
                    "<h2 class='card-title'>Job Position</h2>" +
                    "<p class='card-text'>Name: <?php echo htmlspecialchars($job_data['job_name']); ?></p>" +
                    "<p class='card-text'>Category: <?php echo htmlspecialchars($job_data['job_category']); ?></p>" +
                    "<p class='card-text'>Company Name: <?php echo htmlspecialchars($job_data['company_name']); ?></p>" +
                    "<p class='card-text'>Town: <?php echo htmlspecialchars($job_data['job_town']); ?></p>" +
                    "<p class='card-text'>Date Posted: <?php echo htmlspecialchars($job_data['date_posted']); ?></p>" +
                    "<p class='card-text'>Experience Years: <?php echo htmlspecialchars($job_data['job_years']); ?></p>" +
                    "<p class='card-text'>Job Description: <?php echo htmlspecialchars($job_data['job_desc']); ?></p>" +
                    "<p class='card-text'>Job Responsibilities: <?php echo htmlspecialchars($job_data['job_res']); ?></p>" +
                    "<p class='card-text'>Job Requirements: <?php echo htmlspecialchars($job_data['job_req']); ?></p>" +
                    "<p class='card-text'>Driver License: <?php echo ($job_data['job_driver_license'] ? 'Yes' : 'No'); ?></p>" +
                    "<p class='card-text'>Travel for Job: <?php echo ($job_data['job_travel'] ? 'Yes' : 'No'); ?></p>" +
                "</div>" +
            "</div>";
        }
    </script>

</body>
</html>