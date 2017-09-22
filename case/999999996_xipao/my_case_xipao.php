<?php







// 支付接口调试
    $url = 'http://mall.dfxpjy.com/mobile/respond.php?code=alipay';
    $url = 'http://mall.dfxpjy.com/user.php?act=cancel_order&order_id=168';

    $data =    array (
        'code' => 'alipay',
        'discount' => '0.00',
        'payment_type' => '1',
        'subject' => '2016042521943',
        'trade_no' => '2016050321001004360288743576',
        'buyer_email' => '17092081531',
        'gmt_create' => '2016-05-03 16:29:09',
        'notify_type' => 'trade_status_sync',
        'quantity' => '1',
        'out_trade_no' => '201604252194316406',
        'seller_id' => '2088912295882602',
        'notify_time' => '2016-05-03 16:29:45',
        'trade_status' => 'TRADE_SUCCESS',
        'is_total_fee_adjust' => 'N',
        'total_fee' => '0.50',
        'gmt_payment' => '2016-05-03 16:29:45',
        'seller_email' => 'dfxpjy@sina.com',
        'price' => '10.50',
        'buyer_id' => '2088702257451362',
        'notify_id' => '54373306066424254c656c517a155c3is2',
        'use_coupon' => 'N',
        'sign_type' => 'MD5',
        'sign' => '6ad3d60479b693a530b04deb0f03791b',
        );
    $parm_cookie=array('url'=>'http://mall.dfxpjy.com/user.php',
            'data'=>'act=act_login&username=test_注册现金券&password=123456',
            'cookie'=>'E://testcookiefile.txt',
            'use'=>true
        );
    $str='';
    if(is_array($data)){
        foreach($data as $k=>$v){
            if($k=='signature')$v=urlencode($v);
            $str.=$str===''?$k.'='.$v:'&'.$k.'='.$v;
        }
    }else{
        $str=$data;
    }

    $back=https_request($url,$str,false,'http://www.mynotes.com/test/test.php');
    var_dump($back);
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



 $url= isset($_SERVER['PHP_SELF'])?$_SERVER['PHP_SELF']:(isset($_SERVER['SCRIPT_NAME'])?$_SERVER['SCRIPT_NAME']:'');
    $root_my_new=str_replace('','/',dirname(__FILE__)).'/';
    $tem_arr_uu=array(
        'pay_code'=>$pay_code,
        '_GET'=>$_GET,
        '_POST'=>$_POST,
        '_REQUEST'=>$_REQUEST,
        'url'=>$url,
        'HTTP_REFERER'=>isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:''
        );
    $time_prc=time() - date('Z') + 3600*8;
    file_put_contents($root_my_new.'11111.txt', "rn rn rn".date('Y-m-d H:i:s',$time_prc)."rn".var_export( $tem_arr_uu, true ) ,FILE_APPEND);  




    */


die();