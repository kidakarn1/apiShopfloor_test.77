<?php
class insertDatadefect extends CI_Controller
{
 	public function getMaxdefectactual($da_wi_no , $da_lot_no , $da_seq_no , $da_code , $da_type){
	   	$sql = "select max(dt_id) as rs_id from defect_transactions where dt_wi_no ='{$da_wi_no}' and dt_lot_no = '{$da_lot_no}' and dt_seq_no = '{$da_seq_no}' and dt_code = '{$da_code}' and dt_status_flg =' 1' and dt_type = '{$da_type}'";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		return $get["0"]["rs_id"];
	}
	 	public function getMindefectactual($da_wi_no , $da_lot_no , $da_seq_no , $da_code , $da_type){
		$sql = "select min(dt_id) as rs_id from defect_transactions where dt_wi_no ='{$da_wi_no}' and dt_lot_no = '{$da_lot_no}' and dt_seq_no = '{$da_seq_no}' and dt_code = '{$da_code}' and dt_status_flg =' 1' and dt_type = '{$da_type}'";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		return $get["0"]["rs_id"];
	}
	public function insertDefectactual(){
		// *sqlite Succss
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$da_wi_no = $_GET["dtWino"];
		$da_line_cd = $_GET["dtLineno"];
		$da_item_cd = $_GET["dtItemcd"];
		$da_item_type = $_GET["dtItemtype"];
		$da_lot_no = $_GET["dtLotNo"];
		$da_seq_no = $_GET["dtSeqno"];
		$da_type = $_GET["dtType"];
		$da_code = $_GET["dtCode"];
		$da_qty = $_GET["dtQty"];
		$da_menu = $_GET["dtMenu"];
		$da_actual_date = $_GET["dtActualdate"];
		$pwi_id = $_GET["pwi_id"];
		$da_st_dt = "" ;//$this->getMindefectactual($da_wi_no , $da_lot_no , $da_seq_no  , $da_code , $da_type);
		$da_en_dt = "";//$this->getMaxdefectactual($da_wi_no , $da_lot_no , $da_seq_no  , $da_code , $da_type);
		if (intval($da_qty) > 0){
			$da_status_flg = "1";
		}else{
			$da_status_flg = "5";
		}
		     $sql  = "
				INSERT into defect_actual (
					da_wi_no,
					da_line_cd,
					da_item_cd,
					da_item_type,
					da_lot_no,
					da_seq_no,
					da_type,
					da_code,
					da_qty,
					da_menu,
					da_st_dt,
					da_en_dt,
					da_actual_date,
					da_status_flg,
					da_transfer_flg,
					da_created_date,
					da_created_by,
					da_updated_date,
					da_updated_by,
					pwi_id
					) Values(
					'{$da_wi_no}',
					'{$da_line_cd}',
					'{$da_item_cd}',
					'{$da_item_type}',
					'{$da_lot_no}',
					'{$da_seq_no}',
					'{$da_type}',
					'{$da_code}',
					'{$da_qty}',
					'{$da_menu}',
					'{$da_st_dt}',
					'{$da_en_dt}',
					'{$da_actual_date}',
					'{$da_status_flg}',
					'0',
					 CURRENT_TIMESTAMP,
					'{$da_line_cd}',
					 CURRENT_TIMESTAMP,
					'{$da_line_cd}',
					'{$pwi_id}'
					)
		";
//		exit();
		$query = $this->TBK_FA01->query($sql);
		if($query){
			echo "true";
		}else{
			echo "false";
		}
	}
	public function insertDefectregister(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dt_wi_no = $_GET["dtWino"];
		$dt_line_cd = $_GET["dtLineno"];
		$dt_item_cd = $_GET["dtItemcd"];
		$dt_item_type = $_GET["dtItemtype"];
		$dt_lot_no = $_GET["dtLotNo"];
		$dt_seq_no = $_GET["dtSeqno"];
		$dt_type = $_GET["dtType"];
		$dt_code = $_GET["dtCode"];
		$dt_qty = $_GET["dtQty"];
		$dt_menu = $_GET["dtMenu"];
		$dt_actual_date = $_GET["dtActualdate"];
		$pwi_id = $_GET["pwi_id"];
		// $da_status_flg = 1;//$_GET["dtStatusflg"];
		if (intval($dt_qty) > 0){
			$dt_status_flg = "1";
		}else{
			$dt_status_flg = "5";
		}
		 $sql  = "
				INSERT into defect_transactions (
					dt_wi_no,
					dt_line_cd,
					dt_item_cd,
					dt_item_type,
					dt_lot_no,
					dt_seq_no,
					dt_type,
					dt_code,
					dt_qty,
					dt_menu,
					dt_actual_date,
					dt_status_flg,
					dt_created_date,
					dt_created_by,
					dt_updated_date,
					dt_updated_by,
					pwi_id
					) Values(
					'{$dt_wi_no}',
					'{$dt_line_cd}',
					'{$dt_item_cd}',
					'{$dt_item_type}',
					'{$dt_lot_no}',
					'{$dt_seq_no}',
					'{$dt_type}',
					'{$dt_code}',
					'{$dt_qty}',
					'{$dt_menu}',
					 CURRENT_TIMESTAMP,
					'{$dt_status_flg}',
					 CURRENT_TIMESTAMP,
					'{$dt_line_cd}',
					 CURRENT_TIMESTAMP,
					'{$dt_line_cd}',
					'{$pwi_id}'
					)
		";
		$query = $this->TBK_FA01->query($sql);
		if($query){
			echo "true";
		}else{
			echo "false";
		}
	}
	public function getReferencetagprintdefectminid($wi , $lot , $seq , $type){
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$sql = "Select min(da_id) as da_id from defect_actual where da_wi_no = '{$wi}' and da_lot_no = '{$lot}'  and da_seq_no = '{$seq}' and da_type = '{$type}'";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		return $get["0"]["da_id"];
	}
		public function getReferencetagprintdefectmaxid($wi , $lot , $seq , $type){
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$sql = "Select max(da_id) as da_id from defect_actual where da_wi_no = '{$wi}' and da_lot_no = '{$lot}'  and da_seq_no = '{$seq}' and da_type = '{$type}'";
		$query = $this->TBK_FA01->query($sql);
		$get = $query->result_array();
		return $get["0"]["da_id"];
	}
	public function inserttagdefect(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dti_wi_no = $_GET["dti_wi_no"];
		$dti_line_cd = $_GET["dti_line_cd"];
		$dti_item_cd = $_GET["dti_item_cd"];
		$dti_item_type = $_GET["dti_item_type"];
		$dti_lot_no = $_GET["dti_lot_no"];
		$dti_seq_no = $_GET["dti_seq_no"];
		$dti_type = $_GET["dti_type"];
		$dti_sum_qty = $_GET["dti_sum_qty"];
		$dti_menu = $_GET["dti_menu"];
		$dti_st_da = $this->getReferencetagprintdefectminid($dti_wi_no , $dti_lot_no ,$dti_seq_no , $dti_type );//"0"; //$_GET["dti_st_da"];
		$dti_en_da =  $this->getReferencetagprintdefectmaxid($dti_wi_no , $dti_lot_no ,$dti_seq_no , $dti_type);//"0"; //$_GET["dti_en_da"];
		$dti_box_no = $_GET["dti_box_no"];
		$dti_info_qr_cd = $_GET["dti_info_qr_cd"];
		$dti_defect_qr_cd = $_GET["dti_defect_qr_cd"];
		$dti_status_flg = $_GET["dti_status_flg"];
		$dti_created_date = $_GET["dti_created_date"];
		$dti_created_by = $_GET["dti_created_by"];
		$dti_updated_date = $_GET["dti_updated_date"];
		$dti_updated_by  = $_GET["dti_updated_by"];
		$pwi_id  = $_GET["pwi_id"];
		    $sql = "INSERT INTO defect_tag_information 
				(
				 	dti_wi_no,
					dti_line_cd,
					dti_item_cd,
					dti_item_type,
					dti_lot_no,
					dti_seq_no,
					dti_type,
					dti_sum_qty,
					dti_menu,
					dti_st_da,
					dti_en_da,
					dti_box_no,
					dti_info_qr_cd,
					dti_defect_qr_cd,
					dti_status_flg,
					dti_created_date,
					dti_created_by,
					dti_updated_date,
					dti_updated_by,
					pwi_id
				)
				VALUES
					(
					'{$dti_wi_no}',
					'{$dti_line_cd}',
					'{$dti_item_cd}',
					'{$dti_item_type}',
					'{$dti_lot_no}',
					'{$dti_seq_no}',
					'{$dti_type}',
					'{$dti_sum_qty}',
					'{$dti_menu}',
					'{$dti_st_da}',
					'{$dti_en_da}',
					'{$dti_box_no}',
					'{$dti_info_qr_cd}',
					'{$dti_defect_qr_cd}',
					'1',
					'{$dti_created_date}',
					'{$dti_created_by}',
					'{$dti_updated_date}',
					'{$dti_updated_by}',
					'{$pwi_id}'
					)";  
		 		$query = $this->TBK_FA01->query($sql);
		if($query){
			echo "true";
		}else{
			echo "false";
		}
	}
}
?>