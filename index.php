<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 


define('IN_ADMIN', true);
//œÓ¿Ú
$M_MODULE='admin';
if(@$_GET['m'])$M_MODULE=$_GET['m'];
if(@!$_GET['n'])$_GET['n']="index";
if(@!$_GET['c'])$_GET['c']="index";
if(@!$_GET['a'])$_GET['a']="doindex";
@define('M_NAME', $_GET['n']);
@define('M_MODULE', $M_MODULE);
@define('M_CLASS', $_GET['c']);
@define('M_ACTION', $_GET['a']);
require_once '../app/system/entrance.php';
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
