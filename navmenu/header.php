<?php
    // Check if the session is not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include("connection.php");
    include_once("functions.php");

    $user_data = check_login($con);

    $user_type = $user_data['user_type'];

    if ($user_type == 0) {
        include("navmenu/candidate.html");
    } elseif ($user_type == 1) {
        include("navmenu/employer.html");
    } else {
        echo "Error with the user type. Check user_type attribute in db.";
    }
?>
