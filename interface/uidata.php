<?php
# LUANCHENG Enterprise Content Management System 
# Copyright (C) LUANCHENG Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
require_once '../common.inc.php';
require_once ROOTPATH.'include/export.func.php';

// dump($_M['config']);

//$data['config']=$_M['config'];

$data['config']['met_online_type'] = $_M['config']['met_online_type'];
$data['config']['met_stat'] = $_M['config']['met_stat'];

echo json_encode($data);




# Copyright (C) LUANCHENG Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
