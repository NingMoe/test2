<?php
//百度提供天气预报查询接口API
function getWeather($cityName)
{
    if ($cityName == "" || (strstr($cityName, "+"))){
        return "发送天气+城市，例如'天气深圳'";
        exit;
    }
    $url = "http://api.map.baidu.com/telematics/v3/weather?location=".urlencode($cityName)."&output=json&ak=ECe3698802b9bf4457f0e01b544eb6aa";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($output, true);
    if ($result["error"] != 0){
        return $result["status"];
    }
    $curHour = (int)date('H',time());
    $weather = $result["results"][0];
    $weatherArray[] = array("Title" =>$weather['currentCity']."天气预报", "Description" =>"", "PicUrl" =>"", "Url" =>"");
    for ($i = 0; $i < count($weather["weather_data"]); $i++) {
        $weatherArray[] = array("Title"=>
            $weather["weather_data"][$i]["date"]."\n".
            $weather["weather_data"][$i]["weather"]." ".
            $weather["weather_data"][$i]["wind"]." ".
            $weather["weather_data"][$i]["temperature"],
        "Description"=>"", 
        "PicUrl"=>(($curHour >= 6) && ($curHour < 18))?$weather["weather_data"][$i]["dayPictureUrl"]:$weather["weather_data"][$i]["nightPictureUrl"], "Url"=>"");
    }
    return $weatherArray;
}
//simsim机器人
function SimSimi($keyword) {
    //----------- 获取COOKIE ----------//  
    $url = "http://www.simsimi.com/";  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_HEADER,1);  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
    $content = curl_exec($ch);  
    list($header, $body) = explode("\r\n\r\n", $content);  
    preg_match("/set\-cookie:([^\r\n]*);/iU", $header, $matches);  
    $cookie = $matches[1];  
    curl_close($ch);  
    //----------- 抓 取 回 复 ----------//  
    $url = "http://www.simsimi.com/func/req?lc=ch&msg=$keyword";  
    $ch = curl_init($url);  
    curl_setopt($ch, CURLOPT_REFERER, "http://www.simsimi.com/talk.htm?lc=ch");  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);  
    $content = json_decode(curl_exec($ch),1);  
    curl_close($ch);  
    if($content['result']=='100'){  
        $content['response'];  
        return $content['response'];  
    }else{  
        return '我还不会回答这个问题...';  
    }  
}  
  //翻译函数
function fanyi($keyword){
    $keyword = trim(substr($keyword,6,strlen($keyword)-6));
    $tranurl="http://openapi.baidu.com/public/2.0/bmt/translate?client_id=9peNkh97N6B9GGj9zBke9tGQ&q={$keyword}&from=auto&to=auto";//百度翻译地址
    $transtr=file_get_contents($tranurl);//读入文件
    $transon=json_decode($transtr);//json解析
    //print_r($transon);
    $contentStr = $transon->trans_result[0]->dst;//读取翻译内容
    return $contentStr;
}
//
function jiqiren($keyword){
    $ch = curl_init();
    $url = 'http://apis.baidu.com/turing/turing/turing?key=879a6cb3afb84dbf4fc84a1df2ab7319&info={$keyword}&userid=eb2edb736';
    $header = array(
        'apikey: 99a09ae2cdc9ef20d2f64f5385e4637e',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);
    $transon=json_decode($res, true);
    return $transon[1];
}
  //快递查询函数
function getDindan($keyword){
    $keyword = trim(substr($keyword,6,strlen($keyword)-6));
    $status=array('0'=>'查询出错','1'=>'暂无记录','2'=>'在途中','3'=>'派送中','4'=>'已签收','5'=>'拒收','6'=>'疑难件','7'=>'退回');//构建快递状态数组
    $kuaidiurl="http://www.aikuaidi.cn/rest/?key=ff4735a30a7a4e5a8637146fd0e7cec9&order={$keyword}&id=shentong&show=xml";//快递地址
    $kuaidistr=file_get_contents($kuaidiurl);//读入文件
    $kuaidiobj=simplexml_load_string($kuaidistr);//xml解析
    $kuaidistatus = $kuaidiobj->Status;//获取快递状态
    $kuaistr=strval($kuaidistatus);//对象转换为字符串
    $contentStr0 =$status[$kuaistr];//根据数组返回
    foreach ($kuaidiobj->Data->Order as $a){    
     foreach ($a->Time as $b){
        foreach ($a->Content as $c){$m.="{$b}{$c}";}
        }
     }
    //遍历获取快递时间和事件
    $contentStr="你的快递单号{$keyword}{$contentStr0}{$m}";
    return $contentStr;
  }
  //笑话
function getJock(){
    $param=array(
        "key"   => "free",
        "appid" =>   "0",
        "msg"   =>   "笑话"
    );
    $datas=http("http://api.qingyunke.com/api.php",$param);
    $json=json_decode($datas);
    if($json->result==0){
        $content=str_replace("{br}","\n",$json->content);
    }else{
        $content="从前有座山,山上有座庙,庙里有个小和尚,-^-,连接出错,请稍后再试,^_^.";
    }
    return $content;
}
//点歌
function getSong($song_title){
    //$song_title="春天里";
    $m_param=array(
        "op"    =>"7",
        "mode"  =>"1",
        "count" =>"1",
        "title" =>$song_title
    );
    $song_datas=http("http://box.zhangmen.baidu.com/x",$m_param);  
    $song_utf8=utf8($song_datas,"gbk");
    preg_match_all('/\<name\>(.*?)\<\/name\>/s', $song_utf8, $matchs); 
    if(count($matchs)>1){
        $song_name=$matchs[1][0];
    }
    if(empty($song_name)){
        return "未找到这首歌,检查一下网络或咱们换一首吧.";
    }
    $param=array(
        "op"    =>"12",
        "count" =>"1",
        "title" =>trim("$song_name")
    );
    //查找作者的这首歌
    $datas=http("http://box.zhangmen.baidu.com/x",$param);
    $xml = new DOMDocument(); 
    $xml->loadXML($datas);
    $lst=$xml->getElementsByTagName('encode');
    //普通质量地址
    $item=$lst->item(0);
    $pre=$item->nodeValue;
    $suffix=$item->nextSibling->nodeValue;
    $MusicURL=str_replace(strrchr($pre, "/"),"",$pre)."/".str_replace(strrchr($suffix, "&"),"",$suffix);
    //高质量地址
    $item=$lst->item(0);
    $pre=$item->nodeValue;
    $suffix=$item->nextSibling->nodeValue;
    $HQMusicUrl=str_replace(strrchr($pre, "/"),"",$pre)."/".str_replace(strrchr($suffix, "&"),"",$suffix);
    $datas=array();
    $datas[]=str_replace('$', "", $song_name);//音乐标题
    $datas[]="来自互联网";//音乐描述
    $datas[]="$MusicURL";//音乐链接
    $datas[]="$HQMusicUrl";//高质量音乐链接，WIFI环境优先使用该链接播放音乐
    //sendLyric(str_replace('$$', "-", $song_name),$fromUser);
    return $datas;
}
//中英互译  歌词 藏头诗  机器人
function ajaxsns_comm($msg){
    $param=array(
        "key"   => "free",
        "appid" =>   "0",
        "msg"   =>   "$msg"
    );
    $datas=http("http://api.qingyunke.com/api.php",$param);
    $json=json_decode($datas);
    if($json->result==0){
        $content=str_replace("{br}","\n",$json->content);
        $content=str_replace("提示：按分类看笑话请发送“笑话分类”","",$content);
        $content=str_replace("菲菲","铭铭",$content);
        $content=str_replace("梅州行","就成铭",$content);
        $content=str_replace("u3j.net/mzxing","9chengming.com",$content);
    }else{
        $content="从前有座山,山上有座庙,庙里有个小和尚,-^-,连接出错,请稍后再试,^_^.";
    }
    return $content;
}
//百度api
function baiduapi($urld){
    $ch = curl_init();
    $url = $urld;
    $header = array(
        'apikey: 99a09ae2cdc9ef20d2f64f5385e4637e',
    );
    // 添加apikey到header
    curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // 执行HTTP请求
    curl_setopt($ch , CURLOPT_URL , $url);
    $res = curl_exec($ch);
    $resd=json_decode($res,true);
    return $resd;
}
//城市列表
function citylist($city){
    $url = 'http://apis.baidu.com/apistore/weatherservice/citylist?cityname='.urlencode($city);
    $citylist=baiduapi($url);
    if ($citylist['errNum']!=0){
        $content= $citylist['errNum'].$citylist['errMsg'];
    }else{
        $content="城市列表：\n";
        foreach($citylist['retData'] as $item){ 
            $content .= $item['province_cn'].$item['district_cn'].$item['name_cn']."\n";
        }
    }
    return $content;
}
//身份证
function idservice($id){
    $url = 'http://apis.baidu.com/apistore/idservice/id?id='.$id;
    $idservice=baiduapi($url);
    if ($idservice['errNum']!=0){
        $content= $idservice['errNum'].$idservice['errMsg'];
    }else{
        $content = "身份证查询：\n性别：".($idservice['retData']['sex']=='M'?'男':'女')."\n出生日期：".$idservice['retData']['birthday']."\n地址：".$idservice['retData']['address'];
    }
    return $content;
}
//手机号码归属地
function mobilephone($tel){
            $url = 'http://apis.baidu.com/apistore/mobilenumber/mobilenumber?phone='.$tel;
    $idservice=baiduapi($url);
    if ($idservice['errNum']==0){
        $content= '运营商:'.$idservice['retData']['supplier']."\n省份:".$idservice['retData']['province']."\n城市:".$idservice['retData']['city'];
    }else{
        $content = '获取失败。'.$idservice['retMsg'];
    }
    return $content;
}
//成语查询
function chengyu($chengyu){
             $url = 'http://apis.baidu.com/avatardata/chengyu/search?keyWord='.urlencode($chengyu).'&page=1&rows=5';
    $chengyu=baiduapi($url);
    if ($chengyu['error_code']!=0){
        $content= $chengyu['error_code'].$chengyu['reason'];
    }else{
        $content="成语查询：\n";
        foreach($chengyu['result'] as $item){ 
            $content .= $item['name']."\n";
            $url = 'http://apis.baidu.com/avatardata/chengyu/lookup?id='.$item['id'];
            $chengyu=baiduapi($url);
            if($chengyu['error_code']==0){
                $content .= $chengyu['result']['spell']."\n".$chengyu['result']['content']."\n\n";
            }
        }
    }
    return $content;
}
//猜一猜
function c1c(){
    $url = 'http://apis.baidu.com/txapi/naowan/naowan';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content="猜一猜：\n";
        $content .= $chengyu['newslist'][0]['quest']."\n答案：".$chengyu['newslist'][0]['result'];
    }
    return $content;
}
// 点歌
function songs($name,$page=1){
    $page=intval($page);
    $current_page=ceil($page/10);
    $key=($page-1)%10;
    $url = 'http://apis.baidu.com/geekery/music/query?s='.urlencode($name).'&size=10&page='.$current_page;
    $result=baiduapi($url);
    if ($result['status']!='success'){
        $content= $result['msg'].$result['code'];
    }else{
        if(is_array($result['data'])){
            $data=$result['data']['data'][$key];
            $url = 'http://apis.baidu.com/geekery/music/playinfo?hash='.$data['hash'];
            $result=baiduapi($url);
            if ($result['status']!='success'){
                $content= $result['msg'].$result['code'];
            }else{
                $content = $result['data'];
            }
        }
    }
    return $content;
}
//绕口令
function rkl(){
    $url = 'http://apis.baidu.com/txapi/rkl/rkl?num=1';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content .= $chengyu['newslist'][0]['content'];
    }
    return $content;
}
//生日预测
function shengri($m,$d){
    $url = 'http://apis.baidu.com/txapi/dob/dob?m='.$m."&d=".$d;
    $chengyu=baiduapi($url);
    // error_log( mb_strlen(strip_tags($chengyu['newslist'][0]['content']))." \n", 3, "curl_err.log");
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['title']."\n";
        $temp=strip_tags($chengyu['newslist'][0]['content']);
        if(mb_strlen($temp)>2000)
            $content .= mb_strcut($temp, 0, 2000, 'utf-8');
        else
            $content .= $temp;
    }
    return $content;
}
//周公解梦
function jiemeng($m){
    $url = 'http://apis.baidu.com/txapi/dream/dream?word='.$m;
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['title']."\n";
        $content .= $chengyu['newslist'][0]['result'];
    }
    return $content;
}
//名言警句
function mingyan(){
    $url = 'http://apis.baidu.com/txapi/dictum/dictum';
    $chengyu=baiduapi($url);
    if ($chengyu['msg']!='success'){
        $content= $chengyu['msg'].$chengyu['code'];
    }else{
        $content=$chengyu['newslist'][0]['mrname']."\n";
        $content .= $chengyu['newslist'][0]['content'];
    }
    return $content;
}
//今日油价
function youjia($prov){
    $url = 'http://apis.baidu.com/showapi_open_bus/oil_price/find?prov='.$prov;
    $chengyu=baiduapi($url);
    if ($chengyu['showapi_res_body']['list']==''){
        $content= '无相关信息';
    }else{
        $content=$chengyu['showapi_res_body']['list'][0]['prov']."\n";
        $content .= 'p90:'.$chengyu['showapi_res_body']['list'][0]['p90']."\n";
        $content .= 'p0:'.$chengyu['showapi_res_body']['list'][0]['p0']."\n";
        $content .= 'p97:'.$chengyu['showapi_res_body']['list'][0]['p97']."\n";
        $content .= 'p93:'.$chengyu['showapi_res_body']['list'][0]['p93']."\n";
        $content .= 'ct:'.$chengyu['showapi_res_body']['list'][0]['ct'];
    }
    return $content;
}
//星座运势
function xingzuo($xx){
    $url = 'http://apis.baidu.com/bbtapi/constellation/constellation_query?consName='.$xx.'&type=today';
    $chengyu=baiduapi($url);
    if ($chengyu['error_code']!='0'){
        $content= $chengyu['reason'].$chengyu['error_code'];
    }else{
        $content=$chengyu['name']." 今日运势\n";
        $content .= 'QFriend:'.$chengyu['QFriend']."\n";
        $content .= 'all:'.$chengyu['all']."\n";
        $content .= 'color:'.$chengyu['color']."\n";
        $content .= 'health:'.$chengyu['health']."\n";
        $content .= 'love:'.$chengyu['love']."\n";
        $content .= 'money:'.$chengyu['money']."\n";
        $content .= 'number:'.$chengyu['number']."\n";
        $content .= 'summary:'.$chengyu['summary']."\n";
        $content .= 'work:'.$chengyu['work'];
    }
    return $content;
}
// 搞笑图片
function gaoxiao($p=1){
    $url = 'http://apis.baidu.com/showapi_open_bus/showapi_joke/joke_pic?maxResult=5&page='.$p;
    $chengyu=baiduapi($url);
    if ($chengyu['showapi_res_code']!='0'){
        $tempArray= $chengyu['showapi_res_error'].$chengyu['showapi_res_code'];
    }else{
        $tempArray[] = array("Title" =>"搞笑图片", "Description" =>"", "PicUrl" =>"", "Url" =>"");
        $temp=$chengyu['showapi_res_body']['contentlist'];
        for($i=0; $i<count($temp); $i++){
            $tempArray[] = array("Title"=>$temp[$i]['title'],
            "Description"=>"", 
            "PicUrl"=>$temp[$i]['img'],
            "Url"=>$temp[$i]['img']);
        }
    }
    return $tempArray;
}
// 车票
function chepiao($from,$to,$time){
    $time=$time?$time:date('Y-m-d',time());
    $from=$from?$from:'广州';
    $to=$to?$to:'汕头';
    $url = 'http://apis.baidu.com/qunar/qunar_train_service/s2ssearch?version=1.0&from='.$from.'&to='.$to.'&date='.$time;
    $chengyu=baiduapi($url);
    if ($chengyu['ret']!='1'){
        $content= $chengyu['errmsg'].$chengyu['errcode'];
    }else{
        $temp=$chengyu['data']['trainList'];
        for($i=0; $i<count($temp); $i++){
            $content.=$temp[$i]['trainType'].$temp[$i]['trainNo']."\n开始".$temp[$i]['startTime']."\n结束".$temp[$i]['endTime']."\n";
            for($j=0; $j<count($temp[$i]['seatInfos']); $j++){
                $content.=$temp[$i]['seatInfos'][$j]['seat'].'价格'.$temp[$i]['seatInfos'][$j]['seatPrice'].'数量'.$temp[$i]['seatInfos'][$j]['remainNum']."\n";
            }
            // $content.="\n";
        }
    }
    if(mb_strlen($content)>2000)
        $content = mb_strcut($content, 0, 2000, 'utf-8');
    return $content;
}
function http($url, $params, $method = 'GET', $header = array(), $multi = false){
    $opts = array(
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTPHEADER     => $header
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url . '?' . http_build_query($params);
            break;
        case 'POST':
            //判断是否传输文件
            //$params = $multi ? $params : http_build_query($params);
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
        default:
            throw new Exception('不支持的请求方式！');
    }
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if($error) throw new Exception('请求发生错误：' . $error);
    return  $data;
}
function utf8($str, $encoding="gb2312")
{
    if (function_exists('iconv')){
        return @iconv($encoding, 'UTF-8', $str);
    }elseif(MB_ENABLED === TRUE){
        return @mb_convert_encoding($str, 'UTF-8', $encoding);
    }
    return FALSE;
}
function strreplace($str){
    $str = str_replace('+','',$str);
    $str = str_replace('-','',$str);
    $str = str_replace(',','',$str);
    $str = str_replace('，','',$str);
    $str = str_replace('；','',$str);
    return $str;
}


function send_mail($to, $name, $subject = '', $body = '', $attachment = null, $config = '') {
    $config =array (
      'smtp_host' => 'smtp.qq.com',
      'smtp_port' => '465',
      'from_email' => '317205134@qq.com',
      'from_name' => '就成铭平台',
      'smtp_user' => '317205134@qq.com',
      'smtp_pass' => 'vjcyinhppnczbgdf',
      'smtp_pass' => 'tkbmwuarmqvdbhhb',
      'reply_email' => '',
      'reply_name' => '',
      'test_email' => '',
    );
    include_once('class/PHPMailer/phpmailer.class.php');         //从PHPMailer目录导class.phpmailer.php类文件
    $mail = new PHPMailer();                           //PHPMailer对象
    $mail->CharSet = 'UTF-8';                         //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();                                   // 设定使用SMTP服务
//    $mail->IsHTML(true);
    $mail->SMTPDebug = 0;                             // 关闭SMTP调试功能 1 = errors and messages2 = messages only
    $mail->SMTPAuth = true;                           // 启用 SMTP 验证功能
    if ($config['smtp_port'] == 465)
        $mail->SMTPSecure = 'ssl';                    // 使用安全协议
    $mail->Host = $config['smtp_host'];                // SMTP 服务器
    $mail->Port = $config['smtp_port'];                // SMTP服务器的端口号
    $mail->Username = $config['smtp_user'];           // SMTP服务器用户名
    $mail->Password = $config['smtp_pass'];           // SMTP服务器密码
    $mail->SetFrom($config['from_email'], $config['from_name']);
    $replyEmail = $config['reply_email'] ? $config['reply_email'] : $config['reply_email'];
    $replyName = $config['reply_name'] ? $config['reply_name'] : $config['reply_name'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if (is_array($attachment)) { // 添加附件
        foreach ($attachment as $file) {
            if (is_array($file)) {
                is_file($file['path']) && $mail->AddAttachment($file['path'], $file['name']);
            } else {
                is_file($file) && $mail->AddAttachment($file);
            }
        }
    } else {
        is_file($attachment) && $mail->AddAttachment($attachment);
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}
function https_request($url, $data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}