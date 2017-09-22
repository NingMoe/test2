<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);
echo "sd";exit;
    $secret='db4e2e01549ebef835a9f1b89b5b11cf';
    $data=array('api_key'=>'600300253268ea8b8d687fe1a79a2603');

    $url='http://yitaixiang.gz7.hostadm.net/';// 测试
    $url='http://yitaixiang.com/';// 本地

    // $token='e76824d9e17d3162ff915837466e488d';
    $user_id='65';// 测试
    $user_id='66';// 本地

    // 会员 address_list  act_edit_address  drop_consignee  act_address_default my_message  my_message_details my_message_del
    $url .='ecsapi/user.php?act='; 
    // 商品分类、列表
    // $url .='ecsapi/category.php?act='; 
    // 商品详情
    // $url .='ecsapi/goods.php?act='; 
    // 地区列表
    // $url .='ecsapi/region.php?act='; 

    $url .=  'member_index'; //用户信息

    // 删除我的消息
    // $data=array_merge($data,array(
    //     'act'=>'my_message_del',
    //     'user_id'=>$user_id, //会员id
    //     'msg_id'=>'3', //消息id
    // ));
    // 我的消息详情
    // $data=array_merge($data,array(
    //     'act'=>'my_message_details',
    //     'user_id'=>$user_id, //会员id
    //     'msg_id'=>'3', //消息id
    // ));
    // 我的消息
    $data=array_merge($data,array(
        'act'=>'my_message',
        'user_id'=>$user_id, //会员id
        'page'=>'1', //分页页码
    ));
    // 设置默认收货地址
    // $data=array_merge($data,array(
    //     'act'=>'act_address_default',
    //     'user_id'=>$user_id, //会员id
    //     'id'=>'77', //收货地址id
    // ));
    // 删除收货地址
    // $data=array_merge($data,array(
    //     'act'=>'drop_consignee',
    //     'user_id'=>$user_id, //会员id
    //     'id'=>'77', //收货地址id
    // ));
    // 添加或编辑收货地址
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_address',
    //     'user_id'=>$user_id, //会员id
    //     'address_id'=>'78', //收货地址id（修改的时候传）
    //     'country'=>'1', //国家id 中国为1
    //     'province'=>'6', //省id
    //     'city'=>'76', //市id
    //     'district'=>'698', //区id
    //     'address'=>'详细地址详细地址2222', //详细地址
    //     'consignee'=>'小明2', //收货人
    //     'mobile'=>'13420246245', //手机号码
    // ));
    // 我的收货地址
    // $data=array_merge($data,array(
    //     'act'=>'address_list',
    //     'user_id'=>$user_id, //会员id
    // ));

    // 地区列表 ecsapi/region.php?
    // $data=array_merge($data,array(
    //     // 'act'=>'',
    //     'type'=>3, //类型 0：国家（查省）1：省（查市）2市（查区）
    //     'parent'=>76, //地区id  国家只要中国，id为1，获取省就用type=1&parent=1
    // ));

    // 修改会员头像 user.php
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_img',
    //     'user_id'=>$user_id, //会员id
    //     'headimg'=>'@'.dirname(__FILE__).'\logo.png', //会员头像图片
    // ));

    // 我的订单 user.php
    // $data=array_merge($data,array(
    //     'act'=>'order_list',
    //     'user_id'=>$user_id, //会员id
    //     // 'composite_status'=>100, // 订单状态 100：待付款；101：待收货；103：待评论；104：已完成
    // ));

    // 收藏商品列表 user.php
    // $data=array_merge($data,array(
    //     'act'=>'collection_list',
    //     'user_id'=>$user_id, //会员id
    // ));


    // 获取商品分类 category.php
    // $data=array_merge($data,array(
    //     'act'=>'getcat',
    // ));
    // 获取商品列表category.php
    // $data=array_merge($data,array(
    //     'act'=>'get_goods',
    //     // 'user_id'=>$user_id, //会员id（有就传）
    //     'cat_id'=>'', // 商品分类
    //     'sort'=>'', // shop_price（价格），click_count（人气），last_update（更新）
    //     'order'=>'', // ACS（顺序排列），DESC（倒叙排列）
    //     'keywords'=>'', // 搜索是传的值
    //     'page'=>'', // 页数
    // ));
    // 获取商品详情category.php
    // $data=array_merge($data,array(
    //     'act'=>'goodsedit',
    //     'goods_id'=>'28', // 商品id
    // ));





    // //获取验证码
    // $data=array_merge($data,array(
    //     'act'=>'send_message',
    //     'phone'=>'13420246245', //手机号码
    //     'send_type'=>'1',  //发送类型（1：注册验证码，2忘记密码验证码）
    // ));
    //注册
    // $data=array_merge($data,array(
    //     'act'=>'register',
    //     'mobile_phone'=>'13420246245', //手机号码
    //     'mobile_code'=>'',//验证码（暂时可不填）
    //     'password'=>'123456',
    //     'confirm_password'=>'123456',
    //     'agreement'=>1,
    // ));
    // //登录
    // $data=array_merge($data,array(
    //     'act'=>'act_login',
    //     'user_name'=>'13420246245',
    //     'password'=>'123456',
    // ));
    // // 获取会员信息
    // $data=array_merge($data,array(
    //     'act'=>'get_user_info',
    //     'user_id'=>$user_id, //会员id 
    // ));
    // // 修改会员信息
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_profile',
    //     'user_id'=>$user_id, //会员id 
    //     'username'=>'1234567890',  //用户名
    //     'mobile_phone'=>'13420246245',  //手机号码
    //     'real_name'=>'成铭', //姓名
    // ));
    // // 修改密码
    // $data=array_merge($data,array(
    //     'act'=>'act_edit_password',
    //     'old_password'=>'1234567890',  //原密码
    //     'new_password'=>'123456', //新密码
    //     'confirm_password'=>'123456', //确认密码
    //     'user_id'=>$user_id, //会员id 
    // ));
    // //忘记密码
    // $data=array_merge($data,array(
    //     'act'=>'reset_passwd',
    //     'mobile_phone'=>'13420246245', //手机号码
    //     'mobile_code'=>'adfsd', //验证码
    //     'new_password'=>'1234567890',        //新密码
    //     'confirm_password'=>'1234567890 ',    //确认密码
    // ));
    // 退出//logout
    // $data=array_merge($data,array(
    //     'userAgent'=>'iphone',
    //     'token'=>'8c0990b6949343f15cc388ec8c8cb0c5',
    //     'act'=>'logout',
    // ));


    // $get=array('op'=>'index');
    if(strpos($url,'?') !== false){
        foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
            $tem=explode('=',$v);
            $get[$tem['0']]=$tem['1'];
        }
    }
    $data['api_sign']=_getSign($secret,array_merge($get,$data));
    $back=https_request($url,$data,false,'http://localhost/zhida/test/test.php');

    // echo $back;

    if( strpos($back,'"code"') !== false && strpos($back,'msg"') !== false  ){
        var_export( json_decode($back,true));//str_replace('\/', '/',$back);
    }else{
        var_export( $back );//str_replace('\/', '/',$back);
    }
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
        foreach ((array) $xmlobject as $key => $value) {
            $data[$key] = !is_string($value) ? xmlToArrayElement($value) : $value;
        }
        return $data;
    }
?>