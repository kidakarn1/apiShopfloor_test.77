<?php
class MasterData_model extends CI_Model {
    public function __construct() {

        parent::__construct();
        $this->fa = $this->load->database('tbkkfa01_db', true);
    }

    public function getDepartmentMaster($plant) {
        $where = !empty($plant) ? "AND plant_cd = {$plant}" : "";

        $sql = "SELECT dep_id, dep_name, sec_name, plant_cd FROM sys_department WHERE enable = 1 $where";
        $query = $this->fa->query($sql);
        return $query->num_rows() > 0 ? $query->result() : array() ;
    }


    public function getLineMaster($dep_cd) {
        $where = !empty($dep_cd) ? "AND dep_cd = '{$dep_cd}'" : "";

        $sql = "SELECT line_id, dep_cd, line_cd, line_name FROM sys_line_mst WHERE enable = 1 $where";
        $query = $this->fa->query($sql);
        return $query->num_rows() > 0 ? $query->result() : array() ;
    }

    public function getLineMasterDefect($dep_cd, $plant) {
        $where = !empty($dep_cd) ? "AND dep_cd = '{$dep_cd}'" : "";

        $sql = "SELECT line_id, dep_cd, line_cd, line_name FROM sys_line_mst WHERE enable = 1 $where";
        $query = $this->fa->query($sql);
        return $query->num_rows() > 0 ? $query->result() : array() ;
    }
}