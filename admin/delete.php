<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
require_once '../login/login_check.php';
$adminno = $db->counter($met_admin_table, " where admin_type like '%metinfo%' and id<>'$id'", "*");
if($adminno<1)metsave('-1',$lang_deleteJS);
if($action=="del"){
$allidlist=explode(',',$allid);
foreach($allidlist as $key=>$val){
$query = "delete from $met_admin_table where id='$val'";
$db->query($query);
}
metsave('../admin/index.php?lang='.$lang.'&anyid='.$anyid);
}
else{
$admin_list = $db->get_one("SELECT * FROM $met_admin_table WHERE id='$id'");
if(!$admin_list)metsave('-1',$lang_loginNoid);
$query = "delete from $met_admin_table where id='$id'";
$db->query($query);
metsave('../admin/index.php?lang='.$lang.'&anyid='.$anyid);
}
# This program is an open source system, commercial use, please consciously to purchase commercial license.

# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
