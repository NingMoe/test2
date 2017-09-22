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

    $url='http://www.hxjtcjh.cn/alugzaod/privilege.php?act=signin';
    $url='http://www.hxjtcjh.cn/ALugzaod/order.php?act=list';
    $url='http://mynotes.com/test/test.php';
    $data=array('uu'=>444,'checkLoge'=>'jfdksjfeifjefjewJJFJJFEHH3erh3h89eh',
    'username' => 'admin',
    'password' => 'ad123min456',
    );
    echo https_request($url,$data,false,'http://www.hxjtcjh.cn/ALugzaod/privilege.php?act=signin',array('use'=>True,'data'=>array('df'=>4354)),'59.41.99.68') ;
    die();
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
        // 初始设置
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
        if($parm_cookie['use']=== true)curl_setopt($curl, CURLOPT_COOKIEFILE, $parm_cookie['cookie']);
        if($referer)curl_setopt($curl, CURLOPT_REFERER, $referer);
        if( $ssl   )curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        // post 三个参数设置
        if($data!==''){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        // header
        $header=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
        if($ip)$header=array_merge($header,array('CLIENT-IP:'.$ip,'X-FORWARDED-FOR:'.$ip)); 
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
        // 执行
        $output=curl_exec($curl);
        if(curl_errno($curl))$output= 'Curl error: '.curl_error($curl);
        curl_close($curl);  // 关闭
        return $output;
    }
    // 获取 cookie
    function getCookie($curl,$pram){
        date_default_timezone_set('PRC');
        // 初始
        curl_setopt($curl, CURLOPT_URL, $pram['url']); // 要访问的网址
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印
        // cookie 设置
        curl_setopt($curl, CURLOPT_COOKIESESSION, TRUE);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $pram['cookie']);
        curl_setopt($curl, CURLOPT_COOKIEJAR, $pram['cookie']);
        curl_setopt($curl, CURLOPT_COOKIE,session_name().'='.session_id());
        curl_setopt($curl, CURLOPT_HEADER, 0); 
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
        // post 三个参数设置
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $pram['data']);
        // header
        $header=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);  
        // 执行
        curl_exec($curl);  // 执行
    }
/*
*/
?>
