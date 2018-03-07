<?php 
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/db_conn.php"); 
	
	if(isset($_SESSION['memberId'])) {
		session_start();
?>
	<script>
	window.onload = function() {
		location.href = "/reserveAdmin/";
		return;
	}
	</script>
<?
	} else {
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>

<link rel="stylesheet" type="text/css" href="/reserveAdmin/resources/css/admin.css"/>
<style>

</style>

<script>
function frmLoginSubmit() {
	
	var adminLoginForm = document.getElementById("adminLoginForm");
	var member_id = document.getElementById("member_id");
	var member_password = document.getElementById("member_password");
	
	if(member_id.value == "") {
		alert("아이디를 입력해주세요.");
		member_id.focus();
		return;
	}

	if(member_password.value == "") {
		alert("패스워드를 입력해주세요.");
		member_password.focus();
		return;
	}

	adminLoginForm.submit();

}

function searchEnterSubmit(ev) {
	var evt_code = (window.netscape) ? ev.which : event.keyCode; // 파이어폭스에서 엔터키 안되는 현상 수정

	if (evt_code == 13) {
		frmLoginSubmit();
	}
}
</script>

<title>:: 제주 비자숲힐링센터 - 예약시스템 관리자 ::</title>
</head>
<body topmargin="0" leftmargin="0">

	<div id="logintopArea">
		<span id="logintoptop_bg1"></span>
		<span id="logintoptop_logo"></span>
	</div>


	<div id="loginAllArea">
				<div id="loginArea">
					
						<div id="fromBox">
								
								<span id="login_title"></span>
						
								<form id="adminLoginForm" name="adminLoginForm"  method="post"	action="login_proc.php">
										<input type="hidden" name="mode" id="mode" value="login" />
						
										<table id="login_table">
											<tr>
												<td>
												<input type="text" name="member_id" id="member_id"  class="form-control" tabindex="1" onkeyup="javascript:searchEnterSubmit(event);" value="admin" />
												</td>
										</tr>
										<tr>
											<td>
												<input type="password" name="member_password" id="member_password"
												class="form-control" tabindex="2" value="" onkeyup="javascript:searchEnterSubmit(event);" />
											</td>
										</tr>
										<tr>
											<td><input id="loginButton" type="button" tabindex="3" onclick="javascript:frmLoginSubmit();" /></td>
										</tr>
									</table>
								</form>
							</div>
				</div>
		</div>
		<div id="bottom_area">
			<span id="bottom_bg"></span>
		
		</div>
</body>
</html>

<? } ?>
