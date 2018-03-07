<?php
	include_once($_SERVER['DOCUMENT_ROOT'] . "/reserveAdmin/include/header.php");
	
	$searchSelect = isset($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchSelect = !empty($_REQUEST['searchSelect']) ? $_REQUEST['searchSelect'] : '';
	$searchKeyword = isset($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchKeyword = !empty($_REQUEST['searchKeyword']) ? $_REQUEST['searchKeyword'] : '';
	$searchSelectCategory = isset($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$searchSelectCategory = !empty($_REQUEST['searchSelectCategory']) ? $_REQUEST['searchSelectCategory'] : '';
	$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
	$page = !empty($_REQUEST['page']) ? $_REQUEST['page'] : '';
?>

<script>
	function insertFormSubmit() {
		var insertForm = document.getElementById("insertForm");
		var PROGRAM_CATEGORY_EXCEL_FILE = document.getElementById("PROGRAM_CATEGORY_EXCEL_FILE");
		
		if(PROGRAM_CATEGORY_EXCEL_FILE.value == "") {
			alert("업로드할 엑셀파일을 선택해주세요.");
			PROGRAM_CATEGORY_EXCEL_FILE.focus();
			return false;
		} else {
			if((PROGRAM_CATEGORY_EXCEL_FILE.value.indexOf(".xlsx")) > -1 || (PROGRAM_CATEGORY_EXCEL_FILE.value.indexOf(".xls")) == -1) {
				alert(".xls 확장자를 가진 엑셀파일만 업로드 가능합니다.");
				PROGRAM_CATEGORY_EXCEL_FILE.focus();
				return false;
			}
		}
		
		if(confirm("정말로 엑셀파일을 업로드하시겠습니까?")) {
			insertForm.action = "excel_upload_process.php";
		} else {
			return false;
		}
		
	}
</script>

	<div id="contentArea">
		<div id="subTitle">프로그램 카테고리 관리 [엑셀 업로드 - 일괄추가]</div>
		<div id="subContent">
			<div style="padding:10px 50px 10px 10px;">
				<input type="button" class="btn_insert" value="엑셀-샘플파일 다운로드 Click" onclick="javascript:location.href = 'excel_sample.php';" />
				
				<form name="insertForm" id="insertForm" method="post" onsubmit="return insertFormSubmit();" enctype="multipart/form-data">
				<input type="hidden" name="searchSelectCategory" id="searchSelectCategory" value="<?=$searchSelectCategory?>" />
				<input type="hidden" name="searchSelect" id="searchSelect" value="<?=$searchSelect?>" />
				<input type="hidden" name="searchKeyword" id="searchKeyword" value="<?=$searchKeyword?>" />
				<input type="hidden" name="page" id="page" value="<?=$page?>" />
				
				<div id="insertArea">
					<table width="100%" cellpadding="5" cellspacing="0" border="1" style="border-collapse:collapse; table-layout:fixed;">		
					<tr height="40px" align="center">
						<th width="20%">엑셀파일 선택</th>
						<td align="left">
							<div><input type="file" name="PROGRAM_CATEGORY_EXCEL_FILE" id="PROGRAM_CATEGORY_EXCEL_FILE" size="70" style="height:30px;" /></div>
							<div>※ .xls 확장자를 가진 엑셀파일만 업로드 가능합니다.</div>
						</td>
					</tr>
					</table>
				</div>
				
				<div id="insertButtonArea">
					<input type="submit" class="btn_submit" value="업로드" />
					<input type="button" class="btn_submit" value="뒤로가기" onclick="location.href = 'list.php?searchSelectCategory=<?=$searchSelectCategory?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>';" />
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
	include_once("../include/footer.php");
?>