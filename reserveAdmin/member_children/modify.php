<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$children_id = $_REQUEST['children_id'];
	

	


	//$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "SELECT * FROM rev_member_children WHERE children_id = '".$children_id."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$form_info = mysqli_fetch_array($result);
?>
<!--
<script>
	function modifyFormSubmit(sukso_id) {
		var modifyForm = document.getElementById("modifyForm");
		var sukso_name = document.getElementById("sukso_name");
		var sukso_sort = document.getElementById("sukso_sort");
		
		if(sukso_name.value == "") {
			alert("숙소명을 입력해주세요.");
			sukso_name.focus();
			return false;
		}
		
		if(sukso_sort.value == "") {
			alert("운영일 순서를 입력해주세요.");
			sukso_sort.focus();
			return false;
		}
		/		modifyForm.action = "modify_ok.php?room_id=" + room_id;
	}
</script>

-->
<!--				
$form_info['room_name']
$form_info['user_num']
-->
	<div id="contentArea">
		<div id="subTitle">숙소 수정</div>
		<div id="subContent">
			<div style="padding:10px;">
		<!--		<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit('<?=$room_id?>');"> -->

					<form name="insertForm" id="insertForm" method="post" action="/reserveAdmin/member_children/modify_ok.php ">
				
				<input type="hidden" id="children_id" name="children_id" value="<?=$children_id?>" />
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />


				<div id="insertArea">
					<table  cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

					<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

							
					<tr height="40px" align="center">
						<th width="15%">회원ID</th>
						<td align="left"><input type="text" name="mb_id" id="mb_id" style="width:98%; height:30px;" value="<?=$row['mb_id']?>" /></td>
					</tr>


					<tr height="40px" align="center">
						<th width="15%">이름</th>
						<td align="left"><input type="text" name="children_name" id="children_name" style="width:98%; height:30px;" value="<?= $row['children_name'] ?>"></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">생년월일</th>
						<td align="left">
							<input type="text" name="children_birth" style="border:1px solid #ff0000; " maxlength="8"  value="<?=str_replace("-", "", $row['children_birth']) ?>" >(예:20150202 생년월일 8자리)
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">성별</th>
						<td align="left">
							<select name="children_sex">
							<option value="M"<? if($row['children_sex'] == "M") { ?> selected<? } ?>>남자</option>
							<option value="F"<? if($row['children_sex'] == "F") { ?> selected<? } ?>>여자</option>
							</select>
						</td>
					</tr>
					</table>
				</div>
						
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="수정" />

					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelect=<?=$_REQUEST['searchSelect']?>&searchKeyword=<?=$_REQUEST['searchKeyword']?>&page=<?=$_REQUEST['page']?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php

	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/footer.php");
?>