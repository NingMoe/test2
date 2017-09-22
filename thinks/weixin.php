<?php
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger')){
	// $weixinconfig = $GLOBALS['db']->getRow ( "SELECT * FROM " . $GLOBALS['ecs']->table('weixin_config') . " WHERE `id` = 1" );
	// $appid = $weixinconfig['appid'];
	// $secret =$weixinconfig['appsecret'];
	$appid = '';
	$secret = '';
	$request_uri = strtolower($_SERVER['REQUEST_URI']);
	$uri = 'http://'.$_SERVER['SERVER_NAME'].$request_uri;
	$url = urlencode($uri);
    $code=isset($_GET['code'])?$_GET['code']:null;
    if($code == null){
      $str="https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri=".$url."&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
      header ("Location:".$str);
    }else{
		$str2="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code=".$code."&grant_type=authorization_code";
		$output = wei_curl($str2);
		$output=json_decode($output,true);
		$access_token = $output['access_token'];
		$openid = $output['openid'];
        if($openid)
        {
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}";
            $res_user = wei_curl($url);
            $wx_user = json_decode($res_user, true);
            print_r($wx_user);
        }else{
        	echo "获取失败";
        }
    }
    echo "ss";exit;
}
function wei_curl($url, $data=null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);   //只需要设置一个秒的数量就可以
    $output = curl_exec($ch);
    if(curl_errno($ch)>0) error_log(curl_error($ch)." \n", 3, "curl_err.log");
    curl_close($ch);
    return $output;
}