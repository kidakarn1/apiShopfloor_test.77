<?php
class getDatadefectSpecial extends CI_Controller
{
	public function GetDataAdminAdjust(){
		
	}
	public  function groupDataWiSpc(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dtWi = $_GET["dfWi"];
		$dtseq = $_GET["dfseq"];
		$dtLot = $_GET["dfLot"];
		$sql = " 
				SELECT 
				dt_wi_no, 
				dt_seq_no,
				(
					select ISNULL(sum(dt_qty) , 0) 
					from  defect_transactions 
					where 
						dt_status_flg = '1' AND
						dt_type = '2' AND 
						dt_lot_no ='$dtLot' AND
						dt_wi_no in ($dtWi) AND
						dt_seq_no in ($dtseq)  AND
						dt_item_type ='1'
				) AS TotaldfNC ,
				(
					select ISNULL(sum(dt_qty) , 0) 
					from  defect_transactions 
					where 
						dt_status_flg = '1' AND
						dt_type = '1' AND 
						dt_lot_no ='$dtLot' AND
						dt_wi_no in ($dtWi) AND
						dt_seq_no in ($dtseq)  AND
						dt_item_type ='1'

				) AS TotaldfNG ,
				sum( dt_qty ) AS totalDEFECT 
				FROM
					defect_transactions 
				WHERE
					dt_status_flg = '1' AND
					dt_lot_no ='$dtLot' AND
					dt_wi_no in ($dtWi) AND
					dt_seq_no in ($dtseq)  AND
					dt_item_type ='1'
				GROUP BY
					dt_wi_no,
					dt_seq_no
		";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
	public function getDefectncPartNo(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		parse_str($_SERVER['QUERY_STRING'], $_POST); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$arrWi = $data["arrWi"];
		$condition = "";
 		$index = 1;
		foreach ($arrWi as $key => $value) {
			$condition .= $value;
			if($index < count($arrWi)){
				$condition .= ",";
			}
			$index++;
		}
		$dfSeqSel = $data["dfSeqSel"];
		$dfWiSel = $data["dfWiSel"];
		$dfLot = $data["dfLot"];
		$dfType = $data["dfType"];
		$PartNo = $data["PartNo"];
		   $sql = "SELECT
				 ISNULL(SUM(dt.dt_qty) , 0) AS total_nc
				 FROM
					 defect_transactions as dt, 
					 sys_exp_defect_mst as sdm
			WHERE
				(
					dt.dt_wi_no = '{$dfWiSel}' 
				)
				AND 
				(
					dt.dt_seq_no = '{$dfSeqSel}' 
				)
				AND dt.dt_lotw_no = '{$dfLot}' 
				AND dt.dt_type = '{$dfType}' 
				AND dt.dt_code = sdm.def_cd
				And dt.dt_status_flg = '1'
				AND dt.dt_item_cd = '{$PartNo}'
		";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo $get[0]["total_nc"];
		}
	}
	public function getDefectnc(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$arrWi = $data["arrWi"];
		$lengthDataPlan = $data["lengthDataPlan"];
		$startseq = $data["startseq"];
		$dfLot = $data["dfLot"];
		$dfType = $data["dfType"];
		$condition = "";
		$conditionseq = "";
		$tmpseq =  $startseq;
		$index = 1;
		foreach ($arrWi as $key => $value) {
			$tmpseq +=1;
			$condition .= $value;
			$conditionseq .= $tmpseq;
			if($index < $lengthDataPlan){
				$condition .= ",";
				$conditionseq .=",";
			}
			$index++;
		}
		    $sql = "SELECT
				dt.dt_item_cd,
				dt.dt_code,
				SUM (dt.dt_qty) AS total_nc,
				dt.dt_item_type ,
				sdm.def_name_en AS description,
				sdm.def_name_en AS defect_name,
				dt.dt_wi_no,
				dt.dt_seq_no,
				dt.pwi_id
			FROM
				defect_transactions as dt, 
				sys_exp_defect_mst as sdm
			WHERE
				(
					dt.dt_wi_no  in ($condition) 
				) 
				AND (
					dt.dt_seq_no  in ($conditionseq)
					) 
				AND dt.dt_lot_no = '{$dfLot}' 
				AND dt.dt_type = '{$dfType}' 
				AND dt.dt_code = sdm.def_cd
				And dt.dt_status_flg = '1'
			GROUP BY
				dt.dt_item_cd,
				dt.dt_code,
				dt.dt_item_type ,
				sdm.def_name_en,
				sdm.def_name_en,
				dt.dt_wi_no,
				dt.dt_seq_no,
				dt.pwi_id
				order by dt.dt_item_type asc";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
	public function getChildpart(){
		$json_data = file_get_contents('php://input');
		$data = json_decode($json_data, true);
		parse_str($_SERVER['QUERY_STRING'], $_POST); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$arrWi = $data["arrWi"];
		$condition = "";
 		$index = 1;
		foreach ($arrWi as $key => $value) {
			$condition .= $value;
			if($index < count($arrWi)){
				$condition .= ",";
			}
			$index++;
		}
		   $sql  = "
            Select *
                From 
                sup_work_plan_supply_dev 
                where   WI In ($condition)  and LVL='2'  order by WI asc
        ";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if(empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
    public function  Getdatachildpartsummarychild(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dfWi1 = $_GET["dfWi1"];
		$dfSeq = $_GET["dfSeq"];
		$dfLot = $_GET["dfLot"];
		  $sql = "SELECT
						dt.dt_item_cd,
						dt.dt_code,
						SUM ( dt.dt_qty ) AS total_nc,
						dt.dt_item_type ,
						sdm.def_name_en AS description ,
						dt.dt_type,
						sdm.def_name_en AS defect_name
					FROM
						defect_transactions AS dt,
						sys_exp_defect_mst AS sdm 
					WHERE
						( 
                            dt.dt_wi_no = '{$dfWi1}'  
                        ) 
						AND dt.dt_seq_no = '{$dfSeq}' 
						AND dt.dt_lot_no = '{$dfLot}' 
						AND dt.dt_code = sdm.def_cd 
						AND dt.dt_status_flg = '1' 
						AND dt.dt_item_type = '2'
						AND dt.dt_qty <> '0'
					GROUP BY
						dt.dt_item_cd,
						dt.dt_code,
						dt.dt_item_type,
						sdm.def_name_en ,
						dt.dt_type,
						sdm.def_name_en
					ORDER BY
						dt.dt_item_type ASC";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
    public function  GetdatachildpartsummarychildSpc(){
		$json_data = file_get_contents('php://input');
    	$data = json_decode($json_data, true);
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
        $dfWi = $data["dfWi"];
		$lengthDataPlan = $data["lengthDataPlan"];
		$dfLot = $data["dfLot"];
		$startseq = $data["startseq"];
		$tmpseq =  $startseq;
		$condition = "";
		$conditionseq = "";
		$index = 1;
		foreach ($dfWi as $key => $value) {
			$tmpseq +=1;
			$condition .= $value;
			$conditionseq .= $tmpseq;
			if($index < $lengthDataPlan){
				$condition .= ",";
				$conditionseq .=",";
			}
			$index++;
		}
		$sql = "SELECT
						dt.dt_item_cd,
						dt.dt_code,
						SUM ( dt.dt_qty ) AS total_nc,
						dt.dt_item_type ,
						sdm.def_name_en AS description ,
						dt.dt_type,
						sdm.def_name_en AS defect_name , 
						dt.dt_wi_no
					FROM
						defect_transactions AS dt,
						sys_exp_defect_mst AS sdm 
					WHERE
						( 
                            dt.dt_wi_no in ($condition)
                        ) 
						AND 
						(
							dt.dt_seq_no in ($conditionseq)
						)
						AND dt.dt_lot_no = '{$dfLot}' 
						AND dt.dt_code = sdm.def_cd 
						AND dt.dt_status_flg = '1' 
						AND dt.dt_item_type = '2'
						AND dt.dt_qty <> '0'
					GROUP BY
						dt.dt_item_cd,
						dt.dt_code,
						dt.dt_item_type,
						sdm.def_name_en ,
						dt.dt_type,
						sdm.def_name_en,
						dt.dt_wi_no
					ORDER BY
						dt.dt_item_type ASC";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
		public function  GetdatachildpartsummaryfgSpc(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$json_data = file_get_contents('php://input');
    	$data = json_decode($json_data, true);
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
        $dfWi = $data["dfWi"];
		$lengthDataPlan = $data["lengthDataPlan"];
		$dfLot = $data["dfLot"];
		$startseq = $data["startseq"];
		$condition = "";
		$index = 1;
		$conditionseq = "";
		$tmpseq =  $startseq;
		foreach ($dfWi as $key => $value) {
			$tmpseq +=1;
			$condition .= $value;
			$conditionseq .= $tmpseq;
			if($index < $lengthDataPlan){
				$condition .= ",";
				$conditionseq .=",";
			}
			$index++;
		}
		   $sql = "SELECT
						dt.dt_item_cd,
						dt.dt_code,
						SUM ( dt.dt_qty ) AS total_nc,
						dt.dt_item_type ,
						sdm.def_name_en AS description ,
						dt.dt_type,
						sdm.def_name_en AS defect_name,
						dt.dt_wi_no
					FROM
						defect_transactions AS dt,
						sys_exp_defect_mst AS sdm 
					WHERE
						( 
                            dt.dt_wi_no  in ($condition)
                        ) 
						AND 
						(
							dt.dt_seq_no in ($conditionseq)
						)
						AND dt.dt_lot_no = '{$dfLot}' 
						AND dt.dt_code = sdm.def_cd 
						AND dt.dt_status_flg = '1' 
						AND dt.dt_item_type = '1'
						AND dt.dt_qty <> '0'
					GROUP BY
						dt.dt_item_cd,
						dt.dt_code,
						dt.dt_item_type,
						sdm.def_name_en ,
						dt.dt_type,
						sdm.def_name_en,
						dt.dt_wi_no
					ORDER BY
						dt.dt_item_type ASC";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		if (empty($get)){
			echo "0";
		}else{
			echo json_encode($get);
		}
	}
}
?>