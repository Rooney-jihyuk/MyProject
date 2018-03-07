<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/include/db_connect.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/PHPExcel_1.8/Classes/PHPExcel.php';
	
	$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/admin/excel_uploads/';
	$upload_file = $upload_dir . basename($_FILES['KANZI_MODIFY_EXCEL_FILE']['name']);
	
	$bcate_id = $_REQUEST['bcate_id'];
	$scate_id = $_REQUEST['scate_id'];
	$sel_si_gb = $_REQUEST['sel_si_gb'];
	$searchSelect = $_REQUEST['searchSelect'];
	$searchKeyword = $_REQUEST['searchKeyword'];
	$page = $_REQUEST['page'];
	
	try {
		move_uploaded_file($_FILES['KANZI_MODIFY_EXCEL_FILE']['tmp_name'], $upload_file);
		
		$inputFileType = PHPExcel_IOFactory::identify( $upload_file );
		$objReader     = PHPExcel_IOFactory::createReader( $inputFileType );
		
		$objPHPExcel = $objReader->load( $upload_file );
		
		/**
		 * @var $sheet PHPExcel_Worksheet
		 */
		$sheet = $objPHPExcel->getSheet( 0 );
		
		$highestRow    = $sheet->getHighestRow();
		$highestColumn = $sheet->getHighestColumn();

		$totCnt = 0;
		
		for ( $row = 6; $row <= $highestRow; $row ++ ) {
			$rowData = $sheet->rangeToArray( 'A' . $row . ':' . $highestColumn . $row, null, true, false );
			$rowData = $rowData[0];
			
			$wr_id = $rowData[0];
			$bcategory_id = $rowData[1]; // 대분류 카테고리 아이디
			$scategory_id = $rowData[2]; // 소분류 카테고리 아이디
			$wr_subject = $rowData[3]; // 시설명
			$lat_val = $rowData[4]; // 위도
			$lon_val = $rowData[5]; // 경도
			$wr_2 = $rowData[6]; // 설립일
			$wr_3 = $rowData[7]; // 운영주체
			$wr_16 = $rowData[8]; // 대표자성함
			
			$wr_26 = $rowData[9]; // 우편번호
			$wr_22 = $rowData[10]; // 주소(상세 주소를 입력해야 함)
			$wr_6 = $rowData[11]; // 전화
			$wr_8 = $rowData[12]; // 팩스
			$wr_7 = $rowData[13]; // e-mail
			$wr_4 = $rowData[14]; // 홈페이지
			$wr_9 = $rowData[15]; // 직원현황
			$wr_19 = $rowData[16]; // 사업대상
			$wr_20 = $rowData[17]; // 이용인원
			$wr_28 = $rowData[18]; // 이용자격 및 절차
			$wr_21 = $rowData[19]; // 제공서비스(프로그램)
			
			$wr_29 = $rowData[20]; // 사회복지 현장 -> 방학중
			$wr_30 = $rowData[21]; // 사회복지 현장 -> 학기중
			$wr_31 = $rowData[22]; // 사회복지 현장 -> 수시
			$wr_32 = $rowData[23]; // 사회복지 현장 -> 기타

			if(($wr_29 == "O") || ($wr_29 != "")) { $wr_29 = "1"; } else { $wr_29 = ""; }
			if(($wr_30 == "O") || ($wr_30 != "")) { $wr_30 = "1"; } else { $wr_30 = ""; }
			if(($wr_31 == "O") || ($wr_31 != "")) { $wr_31 = "1"; } else { $wr_31 = ""; }
			if(($wr_32 == "O") || ($wr_32 != "")) { $wr_32 = "1"; } else { $wr_32 = ""; }
			
			$wr_44 = $rowData[24]; // 후원계좌(정기후원, 비정기후원)
			$wr_24 = $rowData[25]; // 후원물품
			
			$wr_33 = $rowData[26]; // 봉사활동 모집 -> 후원계좌 -> 재능나눔
			$wr_34 = $rowData[27]; // 봉사활동 모집 -> 후원계좌 -> 전문봉사
			$wr_35 = $rowData[28]; // 봉사활동 모집 -> 후원계좌 -> 문화.예술
			$wr_36 = $rowData[29]; // 봉사활동 모집 -> 후원계좌 -> 보건.의료
			$wr_37 = $rowData[30]; // 봉사활동 모집 -> 후원계좌 -> 업무보조
			$wr_38 = $rowData[31]; // 봉사활동 모집 -> 후원계좌 -> 노력봉사
			$wr_39 = $rowData[32]; // 봉사활동 모집 -> 후원계좌 -> 기타

			if(($wr_33 == "O") || ($wr_33 != "")) { $wr_33 = "1"; } else { $wr_33 = ""; }
			if(($wr_34 == "O") || ($wr_34 != "")) { $wr_34 = "1"; } else { $wr_34 = ""; }
			if(($wr_35 == "O") || ($wr_35 != "")) { $wr_35 = "1"; } else { $wr_35 = ""; }
			if(($wr_36 == "O") || ($wr_36 != "")) { $wr_36 = "1"; } else { $wr_36 = ""; }
			if(($wr_37 == "O") || ($wr_37 != "")) { $wr_37 = "1"; } else { $wr_37 = ""; }
			if(($wr_38 == "O") || ($wr_38 != "")) { $wr_38 = "1"; } else { $wr_38 = ""; }
			if(($wr_39 == "O") || ($wr_39 != "")) { $wr_39 = "1"; } else { $wr_39 = ""; }
			
			$wr_40 = $rowData[33]; // 실적인증시스템 -> VMS
			$wr_41 = $rowData[34]; // 실적인증시스템 -> 1365
			$wr_42 = $rowData[35]; // 실적인증시스템 -> Dovol
			$wr_43 = $rowData[36]; // 실적인증시스템 -> 기타

			if(($wr_40 == "O") || ($wr_40 != "")) { $wr_40 = "1"; } else { $wr_40 = ""; }
			if(($wr_41 == "O") || ($wr_41 != "")) { $wr_41 = "1"; } else { $wr_41 = ""; }
			if(($wr_42 == "O") || ($wr_42 != "")) { $wr_42 = "1"; } else { $wr_42 = ""; }
			if(($wr_43 == "O") || ($wr_43 != "")) { $wr_43 = "1"; } else { $wr_43 = ""; }
			
			$wr_good_ok = $rowData[37]; // 관리자 승인여부 -> 승인
			$wr_good_not = $rowData[38]; // 관리자 승인여부 -> 미승인

			$si_gb = $rowData[39]; // 시 구분 (1 : 제주시, 2 : 서귀포시)
			
			if($wr_good_ok == "O") { $wr_good_ok = "1"; } else { $wr_good_ok = ""; }
			if($wr_good_not == "O") { $wr_good_not = "1"; } else { $wr_good_not = ""; }
			
			if($wr_good_ok == "1") { $wr_good = "1"; }
			if($wr_good_not == "1") { $wr_good = "9"; }
			
			$lat_val = str_replace("'", "", $lat_val);
			$lon_val = str_replace("'", "", $lon_val);

			$wr_subject = str_replace("'", "''", $wr_subject);
			$wr_2 = str_replace("'", "''", $wr_2);
			$wr_16 = str_replace("'", "''", $wr_16);
			$wr_3 = str_replace("'", "''", $wr_3);
			$wr_26 = str_replace("'", "''", $wr_26);
			$wr_7 = str_replace("'", "''", $wr_7);
			$wr_4 = str_replace("'", "''", $wr_4);
			$wr_6 = str_replace("'", "''", $wr_6);
			$wr_8 = str_replace("'", "''", $wr_8);
			$wr_9 = str_replace("'", "''", $wr_9);
			$wr_19 = str_replace("'", "''", $wr_19);
			$wr_20 = str_replace("'", "''", $wr_20);
			$wr_28 = str_replace("'", "''", $wr_28);
			$wr_21 = str_replace("'", "''", $wr_21);
			$wr_29 = str_replace("'", "''", $wr_29);
			$wr_30 = str_replace("'", "''", $wr_30);
			$wr_31 = str_replace("'", "''", $wr_31);
			$wr_32 = str_replace("'", "''", $wr_32);
			$wr_44 = str_replace("'", "''", $wr_44);
			$wr_24 = str_replace("'", "''", $wr_24);
			$wr_33 = str_replace("'", "''", $wr_33);
			$wr_34 = str_replace("'", "''", $wr_34);
			$wr_35 = str_replace("'", "''", $wr_35);
			$wr_36 = str_replace("'", "''", $wr_36);
			$wr_37 = str_replace("'", "''", $wr_37);
			$wr_38 = str_replace("'", "''", $wr_38);
			$wr_39 = str_replace("'", "''", $wr_39);
			$wr_40 = str_replace("'", "''", $wr_40);
			$wr_41 = str_replace("'", "''", $wr_41);
			$wr_43 = str_replace("'", "''", $wr_43);
			$wr_22 = str_replace("'", "''", $wr_22);

			$wr_id = iconv("UTF-8", "EUC-KR", $wr_id);
			$bcategory_id = iconv("UTF-8", "EUC-KR", $bcategory_id);
			$scategory_id = iconv("UTF-8", "EUC-KR", $scategory_id);
			$wr_subject = iconv("UTF-8", "EUC-KR", $wr_subject);
			$lat_val = iconv("UTF-8", "EUC-KR", $lat_val);
			$lon_val = iconv("UTF-8", "EUC-KR", $lon_val);
			$wr_2 = iconv("UTF-8", "EUC-KR", $wr_2);
			$wr_3 = iconv("UTF-8", "EUC-KR", $wr_3);
			$wr_16 = iconv("UTF-8", "EUC-KR", $wr_16);

			$wr_26 = iconv("UTF-8", "EUC-KR", $wr_26);
			$wr_22 = iconv("UTF-8", "EUC-KR", $wr_22);
			$wr_6 = iconv("UTF-8", "EUC-KR", $wr_6);
			$wr_8 = iconv("UTF-8", "EUC-KR", $wr_8);
			$wr_7 = iconv("UTF-8", "EUC-KR", $wr_7);
			$wr_4 = iconv("UTF-8", "EUC-KR", $wr_4);
			$wr_9 = iconv("UTF-8", "EUC-KR", $wr_9);
			$wr_19 = iconv("UTF-8", "EUC-KR", $wr_19);
			$wr_20 = iconv("UTF-8", "EUC-KR", $wr_20);
			$wr_28 = iconv("UTF-8", "EUC-KR", $wr_28);
			$wr_21 = iconv("UTF-8", "EUC-KR", $wr_21);

			$wr_29 = iconv("UTF-8", "EUC-KR", $wr_29);
			$wr_30 = iconv("UTF-8", "EUC-KR", $wr_30);
			$wr_31 = iconv("UTF-8", "EUC-KR", $wr_31);
			$wr_32 = iconv("UTF-8", "EUC-KR", $wr_32);

			$wr_44 = iconv("UTF-8", "EUC-KR", $wr_44);
			$wr_24 = iconv("UTF-8", "EUC-KR", $wr_24);

			$wr_33 = iconv("UTF-8", "EUC-KR", $wr_33);
			$wr_34 = iconv("UTF-8", "EUC-KR", $wr_34);
			$wr_35 = iconv("UTF-8", "EUC-KR", $wr_35);
			$wr_36 = iconv("UTF-8", "EUC-KR", $wr_36); // 봉사활동 모집 -> 후원계좌 -> 보건.의료
			$wr_37 = iconv("UTF-8", "EUC-KR", $wr_37); // 봉사활동 모집 -> 후원계좌 -> 업무보조
			$wr_38 = iconv("UTF-8", "EUC-KR", $wr_38); // 봉사활동 모집 -> 후원계좌 -> 노력봉사
			$wr_39 = iconv("UTF-8", "EUC-KR", $wr_39); // 봉사활동 모집 -> 후원계좌 -> 기타

			$wr_40 = iconv("UTF-8", "EUC-KR", $wr_40); // 실적인증시스템 -> VMS
			$wr_41 = iconv("UTF-8", "EUC-KR", $wr_41); // 실적인증시스템 -> 1365
			$wr_42 = iconv("UTF-8", "EUC-KR", $wr_42); // 실적인증시스템 -> Dovol
			$wr_43 = iconv("UTF-8", "EUC-KR", $wr_43); // 실적인증시스템 -> 기타

			$wr_good_ok = iconv("UTF-8", "EUC-KR", $wr_good_ok); // 관리자 승인여부 -> 승인
			$wr_good_not = iconv("UTF-8", "EUC-KR", $wr_good_not); // 관리자 승인여부 -> 미승인

			$si_gb = iconv("UTF-8", "EUC-KR", $si_gb); // 시 구분 (1 : 제주시, 2 : 서귀포시)

			$lat_val = str_replace("'", "", $lat_val);
			$lon_val = str_replace("'", "", $lon_val);
			
			if(($wr_id != "") && (intval($wr_id) > 0)) {
				$totCnt++;
				$query = "
					UPDATE 
						comm_info 
					SET 
						bcategory_id = '".$bcategory_id."', 
						scategory_id = '".$scategory_id."', 
						wr_subject = '".$wr_subject."', 
						wr_2 = '".$wr_2."', 
						wr_16 = '".$wr_16."', 
						wr_3 = '".$wr_3."', 
						wr_26 = '".$wr_26."', 
						wr_22 = '".$wr_22."', 
						wr_7 = '".$wr_7."', 
						wr_4 = '".$wr_4."', 
						wr_6 = '".$wr_6."', 
						wr_8 = '".$wr_8."', 
						wr_9 = '".$wr_9."', 
						wr_19 = '".$wr_19."', 
						wr_20 = '".$wr_20."', 
						wr_28 = '".$wr_28."', 
						wr_21 = '".$wr_21."', 
						wr_29 = '".$wr_29."', 
						wr_30 = '".$wr_30."', 
						wr_31 = '".$wr_31."', 
						wr_32 = '".$wr_32."', 
						wr_44 = '".$wr_44."', 
						wr_24 = '".$wr_24."', 
						wr_33 = '".$wr_33."', 
						wr_34 = '".$wr_34."', 
						wr_35 = '".$wr_35."', 
						wr_36 = '".$wr_36."', 
						wr_37 = '".$wr_37."', 
						wr_38 = '".$wr_38."', 
						wr_39 = '".$wr_39."', 
						wr_40 = '".$wr_40."', 
						wr_41 = '".$wr_41."', 
						wr_42 = '".$wr_42."', 
						wr_43 = '".$wr_43."', 
						wr_good = '".$wr_good."', 
						lat_val = '".$lat_val."', 
						lon_val = '".$lon_val."', 
						si_gb = '".$si_gb."'
					WHERE 
						wr_id = '".$wr_id."'
				";
			}
			
			mysql_query($query);
		}

		if($totCnt > 0) {
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄 업데이트 처리가 완료되었습니다.");
			location.href = "/admin/kanzi/list.php?bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
			unlink($upload_file); // 엑셀 파일 업로드 완료 후, 서버에 용량이 초과되지 않도록 하기 위해서 업로드 처리된 엑셀 파일을 해당 경로에서 삭제 조치함
		}
	} catch ( Exception $e ) {
		$errMsg = $e->getMessage();
?>
		<script>
		window.onload = function() {
			alert("엑셀 일괄 업데이터 처리중 오류가 발생하였습니다.\r\n(<?=$errMsg?>)");
			location.href = "/admin/kanzi/excel_upload_modify.php?bcate_id=<?=$bcate_id?>&scate_id=<?=$scate_id?>&sel_si_gb=<?=$sel_si_gb?>&searchSelect=<?=$searchSelect?>&searchKeyword=<?=$searchKeyword?>&page=<?=$page?>";
			return;
		}
		</script>
<?
	}
?>