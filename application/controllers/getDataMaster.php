<?php
class MasterData extends CI_Controller
{
    public function __construct() {

        $this->fa = $this->load->database('tbkkfa01_db');
    }
    public function getDepartmentMaster() {
        
    }
}