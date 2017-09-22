<?php
header('Content-Type:text/html;charset=utf-8');
ini_set("max_execution_time", "18000");
ini_set("memory_limit", "2048M");
error_reporting(E_ALL);
ini_set( 'display_errors', 'Off' ); // Off
date_default_timezone_set('PRC'); // PRC
// sleep(2); 秒
// usleep(1666666) — 以指定的微秒数延迟执行 百万分之一秒
// echo date('Y-m-d H:i:s')."\n\n";
// 支付接口调试


    
    

    $url = 'http://jindouyun.gz11.hostadm.net/ecsapi/index.php';  // 测试空间

    $url = 'http://jindou.com/ecsapi/index.php'; // 本地


    //   'predeposit&op=index';
    //   'login';   // 登陆

    // $url .=       'member_index'; //用户信息


    $data=array_merge($data,array(
        // 'username'=>'admin',
        // 'password'=>'123456',
        // 'client'=>'wechat',
        'name'=>'陈育东',
    ));
    


    $get=array();
    if(strpos($url,'?') !== false){
        foreach(explode('&',substr($url,strpos($url,'?')+1)) as $v){
            $tem=explode('=',$v);
            $get[$tem['0']]=$tem['1'];
        }
    }
    $data['api_sign']=_getSign($secret,array_merge($get,$data));
    $back=https_request($url,$data,false,'http://www.mynotes.com/test/test.php');


    $back_str=json_decode($back,true);
    if($back_str){
        var_export( $back_str );
    }else{
        var_export( $back );
    }

    die();
         
         
    /* 公司接口验证用 */
    function _getSign($secret, $param)
    {
        $token = $secret;
        $token .= _loopArrayToken($param);
        $token .= $secret;
        // var_dump( $token );
        // die();
             
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


