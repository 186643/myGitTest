<? php
# Lystk1958   Enterprise Content Management System 
# Copyright (C) Lystk1958  Co.,Ltd (http://www.lystk1958.com.cn). All rights reserved. 
$depth='../';
$action_ajax=1;
require_once $depth.'../login/login_check.php';
if($action=='time'||$action=='index-all'||$action=='index-all-line'){
	$query="SELECT * FROM {$met_visit_summary} WHERE stattime >='{$st}' and stattime<='{$et}'";
	$result= $db->query($query);
	while($list = $db->fetch_array($result)){
		$suy=explode('|',$list['parttime']);
		for($i=0;$i<24;$i++){
			$ky=explode('-',$suy[$i]);
			$summary_pv[$i]=$ky[0]==''?0:$ky[0];
			$summary_ip[$i]=$ky[1]==''?0:$ky[1];
			$summary_al[$i]=$ky[2]==''?0:$ky[2];
		}
		$summary[]=$list;
	}
}
switch($action){
	case 'time':
		$ml=date('G')-23;
		if($ml<0){
			$p=24+$ml;
			$ztime=statime("Y-m-d","-1 day");
			$ztdat=$db->get_one("SELECT * FROM {$met_visit_summary} WHERE stattime='{$ztime}'");
			$suy=$ztdat?explode('|',$ztdat['parttime']):'';
			for($i=0;$i<24;$i++){
				if($i>=$p){
					$ky=explode('-',$suy[$i]);
					if(!$ky || $ky[0]==''){$ky[0]=0;$ky[1]=0;$ky[2]=0;}
					$summary_pv[$i]=$ky[0];
					$summary_ip[$i]=$ky[1];
					$summary_al[$i]=$ky[2];
				}
			}
		}
		$lystk1958 = "<graph BGCOLOR='F8F8F8' yAxisMinValue='0' decimalPrecision='0' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' anchorRadius='4' anchorBgColor='ffffff' baseFontSize='12' canvasBorderColor='cccccc' canvasBorderThickness='1' 
		shadowAlpha='30' numVDivLines ='22' showAlternateVGridColor='1' alternateVGridAlpha='5' outCnvbaseFontSize='10' formatNumberScale='0'
		>";
		$dtm=date('Y-m-d');
		$lystk1958.= '<categories>';
		for($i=0;$i<24;$i++){
			if($p==24)$p=0;
			$lp=$p%2==0?1:0;
			$dtms=$dtm;
			if($p>date('G'))$dtms=date("Y-m-d",statime("Y-m-d","-1 day"));
			$lystk1958.=$sys?"<category name='{$p}' showName='{$lp}' hoverText='{$dtms} {$p}'/>":"<category name='{$p}:00' showName='{$lp}' hoverText='{$dtms} {$p}:00'/>";
			$p++;
		}
		$lystk1958.= '</categories>';
		/*PV*/
		$lystk1958.= "<dataset seriesName='{$lang_statpv}' color='0033ca' anchorBorderColor='0033ca' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<24;$i++){
			if($p==24)$p=0;
			$lp=$p%2==0?1:0;
			if(!$summary_pv[$p])$summary_pv[$p]=0;
			$lystk1958.="<set value='{$summary_pv[$p]}' />";
			$p++;
		}
		$lystk1958.= '</dataset>';
		/*IP*/
		$lystk1958.= "<dataset seriesName='{$lang_statip}' color='fd0100' anchorBorderColor='fd0100' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<24;$i++){
			if($p==24)$p=0;
			$lp=$p%2==0?1:0;
			if(!$summary_ip[$p])$summary_ip[$p]=0;
			$lystk1958.="<set value='{$summary_ip[$p]}' />";
			$p++;
		}
		$lystk1958.= '</dataset>';
		/*独立访客*/
		$lystk1958.= "<dataset seriesName='{$lang_statvisitors}' color='2AD62A' anchorBorderColor='2AD62A' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<24;$i++){
			if($p==24)$p=0;
			$lp=$p%2==0?1:0;
			if(!$summary_al[$p])$summary_al[$p]=0;
			$lystk1958.="<set value='{$summary_al[$p]}' />";
			$p++;
		}
		$lystk1958.= '</dataset>';
		$lystk1958.= '</graph>';
	break;
	case 'index-all':
		$charcor=array(0=>'afd8f8',1=>'f6bd0e',2=>'90ad37',3=>'e0976a',4=>'008e8f',5=>'d64646',6=>'8e4690',7=>'657652',8=>'fff467',9=>'008ed6',10=>'9d080c',11=>'a186bd',12=>'cc6601',13=>'fcc688',14=>'aca000',15=>'f26d7e',16=>'fef200',17=>'085299',18=>'f7941c',19=>'cd3301',20=>'006600',21=>'663200',22=>'afd8f8',23=>'f7941c');
		$lystk1958 = "<graph BGCOLOR='F8F8F8' yAxisMinValue='0' decimalPrecision='0' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' baseFontSize='12' canvasBorderColor='cccccc' canvasBorderThickness='1' showColumnShadow='0' shadowAlpha='30' outCnvbaseFontSize='10' formatNumberScale='0'>";
		$dtm=date('Y-m-d',$st);
		for($i=0;$i<24;$i++){
			$lp=$i%2==0?1:0;
			$lystk1958.="<set name='{$i}:00' showName='{$lp}'";
			if(!$dtype || $dtype=='pv')$lystk1958.=" value='{$summary_pv[$i]}' hoverText='{$lang_statpv}:{$dtm} {$i}:00'";
			if($dtype=='ip')$lystk1958.=" value='{$summary_ip[$i]}' hoverText='{$lang_statip}:{$dtm} {$i}:00'";
			if($dtype=='al')$lystk1958.=" value='{$summary_al[$i]}' hoverText='{$lang_statvisitors}:{$dtm} {$i}:00'";
			$lystk1958.=" color='{$charcor[$i]}'/>";
		}
		$lystk1958.= '</graph>';
	break;
	case 'index-all-line':
		$mp=($et-$st)/60/60/24+1;
		$Lines=$mp-2;
		$lystk1958 = "<graph BGCOLOR='F8F8F8' yAxisMinValue='0' decimalPrecision='0' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5' baseFontSize='12' canvasBorderColor='cccccc' canvasBorderThickness='1' showColumnShadow='0' shadowAlpha='30' outCnvbaseFontSize='10' formatNumberScale='0' chartRightMargin='34' numVDivLines ='{$Lines}' showAlternateVGridColor='1' alternateVGridAlpha='5'>";
		$lystk1958.= '<categories>';
		for($i=0;$i<$mp;$i++){
			$p=$st+($i*60*60*24);
			$stattime=date('Y-m-d',$p);
			$lp=1;
			if($mp>7){
				$rk=$mp/7;
				$h=0;
				for($k=0;$k<7;$k++){
					if($i==round($rk*$k)){
						$h=1;
						break;
					}
				}
				$lp=$h;
			}
			$lystk1958.="<category name='{$stattime}' showName='{$lp}'/>";
		}
		$lystk1958.= '</categories>';
		/*PV*/
		$lystk1958.= "<dataset seriesName='{$lang_statpv}' color='1D8BD1' anchorBorderColor='1D8BD1' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<$mp;$i++){
			$p=$st+($i*60*60*24);
			$k=0;
			if($summary){
				foreach($summary as $key=>$val){
					if($val['stattime']==$p){
						$val['stattime']=date('Y-m-d',$val['stattime']);
						$lystk1958.="<set value='{$val[pv]}'/>";
						$k=1;
					}
				}
			}
			if($k==0){
				$lystk1958.="<set value='0'/>";
			}
		}
		$lystk1958.= '</dataset>';
		/*IP*/
		$lystk1958.= "<dataset seriesName='{$lang_statip}' color='fd0100' anchorBorderColor='fd0100' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<$mp;$i++){
			$p=$st+($i*60*60*24);
			$k=0;
			if($summary){
				foreach($summary as $key=>$val){
					if($val['stattime']==$p){
						$val['stattime']=date('Y-m-d',$val['stattime']);
						$lystk1958.="<set value='{$val[ip]}'/>";
						$k=1;
					}
				}
			}
			if($k==0){
				$lystk1958.="<set value='0'/>";
			}
		}
		$lystk1958.= '</dataset>';
		/*独立访客*/
		$lystk1958.= "<dataset seriesName='{$lang_statvisitors}' color='2AD62A' anchorBorderColor='2AD62A' anchorBgColor='ffffff' anchorSides='10' anchorRadius='4'>";
		for($i=0;$i<$mp;$i++){
			$p=$st+($i*60*60*24);
			$k=0;
			if($summary){
				foreach($summary as $key=>$val){
					if($val['stattime']==$p){
						$val['stattime']=date('Y-m-d',$val['stattime']);
						$lystk1958.="<set value='{$val[alone]}'/>";
						$k=1;
					}
				}
			}
			if($k==0){
				$lystk1958.="<set value='0'/>";
			}
		}
		$lystk1958.= '</dataset>';
		$lystk1958.= '</graph>';
	break;
	case 'engine':
		$yqnum=explode('|',$yqnum);
		$lystk1958 ="<graph decimalPrecision='0' showPercentageValues='1' showNames='1' showValues='0' showPercentageInLabel='0' pieYScale='45' pieBorderAlpha='100' baseFontSize='12' pieRadius='100' animation='0' shadowXShift='4' shadowYShift='4' shadowAlpha='40' pieFillAlpha='95' pieBorderColor='FFFFFF' BGCOLOR='F8F8F8'>";
		$t=0;
		for($i=0;$i<count($yqnum);$i++){
			if($yqnum[$i]!=''){
				$p=explode('-',$yqnum[$i]);
				$p0=enginetype($p[0]);
				$t=$t+$p[1];
				$metdata[$i]['value']=$p[1];
				$metdata[$i]['name']=$p0;
			}
		}
		$h=0;
		foreach($metdata as $key=>$val){
			$b=sprintf("%.2f",$val[value]/$t)*100;
			if(count($yqnum)>4 && $b<4){
				$h=$h+$val['value'];
			}else{
				$lystk1958.="<set value='{$val[value]}' name='{$val[name]}'/>";
			}
		}
		if($h)$lystk1958.="<set value='{$h}' name='{$lang_statother}'/>";
		$lystk1958.="</graph>";
	break;
	case 'accept':
		if($yqnums){
			$query="select * from {$met_visit_detail} WHERE stattime>='{$st}' and stattime<='{$et}' and type='3' order by pv desc";
			$result= $db->query($query);
			$domain=array();
			while($list = $db->fetch_array($result)){
				preg_match_all( '/(http:\/\/.*?)\/.*?/i ',$list['name'],$d);
				$do=explode('http://',$d[1][0]);
				if($do[1]=='')$do[1]=$lang_statweb;
				$domain[$do[1]]['pv']=$domain[$do[1]]['pv']+$list['pv'];
			}
			array_multisort($domain,SORT_DESC);
			foreach($domain as $key=>$val){
				$yqnum.=$key.'$'.$val['pv'].'|';
			}
		}
		$yqnum=explode('|',urldecode($yqnum));
		$lystk1958 ="<graph decimalPrecision='0' showPercentageValues='1' showNames='1' showValues='0' showPercentageInLabel='0' pieYScale='45' pieBorderAlpha='100' baseFontSize='12' pieRadius='100' animation='0' shadowXShift='4' shadowYShift='4' shadowAlpha='40' pieFillAlpha='95' pieBorderColor='FFFFFF' BGCOLOR='F8F8F8'>";
		$t=0;
		for($i=0;$i<count($yqnum);$i++){
			if($yqnum[$i]!=''){
				$p=explode('$',$yqnum[$i]);
				$t=$t+$p[1];
				$metdata[$i]['value']=$p[1];
				$metdata[$i]['name']=$cny?$met_langok[$p[0]]['name']:$p[0];
			}
		}
		$h=0;
		foreach($metdata as $key=>$val){
			$b=sprintf("%.2f",$val[value]/$t)*100;
			if(count($yqnum)>4 && $b<4){
				$h=$h+$val['value'];
			}else{
				$lystk1958.="<set value='{$val[value]}' name='{$val[name]}'/>";
			}
		}
		if($h)$lystk1958.="<set value='{$h}' name='{$lang_statother}'/>";
		$lystk1958.="</graph>";
	break;
}	
	if($action!='dizhi')$lystk1958=iconv("UTF-8", "GB2312//IGNORE",$lystk1958);
	echo $lystk1958;
  
  # Copyright (C) Lystk1958 Co., Ltd. (http://www.lystk1958.com.cn). All rights reserved.
?>
