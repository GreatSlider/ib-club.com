<?php


function unixdate($date) {
	list($dd,$hh)=explode(" ",$date);
	list($y,$m,$d)=explode("-",$dd);
	list($h,$i,$s)=explode(":",$hh);
	return mktime($h,$i,$s,$m,$d,$y);
}

function rusdate($date) {
	list($y,$m,$d)=explode("-",$date);
	$rusdat="$d.$m.$y";
	return $rusdat;
}

function rusdatetime($date) {
	list($dd,$tt)=explode(" ",$date);
	list($h,$i,$s)=explode(":",$tt);
	list($y,$m,$d)=explode("-",$dd);
	$rusdat="$d.$m.$y $h:$i";
	return $rusdat;
}

function diffmin($datenow,$dateto) {
	if (strlen($datenow)==0) $datenow = date("Y-m-d H:i:s");
	if (strlen($dateto)==0) $dateto = date("Y-m-d H:i:s");
	$datenow=unixdate($datenow);
	$dateto=unixdate($dateto);
	$diff=$datenow-$dateto;
	$diff=round($diff/60);
	return $diff;
}

function diffsec($datenow,$dateto) {
	if (strlen($datenow)==0) $datenow = date("Y-m-d H:i:s");
	if (strlen($dateto)==0) $dateto = date("Y-m-d H:i:s");
	$datenow=unixdate($datenow);
	$dateto=unixdate($dateto);
	$diff=$datenow-$dateto;
	return $diff;
}

function format_phone($str) {
	$suff="";$str=trim($str);
	$str=preg_replace("#[\(\)]#","",$str);
	if (stripos($str,":")!==false) {
		list($str,$suff)=explode(":",$str);
		$str=trim($str);
		$str=preg_replace("#[\(\)\[\]{}]\s\.:\-#","",$str);

		$suff=trim($suff);
		$suff=preg_replace("#[\(\)\[\]{}]#","",$suff);
		$suff=preg_replace("/\s\s+/"," ",$suff);
	}
	if (strlen($str)==13) {
		$ph=@explode("-",$str);
		if (count($ph)==3 and strlen($ph[2])==7) {
			$ph[2]=substr($ph[2],0,3)."-".substr($ph[2],3,2)."-".substr($ph[2],5,2);
			$str="+".$ph[0]." (".$ph[1].") ".$ph[2];
		}
	} elseif(strlen($str)==11) {
		$str="+".substr($str,0,1)." (".substr($str,1,3).") ".substr($str,4,3)."-".substr($str,7,2)."-".substr($str,9,2);
	}
	if ($suff<>"") $str.=" : ".$suff;
	return $str;
}

function get_image_size($name,&$w,&$h){
	$image = new SimpleImage();
	$image->load($name);
	$w=$image->getWidth();
	$h=$image->getHeight();
}

function set_phone($c, $r, $n, $t) {
	if (!is_numeric($c) or !is_numeric($r) or !is_numeric($n)) return false;
	$phone=implode('-',array($c, $r, $n));
	$t=db_escape_string($t);
	if (strlen($t)) {
		return $phone.":".$t;
	} else {
		return $phone;
	}
}

function translate_en($str) {
	$rus=array("А","Б","В","Г","Д","Е","Ё","Ж","З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Ъ","Ы","Ь","Э","Ю","Я","а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я","+");
	$eng=array("A","B","V","G","D","E","E","Zh","Z","I","Y","K","L","M","N","O","P","R","S","T","U","F","Kh","Ts","Ch","Sh","Shch","","Y","","E","Yu","Ya","a","b","v","g","d","e","yo","zh","z","i","yi","k","l","m","n","o","p","r","s","t","u","f","kh","ts","ch","sh","shch","`","iy","j","ye","yu","ya","-");
	$resstr=str_replace($rus,$eng,$str);
	return $resstr;
}

function translate_seo($str) {
	mb_regex_encoding('UTF-8');
  mb_internal_encoding("UTF-8");
	$str=mb_strtolower($str,"UTF-8");
	$str=preg_replace('/\s\s+/', ' ', $str);
	$rus=array("а","б","в","г","д","е","ё","ж","з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц","ч","ш","щ","ъ","ы","ь","э","ю","я","+"," ",",",".",";",":","(",")","/"," ","\"","\'","«","»","`","\\");
	$eng=array("a","b","v","g","d","e","yo","zh","z","i","yi","k","l","m","n","o","p","r","s","t","u","f","kh","ts","ch","sh","shch","","iy","j","ye","yu","ya","","-","","","","","","","","_","","","","","","-");
	$resstr=str_replace($rus,$eng,$str);
	return $resstr;
}

function translate_ru($str) {
	$rus=array(
	 "ё","й","ю","я","э","ы","х","ц","а","б","в","г","д","е","ж","з","и","к","л","м","н","о","п","р","с","т","у","ф","ч","ш","щ","ъ","ь","-");
	$eng=array(
	 "yo","yi","yu","ya","ye","iy","kh","ts","a","b","v","g","d","e","zh","z","i","k","l","m","n","o","p","r","s","t","u","f","ch","sh","shch","`","j","+");
	$resstr=str_replace($eng,$rus,$str);
	return $resstr;
}

function rustxt2utf_mailheader($src) {
	return "=?UTF-8?B?".rtrim(base64_encode($src),"=")."=?=";
}

function getUserHostAddress() {

	if (isset($_SERVER["HTTP_CLIENT_IP"])) {
		$ip=$_SERVER["HTTP_CLIENT_IP"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		$ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
		$ip=$_SERVER["HTTP_X_FORWARDED"];
	} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
		$ip=$_SERVER["HTTP_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED"])) {
		$ip=$_SERVER["HTTP_FORWARDED"];
	} elseif (isset($_SERVER["HTTP_X_REAL_IP"])) {
		$ip=$_SERVER["HTTP_X_REAL_IP"];
	} else {
		$ip=$_SERVER["REMOTE_ADDR"];
	}
	$ip=trim (str_ireplace("unknown,","",$ip));
	return $ip;
}

function tolower(&$item, $key) {
    $item=mb_strtolower($item);
}
?>