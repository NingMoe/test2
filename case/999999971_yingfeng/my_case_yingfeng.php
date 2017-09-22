<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);
$secret='ba8a48b0e34226a2992d871c65600a7c';
$data=array('api_key'=>'472cef95417718e7890985a74ca1dabf');
$host='http://www.wzwmarket.com/';// 测试
// $user_id='65';// 测试
// $user_id='778';// 测试
// $token='9+arPw0RnQ2K7+4';// 本地
$user_id='6741';// 本地
$token='\/bCqPF8WzwmL7+JD';// 本地

// $host='http://yingfeng.com/';// 本地
// $user_id='6741';// 本地
// $token='\/bCqPF8WzwmL7+JD';// 本地
// // 首页
$url =$host.'index.php';        //
$data=array_merge($data,array(
    // 'act'=>'activity_list',
));

// 加入购物车
$url =$host."flow.php?user_id=$user_id&token=$token";
// $data=array_merge($data,array(
//     'step'=>'add_to_cart',
//     'goods_id'=>'6121',
//     'number'=>'1',
//     'parent'=>'0',
//     'spec'=>'0',
//     'quick'=>'0',
// ));

$data=array_merge($data,array(
    'step'=>'checkout',
    // 'goods_id'=>'6121',
));
$address_id='1625';
// $address_id='4392';
$url =$host."flow.php?user_id=$user_id&token=$token&address_id=$address_id";
$data=array_merge($data,array(
    'step'=>'done',
    // 'sel_cartgoods'=>'done',
    'pay_id'=>'35', // 翼支付
    'shipping_id'=>'34',
));


// 翼支付获取订单信息跟回调地址
$url =$host."bestpay.php?user_id=$user_id&token=$token";
$data=array_merge($data,array(
    'order_sn'=>'2017080465392',
));

// 翼支付回调地址
$url = $host.'bestpay/notify.php';
// // 选择支付方式
$data=array_merge($data,array(
    'RETNCODE' => '0000',
    'SIGN' => 'sssss',
    'ORDERSEQ' => '2017081121835', //交易单号
    'ORDERAMOUNT' => '0.01',  
));



// 会员
// $url =$host."user.php?user_id=$user_id&token=$token";
// // // // // 我的订单
// // $data=array_merge($data,array(
// //     'act'=>'order_list',
// // ));
// // // // 订单详情
// // $data=array_merge($data,array(
// //     'act'=>'order_detail',
// //     'order_id'=>'9503',
// // ));
// // // // 收货地址
// $data=array_merge($data,array(
//     'act'=>'address_list',
// ));
// // 会员中心
// $data=array_merge($data,array(
//     'act'=>'default',
// ));
//会员等级
// $data=array_merge($data,array(
//     'act'=>'user_rank',
// ));
//账户余额
// $data=array_merge($data,array(
//     'act'=>'account_manage',
// ));
//账户明细
// $data=array_merge($data,array(
//     'act'=>'account_detail',
//     // 'page'=>'1',
// ));
// //我要提现
// $data=array_merge($data,array(
//     'act'=>'act_account',
//     'amount'=>'1',// 金额
//     'real_name'=>'aa', // 收款人姓名
//     'card_name'=>'bb', // 收款银行名称
//     'card_no'=>'cc', // 收款银行卡号
//     'user_note'=>'xxx', // 备注  
// ));
// // //提现明细
// $data=array_merge($data,array(
//     'act'=>'account_log',
//     'page'=>'1',
// ));
// // //我的二维码
// $data=array_merge($data,array(
//     'act'=>'qrcode',
// ));
// // // //我的下级会员
// $data=array_merge($data,array(
//     'act'=>'level_user',
//     'page'=>'1',
// ));
// // // //下级会员订单
// $data=array_merge($data,array(
//     'act'=>'level_order',
//     'page'=>'1',
// ));
// // 登陆 +返回 rank_id
// $url =$host."user.php";
// $data=array_merge($data,array(
//     'act'=>'act_login',
//     'username'=>'13420246245',
//     'username'=>'15323372808',
//     // 'username'=>'xxx',
//     // 'password'=>'ssss',
//     'password'=>'123456',
// ));
// 注册
// $data=array_merge($data,array(
//     'act'=>'act_register',
//     'email'=>'13420246244',
//     'password'=>'123456',
//     'captcha'=>'123456',
//     'agreement'=>'1',
//     'parent_id'=>'1',
// ));
// 第三方登录
// $data=array_merge($data,array(
//     'act'=>'oath_login',
//     'aite_id'=>'ssss', //openid
//     'nice_name'=>'xxx', //微信昵称
//     'headimg'=>'https://www.baidu.com/img/baidu_jgylogo3.gif', //微信头像
//     'user_id'=>$user_id, // 已登陆，传会员id绑定微信
// ));


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
echo trim($back,'﻿');
exit;
// print_r(json_decode(trim($back,'﻿'),true));
// exit;
die();
/* 公司接口验证用 */
function _getSign($secret, $param)
{
    $token = $secret;
    $token .= _loopArrayToken($param);
    $token .= $secret;
    $token = strtoupper(md5(urlencode($token)));
    return $token;
}
function _loopArrayToken($param){
    $token = "";
    ksort($param);
    foreach($param as $k=>$v){
        if ($k=='headimg') continue;
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
 * http请求
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
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
/**
 * http请求  模拟登陆
 * @ $url    请求的地址
 * @ $data   发送的参数
 * array('url'=>'','data'=>null,'cookie'=>'cookiefile','use'=>false)
 */
function https_request($url,$data = '',$ssl=false,$referer=false,$parm_cookie=array('use'=>false)){
    $curl = curl_init();
    if($parm_cookie['use']=== true && (!file_exists($parm_cookie['cookie']) || filesize($parm_cookie['cookie']) < 100)){
        getCookie($curl,$parm_cookie);
    }
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
    if($ssl=== true)curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    if($parm_cookie['use']=== true)curl_setopt($curl, CURLOPT_COOKIEFILE, $parm_cookie['cookie']);
    if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    // post 三个参数设置
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
// 获取 cookie
function getCookie($curl,$pram){
    curl_setopt($curl, CURLOPT_URL, $pram['url']); // 要访问的网址
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
    // cookie 设置
    date_default_timezone_set('PRC');
    curl_setopt($curl, CURLOPT_COOKIESESSION, TRUE);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $pram['cookie']);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $pram['cookie']);
    curl_setopt($curl, CURLOPT_COOKIE,session_name().'='.session_id());
    curl_setopt($curl, CURLOPT_HEADER, 0); 
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
    // post 三个参数设置
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $pram['data']);
    $hear_arr=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8","Content-length: ".strlen($pram['data']));
    curl_setopt($curl, CURLOPT_HTTPHEADER,$hear_arr);
    curl_exec($curl);  // 执行
}
    /**
     * XML文档转为数组
     * @param string $xml XML文档字符串
     * @return array
     */
    function xmlToArray($xml) {
        return $xml ? xmlToArrayElement(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)) : array();
    }
   /**
     * xml文档转为数组元素
     * @param obj $xmlobject XML文档对象
     * @return array
     */
    function xmlToArrayElement($xmlobject) {
        $data = array();
        foreach ((array) $xmlobject as $key => $value){
            $data[$key] = !is_string($value) ? xmlToArrayElement($value) : $value;
        }
        return $data;
    }
?>