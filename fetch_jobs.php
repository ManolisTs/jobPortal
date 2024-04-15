<?php
session_start();

include("connection.php");

$user_id = $_SESSION['user_id'];

// Fetch all candidate profiles based on user_id
$query = "SELECT * FROM candidate_profile WHERE candidate_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$jobs = [];

while ($candidate_data = $result->fetch_assoc()) {
    $candidate_category = $candidate_data['candidate_category'];
    $candidate_town = $candidate_data['candidate_town'];
    $candidate_years = $candidate_data['candidate_years'];
    $candidate_driver_license = $candidate_data['candidate_driver_license'];
    $candidate_travel = $candidate_data['candidate_travel'];

    // Fetch job positions based on candidate profile attributes
    $query = "SELECT * FROM job_position WHERE job_category = ? AND job_town = ? AND job_years <= ?";

    if ($candidate_driver_license == 1) {
        $query .= " AND job_driver_license = 1";
    }

    if ($candidate_travel == 1) {
        $query .= " AND job_travel = 1";
    }

    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $candidate_category, $candidate_town, $candidate_years);
    $stmt->execute();
    $job_result = $stmt->get_result();

    while ($row = $job_result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

echo json_encode($jobs);
?>
