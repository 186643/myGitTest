<?php
# lystk1958.com.cn Enterprise Content Management System 
# Copyright (C) lystk1958 Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
require_once '../login/login_check.php';
if($admin_list[admin_group]==3){
	$admin_groupx[0]='checked="checked"';
}
if($admin_list[langok]!='lystk1958.com.cn'){
	foreach($met_langok as $key=>$val){
		$langoka=explode('-',$admin_list[langok]);
		for($i=0;$i<count($langoka);$i++){
			if($langoka[$i]==$val[mark])$met_langoka[]=$val;
		}
	}
}else{
	$met_langoka=$met_langok;
}
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
$query="select * from $met_app where download=1";
$app=$db->get_all($query);
include template('admin/admin_add');
footer();
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?><dl>
	<dt></dt>
	<dd></dd>
</dl><ul><ol>
	<li></li>
	<li></li>
	<li></li>
</ol></ul>

