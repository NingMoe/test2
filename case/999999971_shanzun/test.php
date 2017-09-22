<?php 
header('Content-Type:text/html;charset=utf-8');

$secret='f8607957de83b36867d2d6760d306687';
$data=array('api_key'=>'d4e5de80103c57294e7081f483c4ec99');

$host='http://shanzun.wx.hostadm.net/ecsapi/';// 测试
$user_id='101';// 测试

// $host='http://shanzun.com/ecsapi/';// 本地
// $user_id='84';// 本地

// 首页 
$url = $host.'index.php';

$data=array_merge($data,array(
    'act'=>'get_index',
    'user_id'=>$user_id, //会员id
));




//参数拼凑
$get=array();
if(strpos($url,'?') !== false){
    foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
        $tem=explode('=',$v);
        $get[$tem['0']]=$tem['1'];
    }
}
$data['api_sign']=_getSign($secret,array_merge($get,$data));
$back=https_request($url,$data);
print_r($back);
die();
/* 公司接口验证用 */
function _getSign($secret, $param)
{
    $token = $secret;
    $token .= _loopArrayToken($param);
    $token .= $secret;
    // $token = strtoupper(md5(urlencode($token)));
    $token = strtoupper(md5($token));
    return $token;
}
function _loopArrayToken($param){
    $token = "";
    ksort($param);
    foreach($param as $k=>$v){
        if ($k=='headimg'||$k=='face_card'||$k=='back_card'||$k=='video'||$k=='images0'||$k=='images1'||$k=='visa'||$k=='proof_residence'||$k=='location_verification') continue;
        if(is_array($v)){
            $token .="{$k}";
            $token .= _loopArrayToken($v);
        }else{
            $token .= "{$k}{$v}";
        }
    }
    return stripslashes($token);
}
/**
 * http请求  模拟登陆
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
function https_request($url,$data = '',$ssl=false,$referer=false){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
    if($ssl=== true)curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    if($data!==''){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    $hear_arr=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
    curl_setopt($curl, CURLOPT_HTTPHEADER,$hear_arr);
    $output=curl_exec($curl);  // 执行
    if(curl_errno($curl))$output= 'Curl error: '.curl_error($curl);
    curl_close($curl);  // 关闭
    return $output;
}
?>