<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$admin_id = $_REQUEST['admin_id'];
	

	


	//$searchSelectCategory = $_REQUEST['searchSelectCategory'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	if($page == "") {
		$page = "1";
	}

	$query = "SELECT * FROM rev_program_admin WHERE admin_id = '".$admin_id."'";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
	$form_info = mysqli_fetch_array($result);
?>

<script>


$(document).ready(function(){
	$("#program_name").change(function(){


		$("#programIDarea").html($("select[name=program_name] option:selected").attr("mid") + " <input type='hidden' name='wr_id' id='wr_id'  value='"+$("select[name=program_name] option:selected").attr("mid")+"' />");	
		});
	});

/*

		$("#programIDarea").html($("select[name=program_name] option:selected").attr("mid") + " <input type='hidden' name='wr_id' id='wr_id'  value='"+$("select[name=program_name] option:selected").attr("mid")+"' />");

function changeProgramID(val) {
	document.getElementById("programIDarea").innerHTML = "<input type='text' name='wr_id' id='wr_id'  value='"+val+"' />";
}
*/

$(function(){
	$(".DatePicker").datepicker({
		dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        monthNamesShort: ['1월','2월','3월','4월','5월','6월','7월','8월','9월','10월','11월','12월'],
        dayNames: ['일','월','화','수','목','금','토'],
        dayNamesShort: ['일','월','화','수','목','금','토'],
        dayNamesMin: ['일','월','화','수','목','금','토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
	});
});

</script>


<!--				
$form_info['room_name']
$form_info['user_num']
-->
	<div id="contentArea">
		<div id="subTitle">숙소 수정</div>
		<div id="subContent">
			<div style="padding:10px;">
		<!--		<form name="modifyForm" id="modifyForm" method="post" onsubmit="return modifyFormSubmit('<?=$room_id?>');"> -->

		<form name="insertForm" id="insertForm" method="GET" action="/reserveAdmin/program_admin/modify_ok.php">
				
				<input type="hidden" id="searchSelect" name="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" id="searchKeyword" name="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" id="page" name="page" value="<?=$page?>" />
				

				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">

							
					<tr height="40px" align="center">
						<th width="15%">프로그램 명</th>
						<td align="left">
						<!--
							<select name="program_name" id="program_name" style="height:30px;" onchange="javascript:changeProgramID(this.value);">
						-->
							<select name="program_name" id="program_name" style="height:30px;">
							
							<option value="0" mid="">-선택하세요-</option>
								<?php
									$program_sql = " SELECT wr_id, wr_subject FROM program ";//프로그램 SQL믄
									$program_result = mysqli_query($conn, $program_sql);
									
									while($program_row = mysqli_fetch_array($program_result)) {
										if($program_row['wr_subject'] == $row['program_name']) {
								?>
								<option value="<?=$program_row['wr_subject']?>" mid="<?=$program_row['wr_id']?>" selected><?=$program_row['wr_subject'] ?></option>
								<?php
										} else {
								?>
								<option value="<?=$program_row['wr_subject']?>" mid="<?=$program_row['wr_id']?>" ><?=$program_row['wr_subject']?></option>
								<?php
										}
									}
								?>
						</select>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">프로그램  ID</th>
							<td align="left"><span id="programIDarea"><?=$row['wr_id']?></span>
							<input type="hidden" name="admin_id" value="<?= $row['admin_id'] ?>"/>
							<input type="hidden" name="wr_id" value="<?= $row['wr_id'] ?>"/>
						</td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">운영시작일</th>
						<td align="left"><input type="text" class="DatePicker" name="admin_start_date" value="<?= $row['admin_start_date'] ?>" /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">운영종료일</th>
						<td align="left"><input type="text" class="DatePicker" name="admin_end_date"  value="<?= $row['admin_end_date'] ?>"/></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">신청자수</th>
						<td align="left"><input type="text" name="people_cnt" id="people_cnt" style="width:98%; height:30px;"  value="<?= $row['people_cnt'] ?>"   /></td>
					</tr>
					<tr height="40px" align="center">
						<th width="15%">프로그램금액</th>
						<td align="left"><input type="text" name="program_price" id="program_price" style="width:98%; height:30px;"  value="<?= $row['program_price'] ?>" /></td>
					</tr>
					<tr>
						<th>객실사용(유/무)</th>
						<td>
							<fieldset>
								<? 
									if($row['admin_status']=='y'){ ?>
								 <span>사용유</span><input type="radio" name="admin_status" value="y" checked/>
								 <span>사용무</span><input type="radio" name="admin_status" value="n" />
								  <? }else{ ?>
								 <span>사용유</span><input type="radio" name="admin_status" value="y" />
								 <span>사용무</span><input type="radio" name="admin_status" value="n" checked/>
								<? } ?>
							</fieldset>
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