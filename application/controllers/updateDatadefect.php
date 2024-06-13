<?php
class updateDatadefect extends CI_Controller
{
	public function updateDatadefectregister(){
			// *sqlite Succss
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dt_wi_no = $_GET["dtWino"];
		$dt_lot_no = $_GET["dtLotNo"];
		$dt_seq_no = $_GET["dtSeqno"];
		$dt_type = $_GET["dtType"];
		$dtItemType = $_GET["dtItemType"];
		$dt_code = $_GET["dtCode"];
		$PartNo = $_GET["PartNo"];
		$sql = "update defect_transactions set dt_status_flg = '5' where dt_wi_no='{$dt_wi_no}' and dt_lot_no = '{$dt_lot_no}' and dt_seq_no = '{$dt_seq_no}' and dt_type = '{$dt_type}' and dt_code = '{$dt_code}' and dt_item_type = '{$dtItemType}' and dt_item_cd = '{$PartNo}'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
			echo "true";
		}else{
			echo "false";
		}
	}

	public function updateDefectactual(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dt_wi_no = $_GET["dtWino"];
		$dt_lot_no = $_GET["dtLotNo"];
		$dt_seq_no = $_GET["dtSeqno"];
		$dt_type = $_GET["dtType"];
		$dt_code = $_GET["dtCode"];
		$sql = "update defect_actual set da_status_flg = '5' where da_wi_no='{$dt_wi_no}' and da_lot_no = '{$dt_lot_no}' and da_seq_no = '{$dt_seq_no}' and da_type = '{$dt_type}' and da_code = '{$dt_code}' and da_transfer_flg = '0'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
			echo "true";
		}else{
			echo "false";
		}
	}
	public function update_tagprint_detail(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$flgUpdate = $_GET["flgUpdate"];
		$conditionflg = $_GET["conditionflg"];
		$wi = $_GET["wi"];
		// $sqlCheckData1 = "select top 1 * from sup_work_plan_supply_dev where WI = '{$wi}' and LVL = '1'";
		// $query1 = $this->TBK_FA01->query($sqlCheckData1);
		// $getDefect1 = $query1->result_array();
		// $sqlCheckData2 = "select  TRIM(SUBSTRING(qr_detail, 55, 4)) as qty  from tag_print_detail where wi = '{$wi}' and flg_control = '0' ORDER BY id DESC ";
		// $query2 = $this->TBK_FA01->query($sqlCheckData2);
		// $getDefect2 = $query2->result_array();
		// if($getDefect1[0]["PKG_UNIT_QTY"] == $getDefect2[0]["qty"]){
			$sql = "update tag_print_detail set flg_control = '{$flgUpdate}' where flg_control = '{$conditionflg}' and  wi = '{$wi}'";
			$query = $this->TBK_FA01->query($sql);
			if ($query){
				echo "true";
			}else{
				echo "false";
			}
		// }
	}
	public function update_tagprint_detailforDefect(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$flgUpdate = $_GET["flgUpdate"];
		$conditionflg = $_GET["conditionflg"];
		$pwi_id = $_GET["pwi_id"];
		$BoxNo = $_GET["BoxNo"];
		  $sql = "update tag_print_detail set flg_control = '{$flgUpdate}' 
		where flg_control = '{$conditionflg}' and  pwi_id = '{$pwi_id}' and box_no = '{$BoxNo}'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
			echo "true";
		}else{
			echo "false";
		}
	}
	public function update_tagprint_sub(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$flgUpdate = $_GET["flgUpdate"];
		$conditionflg = $_GET["conditionflg"];
		$wi = $_GET["wi"];
		$sql = "update tag_print_detail_sub set flg_control = '{$flgUpdate}' where flg_control = '{$conditionflg}' and  wi = '{$wi}'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
			echo "true";
		}else{
			echo "false";
		}
	}
	public function update_tagprint_main(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$flgUpdate = $_GET["flgUpdate"];
		$conditionflg = $_GET["conditionflg"];
		$wi = $_GET["wi"];
		$sql = "update tag_print_detail_main set flg_control = '{$flgUpdate}' where flg_control = '{$conditionflg}' and  wi = '{$wi}'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
			echo "true";
		}else{
			echo "false";
		}
	}

	public function updateDefectactualAdmin(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->TBK_FA01 = $this->load->database('tbkkfa01_db', true);
		$dt_wi_no = $_GET["dtWino"];
		$dt_lot_no = $_GET["dtLotNo"];
		$dt_seq_no = $_GET["dtSeqno"];
		$dt_type = $_GET["dtType"];
		$dt_code = $_GET["dtCode"];
		$dtItemType = $_GET["dtItemType"];
		$ItemCd = $_GET["ItemCd"];
		  $sql = "update defect_actual set da_status_flg = '5' where da_wi_no='{$dt_wi_no}' and da_lot_no = '{$dt_lot_no}' and da_seq_no = '{$dt_seq_no}' and da_type = '{$dt_type}' and da_code = '{$dt_code}' and da_transfer_flg = '0' and da_item_type = '{$dtItemType}' and da_item_cd  ='{$ItemCd}'";
		$query = $this->TBK_FA01->query($sql);
		if ($query){
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
		$dt_status_flg = 1;//$_GET["dtStatusflg"];
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
					dt_updated_by
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
					'{$dt_actual_date}',
					'{$dt_status_flg}',
					 CURRENT_TIMESTAMP,
					'{$dt_line_cd}',
					 CURRENT_TIMESTAMP,
					'{$dt_line_cd}'
					)
		";
		$query = $this->TBK_FA01->query($sql);
		if($query){
			echo "true";
		}else{
			echo "false";
		}
	}
}
?>