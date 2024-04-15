<?php
    class Job {
        public $job_id;
        public $job_name;
        public $job_category;
        public $company_name;
        public $job_town;
        public $date_posted;
        public $job_years;
        public $job_desc;
        public $job_res;
        public $job_req;
        public $job_driver_license;
        public $job_travel;

        function __construct($job_id, $job_name,$job_category, 
                            $company_name, $job_town, $date_posted, 
                            $job_years, $job_desc, $job_res, $job_req, 
                            $job_driver_license, $job_travel) {
                                $this->job_id = $job_id;
                                $this->job_name = $job_name;
                                $this->job_category = $job_category;
                                $this->company_name = $company_name;
                                $this->job_town = $job_town;
                                $this->date_posted = $date_posted;
                                $this->job_years = $job_years;
                                $this->job_desc = $job_desc;
                                $this->job_res = $job_res;
                                $this->job_req = $job_req;
                                $this->job_driver_license = $job_driver_license;
                                $this->job_travel = $job_travel;
        }
    }
?>