<?
include_once ("./_common.php");
include_once ("../include/header.php");

$contLeftMain = "1";
?>

<div id="pageSubBg">
	<div id="pageSubImgBg">
		<img src="/resource/images/sub/common/sub_background.png" />
	</div>
</div>

<div id="pageCont">

    <div id="contL">
    	
        <ul>
           	<li><img src="/resource/images/sub/menu/subLeftTitle02.png" alt="사업소개" title="사업소개" /></li>
        </ul>
            
		<? include_once ("../include/leftmenu.php"); ?>
        
	</div><!-- <div id="contL"> //-->
   	
    <div id="contLayout">
    	<div id="contR">
	        
            <div id="contSubject">                
                <ul>
                	<li><img src="/resource/images/sub/title/home.png" alt="HOME" title="HOME" /> HOME</li>
                    <li>&gt; 교육과정</li>
                    <li>&gt; <span style="color:#1699dc">학점과정</span></li>
                </ul>

                <span><img src="/resource/images/sub/title/subTitle02_01.png" alt="학점과정" title="학점과정" /></span>
            </div>

            <div id="contView">
<?
$bo_table = "contents_base";
//$wr_id = $_GET[wr_id];
$wr_id = "41";

include (__root__ . "/include/iframe.php");
?>
            </div><!-- <div id="contView"> //-->
            
        </div><!-- <div id="contR"> //-->
	</div><!-- <div id="contLayout"> //-->
    
</div><!-- <div id="pageCont"> //-->

<?
include_once ("../include/footer.php");
?>