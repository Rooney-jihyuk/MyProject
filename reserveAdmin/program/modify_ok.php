<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$program_manage_id = $_REQUEST['program_manage_id'];
	$program_category_id = $_REQUEST['program_category_id'];
	$wr_subject = $_REQUEST['wr_subject'];
	$wr_1 = $_REQUEST['wr_1'];
	$wr_4 = $_REQUEST['wr_4'];
	$wr_5 = $_REQUEST['wr_5'];
	$wr_6 = $_REQUEST['wr_6'];
	$wr_content = $_REQUEST['wr_content'];
	$use_yn = $_REQUEST['use_yn'];
	$program_sort = $_REQUEST['program_sort'];
	
	$wr_id = $_REQUEST['wr_id'];

	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	$program_manage_id = str_replace("'", "''", $program_manage_id);
	$program_category_id = str_replace("'", "''", $program_category_id);
	$wr_subject = str_replace("'", "''", $wr_subject);
	$wr_1 = str_replace("'", "''", $wr_1);
	$wr_4 = str_replace("'", "''", $wr_4);
	$wr_5 = str_replace("'", "''", $wr_5);
	$wr_6 = str_replace("'", "''", $wr_6);
	$wr_content = str_replace("'", "''", $wr_content);
	$use_yn = str_replace("'", "''", $use_yn);
	$program_sort = str_replace("'", "''", $program_sort);
		
	$query = "
		UPDATE 
			program 
		SET 
			program_manage_id = '".$program_manage_id."',
			program_category_id = '".$program_category_id."',
			wr_subject = '".$wr_subject."',
			wr_1 = '".$wr_1."',
			wr_4 = '".$wr_4."',
			wr_5 = '".$wr_5."',
			wr_6 = '".$wr_6."',
			wr_content = '".$wr_content."',
			use_yn = '".$use_yn."',
			program_sort = '".$program_sort."'
		WHERE 
			wr_id = '" . $wr_id . "'
	";
	
	mysqli_query($conn, $query);
?>

<script>
window.onload = function() {
	alert("입력하신 프로그램 정보가 수정되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>