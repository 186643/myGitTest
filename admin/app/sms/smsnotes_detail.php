<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
$depth='../';
require_once $depth.'../login/login_check.php';
require_once ROOTPATH.'include/export.func.php';
$sms_list = $db->get_one("SELECT * FROM $met_sms WHERE id='$id'");
if(!$sms_list)metsave('-1',$lang_dataerror);
$total_tels = explode(',',$sms_list['tel']);
$telsnum=count($total_tels);
$sms_list['telnum']=$telsnum;
$sms_list['tel']=str_replace(",","\n",$sms_list['tel']);
$sms_list['type']=sedsmstype($sms_list['type']);
$sms_list['time']=date('Y-m-d H:i:s',$sms_list['time']);
$sms_list['remark']=sedsmserrtype($sms_list['remark'],1);
$css_url=$depth."../templates/".$met_skin."/css";
$img_url=$depth."../templates/".$met_skin."/images";
include template('app/sms/smsnotes_detail');footer();
# Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
