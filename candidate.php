<?php
    class Candidate {
        public $candidate_id;
        public $candidate_name;
        public $candidate_category;
        public $candidate_town;
        public $candidate_years;
        public $candidate_driver_license;
        public $candidate_travel;

        function __construct($candidate_id, $candidate_name,$candidate_category, $candidate_town, 
                            $candidate_years, $candidate_driver_license, $candidate_travel) {
                                $this->candidate_id = $candidate_id;
                                $this->candidate_name = $candidate_name;
                                $this->candidate_category = $candidate_category;
                                $this->candidate_town = $candidate_town;
                                $this->candidate_years = $candidate_years;
                                $this->candidate_driver_license = $candidate_driver_license;
                                $this->candidate_travel = $candidate_travel;
        }
    }
?>