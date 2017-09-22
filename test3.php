<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
ini_set('max_execution_time', '0');
error_reporting(E_ALL);


$notify_info = getXmlArray();
print_r($notify_info);
exit;

function getXmlArray() {
    $xmlData = file_get_contents("php://input");
    if ($xmlData){
            $postObj = simplexml_load_string($xmlData, 'SimpleXMLElement', LIBXML_NOCDATA);     
            if (! is_object($postObj)){
                    return false;
            }
            $array = json_decode(json_encode($postObj), true); // xml对象转数组    
            return array_change_key_case($array, CASE_LOWER); // 所有键小写
    }else{
            return false;
    }        
}


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
                // curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        $hear_arr=array('User-Agent:Firefox',"application/x-www-form-urlencoded;charset=utf-8");
        curl_setopt($curl, CURLOPT_HTTPHEADER,$hear_arr);
        $output=curl_exec($curl);  // 执行
        if(curl_errno($curl))$output= 'Curl error: '.curl_error($curl);
        curl_close($curl);  // 关闭
        return $output;
}
