<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 


$depth='../';
require_once $depth.'../login/login_check.php';
if($action='del'){
$query="select * from $met_app where id='$id' and download=1";
$app=$db->get_one($query);
if($app['file'])deldir('../'.$app['file']);
$query="delete from $met_app where id='$id' and download=1";
$db->query($query);
}
echo $lang_appuninstall;
metsave('../app/dlapp/dlapp.php?anyid='.$anyid.'&lang='.$lang,'',$depth);
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
