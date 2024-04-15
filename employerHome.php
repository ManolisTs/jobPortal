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
                <h1 class="text-center text-primary"> the best candidate search platform!!</h1>
            </div>
        <div class="row mx-auto">
            <div class="d-flex flex-wrap justify-content-evenly mx-auto col-12 pt-5">
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">1</div>
                    <div class="card-body">
                        <h5 class="card-title">Navigate to Add Position</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">2</div>
                    <div class="card-body">
                        <h5 class="card-title">Add a candidate Position</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">3</div>
                    <div class="card-body">
                        <h5 class="card-title">Navigate to Find Candidates</h5>
                    </div>
                </div>
                <div class="card text-bg-primary mb-3 col-6 mr-2" style="max-width: 18rem;">
                    <div class="card-header mt-2 mx-auto rounded-circle">4</div>
                    <div class="card-body">
                        <h5 class="card-title">Click on button Find Candidates</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-auto">
            <div class="col-12 pt-5">
                <h1 class="text-center welcome-text">Press the button and find the ideal Candidate!!</h1>
            </div>
            <div class="col-12 pt-5 d-flex justify-content-center">
                <button id="find_candidates" class="btn btn-primary mx-auto" type="button">Find Candidates</button>
            </div>
            <div class="col-10 pt-5 d-flex justify-content-center mx-auto">
                <table id="candidateTable" class="table table-primary table-hover table-bordered" style="display: none;">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Category</th>
                            <th>Town</th>
                            <th>Experience (years)</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody id="candidateList">
                        <!-- Candidate profiles will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    
    <!-- Bootstrap Bundle with Popper.js (for Bootstrap JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function(){
            $("#find_candidates").click(function(){
                $.ajax({
                    url: 'fetch_candidates.php', // Check this path
                    type: 'GET',
                    success: function(response){
                        var candidates = JSON.parse(response);
                        var candidateList = $("#candidateList");
                        candidateList.empty();

                        for (var jobId in candidates) {
                            var jobCandidates = candidates[jobId];
                            jobCandidates.forEach(function(candidate){
                                var row = $("<tr>");
                                row.append($("<td>").text(candidate.candidate_name));
                                row.append($("<td>").text(candidate.candidate_category));
                                row.append($("<td>").text(candidate.candidate_town));
                                row.append($("<td>").text(candidate.candidate_years));
                                candidateList.append(row);
                            });
                        }

                        $("#candidateTable").show();
                    },
                    error: function(xhr, status, error){
                        console.error('Error fetching candidates:', error);
                    }
                });
            });
        });

    </script>

</body>
</html>