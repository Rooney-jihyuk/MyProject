<?php
	@session_start();
	
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php");	
	if(empty($_SESSION['memberId'])) {
?>
<script>
window.onload = function() {
	location.href = "/reserveAdmin/login.php";
}
</script>
<? 
	} else {
		$sess_memberId = isset($_SESSION['memberId']) ? $_SESSION['memberId'] : "";
		$query = "SELECT mb_name FROM reserve_member WHERE mb_id = '".$sess_memberId."' AND mb_level = '10'";
		$result_set = mysqli_query($conn, $query);
		
		$row = mysqli_fetch_assoc($result_set);
		
		$member_name = $row['mb_name'];
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="/reserveAdmin/resources/css/admin.css"/>

<link rel="stylesheet" type="text/css" href="/reserveAdmin/resources/js/jquery-ui-1.11.0/jquery-ui.min.css">
<script language="javascript" src="/reserveAdmin/resources/js/jquery-1.11.1.min.js"></script>
<script language="javascript" src="/reserveAdmin/resources/js/jquery-ui-1.11.0/jquery-ui.min.js"></script>
<script language="javascript" src="/reserveAdmin/resources/js/jquery.highlight-4.js"></script>

<title>:: 제주 비자숲힐링센터 - 예약시스템 관리자 ::</title>
<body topmargin="0" leftmargin="0">
<div id="adminHeader">
	<div class="adminHeader01">
		<a href="/reserveAdmin" style="border:0px;"><img src="/reserveAdmin/resources/images/common/logo.png" style="border:0px;" /></a>
	</div>
	<div class="adminHeader02">
		<? echo $member_name;?>님 환영합니다. <input type="button" value="LOGOUT" onclick="location.href = '/reserveAdmin/logout.php';" style="width: 100px; height: 35px; background: #faa61a;
    color: #ffffff; border: 1px solid #faa61a; cursor: pointer; font-weight: bold; font-size: 16px;" />
	</div>
</div>

<? include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/leftmenu.php"); ?>
<? } ?>