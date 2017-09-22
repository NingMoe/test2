<?php
function sendSMS ($mobile, $content, $time = '', $mid = '')
{
	// $_POST['LoginName'] = $GLOBALS['_CFG']['ecsdxt_user_name']; // 用户账号
	// $_POST['CorpID']    = $GLOBALS['_CFG']['sms_sign'];
	// $strPasswd=$GLOBALS['_CFG']['ecsdxt_pass_word'];
	$_POST['LoginName'] = '互诺测试'; // 用户账号
	$_POST['CorpID']    = '302754';
	$strPasswd='152572';
	$_POST['send_no']   = $mobile; // 用户账号
	$_POST['msg']       = $content;

	$strTimeStamp=GetTimeString();
	$strInput=$_POST['CorpID'].$strPasswd.$strTimeStamp;
	$strMd5=md5($strInput);

	$_POST['LoginName'] = iconv('utf-8', 'gbk', $_POST['LoginName']);
	$_POST['msg'] = iconv('utf-8', 'gbk', $_POST['msg']);

	$url = "http://sms3.mobset.com/SDK2/Sms_Send.asp?CorpID=".$_POST['CorpID']."&LoginName=".rawurlencode($_POST['LoginName'])."&TimeStamp=".$strTimeStamp."&Passwd=".$strMd5."&send_no=".$_POST['send_no']."&Timer=".$_POST['Timer']. "&msg=" .rawurlencode($_POST['msg']);

	if(false)
	{
		$file_contents = @file_get_contents($url);
	}
	else
	{
		$ch = curl_init();
		$timeout = 5;
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
	}


	$status = explode(',',$file_contents);
	$status_code = $status[0];
	if($status_code > 0){
		echo '短信发送成功';
		return true;
	}else{
		//echo '短信发送失败'.$file_contents;
		return false;
	}

}


function GetTimeString()
{
	date_default_timezone_set('Asia/Shanghai');
	$timestamp=time();
	$hours = date('H',$timestamp);
	$minutes = date('i',$timestamp);
	$seconds =date('s',$timestamp);
	$month = date('m',$timestamp);
	$day =  date('d',$timestamp);
	$stamp= $month.$day.$hours.$minutes.$seconds;
	return $stamp;
}
?>