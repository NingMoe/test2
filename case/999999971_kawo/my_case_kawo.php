<?php 
header('Content-Type:text/html;charset=utf-8');
// ini_set("max_execution_time", "18000");
// ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC'); //设置中国时区 
ini_set( 'display_errors', 1 ); // Off
error_reporting(E_ALL);



function demo(array $phoneList){
    $cnt = count($phoneList);  //测试数组大小
    $slice = 2;  //需要调用的进程数量
    $master = array_chunk($phoneList,floor($cnt/$slice));
    $childList = array();

    while($slice >= 0)
    {
        $pid = pcntl_fork();
        if($pid > 0){
            $childList[$pid] = 1;
            //$pid>0表示当前还在执行父进程的代码
            //这里最好啥都不做，每次执行pcntl_fork都会执行这里的代码。
            //这里的代码执行完之后 会将$pid设置为0，然后jump到pcntl_fork代码之后，重新做判断；
        }elseif($pid == 0){
            //这里写我们的逻辑
            foreach($master[$slice] as $val)
            {
                //这里发生短信
                echo sprintf("%s Child:%s  \r\n",$slice,$val);
            }
            //子进程执行完之后务必需要关闭;
            exit();
        }else
        {
            //程序发生错误也需要关闭程序
            exit();
        }
        $slice--;
    }

    // 等待所有子进程结束后回收资源
    while(!empty($childList)){
        $childPid = pcntl_wait($status);
        if ($childPid > 0){
            unset($childList[$childPid]);
        }
    }
}
$phoneList=array('11111','22222','3333333','444444','555555','66666','777777');
demo($phoneList);
exit;


































function multiple_threads_request($nodes){ 
        $mh = curl_multi_init(); 
        $curl_array = array(); 
        foreach($nodes as $i => $url) 
        { 
            $curl_array[$i] = curl_init($url); 
            curl_setopt($curl_array[$i], CURLOPT_RETURNTRANSFER, true); 
            curl_multi_add_handle($mh, $curl_array[$i]); 
        } 
        $running = NULL; 
        do { 
            usleep(10000); 
            curl_multi_exec($mh,$running); 
        } while($running > 0); 
         
        $res = array(); 
        foreach($nodes as $i => $url) 
        { 
            $res[$url] = curl_multi_getcontent($curl_array[$i]); 
        } 
         
        foreach($nodes as $i => $url){ 
            curl_multi_remove_handle($mh, $curl_array[$i]); 
        } 
        curl_multi_close($mh);        
        return $res; 
} 
// multiple_threads_request(array( 
//     'http://www.example.com', 
//     'http://www.example.net', 
// ));
// exit;


















function curl($urls = array(), $callback = '')
{
    $response = array();
    if (empty($urls)) {
        return $response;
    }
    $chs = curl_multi_init();
    $map = array();
    foreach($urls as $url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_NOSIGNAL, true);
        curl_multi_add_handle($chs, $ch);
        $map[strval($ch)] = $url;
    }
    do{
        if (($status = curl_multi_exec($chs, $active)) != CURLM_CALL_MULTI_PERFORM) {
            if ($status != CURLM_OK) { break; } //如果没有准备就绪，就再次调用curl_multi_exec
            while ($done = curl_multi_info_read($chs)) {
                $info = curl_getinfo($done["handle"]);
                $error = curl_error($done["handle"]);
                $result = curl_multi_getcontent($done["handle"]);
                $url = $map[strval($done["handle"])];
                $rtn = compact('info', 'error', 'result', 'url');
                if (trim($callback)) {
                    $callback($rtn);
                }
                $response[$url] = $rtn;
                curl_multi_remove_handle($chs, $done['handle']);
                curl_close($done['handle']);
                //如果仍然有未处理完毕的句柄，那么就select
                if ($active > 0) {
                    curl_multi_select($chs, 0.5); //此处会导致阻塞大概0.5秒。
                }
            }
        }
    }
    while($active > 0); //还有句柄处理还在进行中
    curl_multi_close($chs);
    return $response;
}
 
//使用方法
function deal($data){
    if ($data["error"] == '') {
        echo $data["url"]." -- ".$data["info"]["http_code"]."\n";
    } else {
        echo $data["url"]." -- ".$data["error"]."\n";
    }
}
$urls = array();
for ($i = 0; $i < 10; $i++) {
    $urls[] = 'http://www.baidu.com/s?wd=etao_'.$i;
    $urls[] = 'http://www.so.com/s?q=etao_'.$i;
    $urls[] = 'http://www.soso.com/q?w=etao_'.$i;
}
curl($urls, "deal"); 