<?php
class masterData extends CI_Controller
{
    public function __construct() {

        parent::__construct();

        $this->load->model("MasterData_model");
    }

    public function getDepartmentMaster($plant_cd = "") {
        $result = $this->MasterData_model->getDepartmentMaster($plant_cd);
        echo json_encode($result);
    }

    public function getLineMaster($dep_cd = "") {
        $result = $this->MasterData_model->getLineMaster($dep_cd);
        echo json_encode($result);
    }
    public function getDataGoodDefect($wi , $partNo){
        $sql = "Select * from defect_actual lef";
    }
}