<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
require_once '../login/login_check.php';
$admin_listed = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_listed)metsave('-1',$lang_dataerror);
if($admin_list[langok]!='metinfo'){
	foreach($met_langok as $key=>$val){
		$langoka=explode('-',$admin_list[langok]);
		for($i=0;$i<count($langoka);$i++){
			if($langoka[$i]==$val[mark])$met_langoka[]=$val;
		}
	}
}else{
	$met_langoka=$met_langok;
}
if($admin_listed[langok]=="metinfo"){
	$langok1="checked='checked'";
	foreach($met_langok as $key=>$val){
		$langok2[$val[mark]]="checked='checked'";
	}
}else{
	$langokb=explode('-',$admin_listed[langok]);
	foreach($langokb as $key=>$val){
		$langok2[$val]="checked='checked'";
	}
}
if($admin_listed[admin_group]==0){
	if($admin_listed[admin_issueok]==1)$admin_issue_ok="checked='checked'";
	$admin_op=explode('-',$admin_listed['admin_op']);
	if($admin_op[0]=="metinfo"||$admin_listed[admin_op]=="metinfo"){
		$admin_op_0="checked='checked'";
		$admin_op_1="checked='checked'";
		$admin_op_2="checked='checked'";
		$admin_op_3="checked='checked'";
	}else{
		if($admin_op[1]=="add")$admin_op_1="checked='checked'";
		if($admin_op[2]=="editor")$admin_op_2="checked='checked'";
		if($admin_op[3]=="del")$admin_op_3="checked='checked'";
	}
}

if($admin_listed['admin_type'] == 'metinfo' || strstr($admin_listed['admin_type'], '1801')) {
	$isonline_upgrade = "checked='checked'";
}
$sexx[$admin_listed[admin_sex]]="checked='checked'";
$admin_groupx[$admin_listed[admin_group]]="checked='checked'";
$metmanager=1;
$query="select * from $met_app where download=1";
$app=$db->get_all($query);
require_once '../include/metlist.php';
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin/admin_editor');
footer();
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
