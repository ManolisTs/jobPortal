<?php
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
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
                        <h5 class="card-title">Navigate to Add Profile</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">2</div>
                    <div class="card-body">
                        <h5 class="card-title">Add Your Profile</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">3</div>
                    <div class="card-body">
                        <h5 class="card-title">Navigate to Find Job</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">4</div>
                    <div class="card-body">
                        <h5 class="card-title">Click on button Find Job</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-auto">
            <div class="col-12 pt-5">
                <h1 class="text-center welcome-text">Press the button and find the ideal Job Position!!</h1>
            </div>
            <div class="col-12 pt-5 d-flex justify-content-center">
                <button id="find_job" class="btn btn-primary mx-auto" type="button">Find Job</button>
            </div>
            <div class="col-10 pt-5 d-flex justify-content-center mx-auto">
                <table id="jobTable" class="table table-primary table-hover table-bordered" style="display: none;">
                    <thead>
                        <tr>
                            <th>Company</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Town</th>
                        </tr>
                    </thead>
                    <tbody id="jobList">
                        <!-- Job positions will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            $("#find_job").click(function(){
                $.ajax({
                    url: 'fetch_jobs.php',
                    type: 'GET',
                    success: function(response){
                        var jobs = JSON.parse(response);
                        var jobList = $("#jobList");
                        jobList.empty();
                        jobs.forEach(function(job){
                            var row = $("<tr>");
                            row.append($("<td>").text(job.company_name));
                            row.append($("<td>").text(job.job_name));
                            row.append($("<td>").text(job.job_category));
                            row.append($("<td>").text(job.job_town));
                            $("#jobTable tbody").append(row);
                        });
                        $("#jobTable").show();
                    },
                    error: function(xhr, status, error){
                        console.error('Error fetching job positions:', error);
                    }
                });
            });
        });
    </script>


</body>
</html>