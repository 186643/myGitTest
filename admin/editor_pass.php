<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
require_once '../login/login_check.php';
$id=$admin_list[id];
$sexx[$admin_list[admin_sex]]="checked='checked'";
$css_url="../templates/".$met_skin."/css";
$img_url="../templates/".$met_skin."/images";
include template('admin/admin_pass');
footer();
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
