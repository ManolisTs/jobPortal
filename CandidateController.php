<?php

    include("connection.php");
    include("candidate.php");

    class CandidateController {
        private $con;
        public function __construct($con) {
            $this->con = $con;
        }

        public function addCandidate($candidate) {
            $candidate_id = $GLOBALS['user_data']['user_id'];
            $query = "insert into candidate_profile (candidate_id, candidate_name, candidate_category, candidate_town, candidate_years, candidate_driver_license, candidate_travel) values (?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("issssii", $candidate_id, $candidate->candidate_name, $candidate->candidate_category, $candidate->candidate_town, $candidate->candidate_years, $candidate->candidate_driver_license, $candidate->candidate_travel);
        
            if ($stmt->execute()) {
                return $candidate_id;
            } else {
                return false;
            }
        }

        
    }
?>