<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once ROOTPATH.'include/export.func.php';
/*时间变量*/
$dtimet=statime("Y/m/d 00:00:00");	
$dtimew=statime("Y/m/d 23:59:59");	
$ztimea=statime("Y-m-d 00:00:00","-1 day");
$ztimeb=statime("Y-m-d 23:59:59","-1 day");
$xtime=statime("Y-m-d 00:00:00","-6 day");	
$timeq30=statime("Y-m-d 00:00:00","-29 day");
$timed1=strtotime(date('Y-m-d 00:00:00', mktime(0,0,0,date('n'),1,date('Y'))));
$st=isset($st)?$st:$dtimet;
$et=isset($et)?$et:$dtimew;
if($stt)$st=strtotime($stt);
if($ett)$et=strtotime($ett);
if($st>$et){
	$st=strtotime($ett);
	$et=strtotime($stt);
}
/*初始变量*/
$cs=isset($cs)?$cs:0;
$dancs[$cs]='class="dday round"';
$tmst=date("Y-m-d",$st);
$tmet=date("Y-m-d",$et);
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
$et=$et+86300;
if($setip!=null){
	$total_count = $db->counter($met_visit_day, " acctime >='{$st}' and acctime<='{$et}' and ip='$setip'", "*");
}else{
	$total_count = $db->counter($met_visit_day, " acctime >='{$st}' and acctime<='{$et}'", "*");
}
$list_num = 15;
require_once $depth.'../include/pager.class.php';
$page = (int)$page;
if($page_input){$page=$page_input;}
$rowset = new Pager($total_count,$list_num,$page);
$from_record = $rowset->_offset();

if($setip!=null){
	$query="select * from {$met_visit_day} WHERE acctime >='{$st}' and acctime<='{$et}' and ip='$setip' order by acctime desc LIMIT {$from_record},{$list_num}";
}else{
	$query="select * from {$met_visit_day} WHERE acctime >='{$st}' and acctime<='{$et}' order by acctime desc LIMIT {$from_record},{$list_num}";
}
//$query="select * from {$met_visit_day} WHERE acctime >='{$st}' and acctime<='{$et}' and ip='127.0.0.1' order by acctime desc LIMIT {$from_record},{$list_num}";
$result= $db->query($query);
while($list = $db->fetch_array($result)){
	$valmet=acceptun($list['columnid'],$list['listid'],$list['lang']);
	$list['title']=$valmet['title']?$valmet['title']:$list['visitpage'];
	if($list['dizhi']==''){
		$cop=explode('-',ipdizhi($list['ip']));
		$list['dizhi']=$cop[0];
		$list['network']=$cop[1];
		$dayquery ="update {$met_visit_day} SET dizhi = '{$cop[0]}',network = '{$cop[1]}' where id = '{$list['id']}'";
		$db->query($dayquery);
	}
	$visit_day[]=$list;
}
function browseryext($browser){
global $lang_statbrowser1,$lang_statbrowser2,$lang_statbrowser3,$lang_statbrowser4,$lang_statbrowser5,$lang_statbrowser6;
	switch($browser){
		case 'se360':$lystk1958=$lang_statbrowser1;break;
		case 'se':$lystk1958=$lang_statbrowser7;break;
		case 'maxthon':$lystk1958=$lang_statbrowser2;break;
		case 'qq':$lystk1958=$lang_statbrowser3;break;
		case 'tt':$lystk1958=$lang_statbrowser4;break;
		case 'theworld':$lystk1958=$lang_statbrowser5;break;
		case 'chrome':$lystk1958=$lang_statbrowser6;break;
		default:$lystk1958=$browser;break;
	}
	return $lystk1958;
}
function ipdizhi($ip){
	global $met_file;
	$met_file='/ipku.php';
	$post=array('ip'=>$ip);
	$lystk1958 = curl_post($post,30);
	return $lystk1958;
}
$page_list = $rowset->link("details.php?lang={$lang}&anyid={$anyid}&st={$st}&et={$et}&cs={$cs}&setip=$setip&page=");
include template('app/stat/details');footer();
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
