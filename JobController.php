<?php

    include("connection.php");
    include_once("job.php");

    class JobController {
        private $con;
        public function __construct($con) {
            $this->con = $con;
        }

        public function addJob($job) {
            $job_id = $GLOBALS['user_data']['user_id'];
            $query = "insert into job_position (job_id, job_name, job_category, company_name, job_town, date_posted, job_years, job_desc, job_res, job_req, job_driver_license, job_travel) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->con->prepare($query);
            $stmt->bind_param("isssssssssii", $job_id, $job->job_name, $job->job_category, $job->company_name, $job->job_town, $job->date_posted, $job->job_years, $job->job_desc, $job->job_res, $job->job_req, $job->job_driver_license, $job->job_travel);
        
            if ($stmt->execute()) {
                return $job_id;
            } else {
                return false;
            }
        }
        
    }
?>