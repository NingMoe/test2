<?php
header('Content-Type:text/html;charset=utf-8');
ini_set("max_execution_time", "18000");
ini_set("memory_limit", "2048M");
error_reporting(E_ALL);
ini_set( 'display_errors', 'Off' ); // Off
date_default_timezone_set('PRC'); // PRC
// sleep(2); 秒
// usleep(1666666) — 以指定的微秒数延迟执行 百万分之一秒
echo date('Y-m-d H:i:s')."\n\n";
// 支付接口调试

// pointorder.php  E:\www\zhourou\wap\tmpl\member\pointorder.html

    die();

    $secret='3e64e66634fe128b7d28c6a1a84bd853';
    $data=array('api_key'=>'5d62bdb2d75e45ca252db7f80f483d7d');

    $data['key']='6de2e64c3c2a5629a65f6774785905e9';  // 测试空间
    $url = 'http://zhourou.gz10.hunuo.net/api/index.php?act='; // 测试空间

    $data['key']='afece31d3e23aa06fbaf712bacebe0f1';  // 本地
    $url = 'http://zhourou.com/api/index.php?act='; // 本地
    
    unset($data['key']);

    //   'predeposit&op=index';
    //   'login';   // 登陆
    //   'member_pointorder&op=orderlist'; //礼品订单列表
    //   'member_order&op=order_list'; //订单列表
    //   'member_evaluate&op=list'; //交易评价
    //   'member_security&op=auth_ch'; //获取认证信息
    //   'member_security&op=modify_realname&form_submit=ok'; //提交认证信息
    //   'member_index'; //用户信息


    $url .=       'member_index'; //用户信息
         
    $data=array_merge($data,array(
        // 'username'=>'admin',
        // 'password'=>'123456',
        // 'client'=>'wechat',
        'name'=>'陈育东',
    ));
    
    $get=array('op'=>'index');
    if(strpos($url,'?') !== false){
        foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
            $tem=explode('=',$v);
            $get[$tem['0']]=$tem['1'];
        }
    }
    $data['api_sign']=_getSign($secret,array_merge($get,$data));
    $back=https_request($url,$data,false,'http://www.mynotes.com/test/test.php');

    if( strpos($back,'"code"') !== false && strpos($back,'message"') !== false  ){
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
        $token = strtoupper(md5($token));
        return $token;
    }
    function _loopArrayToken($param){
        $token = "";
        ksort($param);
        foreach($param as $k=>$v){
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
     * array('url'=>'','data'=>null,'cookie'=>'cookiefile','use'=>false)
     */
    function https_request($url,$data = '',$ssl=false,$referer=false,$parm_cookie=array('use'=>false),$ip=false){
        $curl = curl_init();
        $parm_cookie=array_merge(array( // 获取COOKIE的默认参数
            'cookie'=>'E:\www\mynotes\test\wwwmynotestestcookiefile.txt',
            'url'=>$url,
            'data'=>array(),
            ),$parm_cookie);
             
        if($parm_cookie['use']=== true && (!file_exists($parm_cookie['cookie']) || filesize($parm_cookie['cookie']) < 100)){getCookie($curl,$parm_cookie); }
       

        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
        if($ssl=== true)curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($parm_cookie['use']=== true)curl_setopt($curl, CURLOPT_COOKIEFILE, $parm_cookie['cookie']);
        if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印

        // post 三个参数设置
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }

        $header=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
        if($ip)$header=array_merge($header,array('CLIENT-IP:'.$ip,'X-FORWARDED-FOR:'.$ip)); 
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);

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

        $header=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);             
        curl_exec($curl);  // 执行
    }


/*
     
         
*/
?>


