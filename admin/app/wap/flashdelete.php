<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
$rurl='../app/wap/flash.php?anyid='.$anyid.'&lang='.$lang.'&module='.$module.'&cs='.$cs;
if($action=="del"){
	$allidlist=explode(',',$allid);
	foreach($allidlist as $key=>$val){
		$flashrec=$db->get_one("SELECT * FROM $met_flash where id='$val'");
		file_unlink("../../".$flashrec[img_path]);
		file_unlink("../../".$flashrec[flash_path]);
		file_unlink("../../".$flashrec[flash_back]);	
		$query = "delete from $met_flash where id='$val'";
		$db->query($query);
	}
	metsave($rurl,'',$depth);
}else{
	$flashrec=$db->get_one("SELECT * FROM {$met_flash} where id='{$id}'");
	file_unlink("../../".$flashrec[img_path]);
	file_unlink("../../".$flashrec[flash_path]);
	file_unlink("../../".$flashrec[flash_back]);
	$query = "delete from {$met_flash} where id='{$id}'";
	$db->query($query);
	metsave($rurl,'',$depth);
}
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
