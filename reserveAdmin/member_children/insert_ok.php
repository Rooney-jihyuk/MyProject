<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");
	
	$mb_id = $_REQUEST['mb_id'];
	$children_name = $_REQUEST['children_name'];
	$temp_data = $_REQUEST['children_birth'];
	$children_sex = $_REQUEST['children_sex'];

	$temp_data = str_replace("-", "", $temp_data);
	
	//-19840214
	//-01234567
	$temp = array(substr($temp_data,0,4),substr($temp_data,4,2),substr($temp_data,6,2));
	$children_birth = $temp[0]."-".$temp[1]."-".$temp[2];
	
//	$sukso_sort = $_REQUEST['sukso_sort'];
	

	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

/*
create table rev_member_children(
  mb_id varchar(50) NOT NULL,
	children_id int(11) NOT NULL AUTO_INCREMENT,
  children_name varchar(500) NOT NULL,
  children_birth date NOT NULL,
	primary key(children_id)
);
*/

	$query =" 
			INSERT INTO rev_member_children 
		(
			mb_id,
			children_name,
			children_birth, 
			children_sex
		)
		VALUES
		(
			'".$mb_id."','".$children_name."','".$children_birth."','".$children_sex."')";
	//	echo $query;
			
	mysqli_query($conn, $query);
?>
<script>
	location.href = "/reserveAdmin/member_children/list.php";
</script>

<!--
<script>
window.onload = function() {
	alert("입력하신 숙소 정보가 등록되었습니다.");
	location.href = "list.php?searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
	return;
}
</script>
-->