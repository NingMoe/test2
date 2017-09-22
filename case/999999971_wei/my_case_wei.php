<?php

    define('ACCESS_TOKEN','F3KOuRQYrUhpjZDbRYP0vjFZuDMgolvoNvOjhgnuLPEL4At5E88w9mtpjhEAP1Z0B-Rx4yMQ26H6PguEnDOZrksRM-gJHlOQUKgdkIlPCH6mMHVo3TYzkm99DsSzzUnYAMQfABANZD');
    define('APPID','wxc87f294e08796db0');
    define('APPSECRET','5b0d6af4d1cba2b016bb5146675b976c');


    define('OPENID','oTNuQuJI0Y_826iqmHy-ELLuCYZU');
    // define('OPENID','oTNuQuH9gt5KwwVolsHkdUE6yvzI');

    // 获取 ACCESS_TOKEN
    $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.APPID.'&secret='.APPSECRET;
    $data='';

  
    // 设置所属行业 
    $url='https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token='.ACCESS_TOKEN;
    $data=array(  
          "industry_id1"=>"1",
          "industry_id2"=>"4"
       );


    // 永久二维码请求说明
    $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.ACCESS_TOKEN;
    $data=array("action_name"=>"QR_LIMIT_SCENE", "action_info"=>array("scene"=>array("scene_id"=>123)));
    $data=array("action_name"=>"QR_LIMIT_STR_SCENE", "action_info"=>array("scene"=>array("scene_str"=>"123")));


    // 临时二维码请求说明 http://weixin.qq.com/q/LkMDH-blvBfF2Mei822I
    $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.ACCESS_TOKEN;
    $data=array("expire_seconds"=>604800, "action_name"=>"QR_SCENE", 
        "action_info"=>array("scene"=>array("scene_id"=>'100000')));


    // 获取所有客服账号
    $url='https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token='.ACCESS_TOKEN;
    $data='';

    // 添加客服帐号
    $url='https://api.weixin.qq.com/customservice/kfaccount/add?access_token='.ACCESS_TOKEN;
    $data=array(
    "kf_account" => "flysky@yudong212104",
     "nickname" => "客服1",
     "password" => md5('fsder26415'),
        );

    // 客服接口-发消息
    $url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.ACCESS_TOKEN;
    $data=array(
        "touser"=>OPENID,
        "msgtype"=>"text",
        "text"=>
        array(
             "content"=>"永久二维码请求说明"
        )
    );
   

    // 获取客服聊天记录接口

    $url='https://api.weixin.qq.com/customservice/msgrecord/getrecord?access_token='.ACCESS_TOKEN;
    $data=array("endtime" => 1464261920,
    "pageindex" => 1,
    "pagesize" => 10,
    "starttime" => 123456789
    );



    // 通过ticket换取二维码  http://weixin.qq.com/q/60N3XszlzBe1ZgLnh22I

// {
//   "expire_seconds": 604800, 
//   "ticket": "gQHi7zoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0lrUFpOdkhsZlJjRV9zdVFLVzJJAAIEF0pFVwMEgDoJAA==", 
//   "url": "http://weixin.qq.com/q/IkPZNvHlfRcE_suQKW2I"
// }

    // define('TICKET','gQHi7zoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL0lrUFpOdkhsZlJjRV9zdVFLVzJJAAIEF0pFVwMEgDoJAA==');
    // $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.TICKET;
    // $data='';
    // header("Content-type: image/jpeg");





    $back=https_request($url,$data,array('ssl'=>1,'json'=>1));

    $url='http://mynotes.com/test/test.php';


    echo $back ;
    die();
         


    /**
     * http请求  模拟登陆
     * @ $url    请求的地址
     * @ $data   发送的参数
     * $parm_cookie=array('url'=>'','data'=>null,'cookie'=>'cookiefile','use'=>false)
     * $option=array('ssl'=>false,'referer'=>false,'ip'=>false,'json'=>false)
     */
    function https_request($url,$data = '',$option=array(),$parm_cookie=array('use'=>false)){
        $curl = curl_init();
        $parm_cookie=array_merge(array( // 获取COOKIE的默认参数
            'cookie'=>'E:\www\mynotes\test\wwwmynotestestcookiefile.txt',
            'url'=>$url,
            'data'=>array(),
            ),$parm_cookie);
             
        if($parm_cookie['use']=== true && (!file_exists($parm_cookie['cookie']) || filesize($parm_cookie['cookie']) < 100)){getCookie($curl,$parm_cookie); }
       

        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的网址
        if(isset($option['ssl']))curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        if($parm_cookie['use']=== true)curl_setopt($curl, CURLOPT_COOKIEFILE, $parm_cookie['cookie']);
        if(isset($option['referer']))curl_setopt($curl, CURLOPT_REFERER, $referer);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 设置不直接打印

        $header=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");

        // post 三个参数设置
        if(!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            // curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            if(isset($option['json'])){
                if(is_array($data))$data=json_encode($data);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // 可以支持三维数组  
                $header=array('User-Agent:Firefox',"application/json;charset=utf-8",'Content-Length: '.strlen($data));
            }else{

                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data)); // 可以支持三维数组
            }      
        }


        if(isset($option['ip']))$header=array_merge($header,array('CLIENT-IP:'.$ip,'X-FORWARDED-FOR:'.$ip)); 
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




?>