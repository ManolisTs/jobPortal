<?php
session_start();

include("connection.php");

$user_id = $_SESSION['user_id'];

// Fetch job positions added by the employer based on user_id
$query = "SELECT * FROM job_position WHERE job_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$job_positions = [];

while ($row = $result->fetch_assoc()) {
    $job_id = $row['job_id'];
    $job_category = $row['job_category'];
    $job_town = $row['job_town'];
    $job_years = $row['job_years'];
    $job_driver_license = $row['job_driver_license'];
    $job_travel = $row['job_travel'];

    // Fetch candidate profiles based on job position attributes
    $query = "SELECT * FROM candidate_profile WHERE candidate_category = ? AND candidate_town = ? AND candidate_years >= ?";

    if ($job_driver_license == 1) {
        $query .= " AND candidate_driver_license = 1";
    }

    if ($job_travel == 1) {
        $query .= " AND candidate_travel = 1";
    }

    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $job_category, $job_town, $job_years);
    $stmt->execute();
    $candidate_result = $stmt->get_result();

    while ($candidate_data = $candidate_result->fetch_assoc()) {
        $job_positions[$job_id][] = $candidate_data;
    }
}

echo json_encode($job_positions);
?>
