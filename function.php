<?php

/*  获取文件列表
调用方法
$time=strtotime("2017-1-21")-time();
echo time2string($time);
*/
function time2string($second){
    $day = floor($second/(3600*24));
    $second = $second%(3600*24);//除去整天之后剩余的时间
    $hour = floor($second/3600);
    $second = $second%3600;//除去整小时之后剩余的时间
    $minute = floor($second/60);
    $second = $second%60;//除去整分钟之后剩余的时间
    //返回字符串
    return $day.'天'.$hour.'小时'.$minute.'分'.$second.'秒';
}
/*  获取文件列表
调用方法
$datalist=list_dir('./');
*/
function list_dir($dir){
    $result = array();
    if (is_dir($dir)){
        $file_dir = scandir($dir);
        foreach($file_dir as $file){
            if ($file == '.' || $file == '..'){
                continue;
            }
            elseif (is_dir($dir.$file)){
                $result = array_merge($result, list_dir($dir.$file.'/'));
            }
            else{
                array_push($result, $dir.$file);
            }
        }
    }
    return $result;
}

/*压缩多级目录 
调用方法
$zip = new ZipArchive();  
//参数1:zip保存路径，参数2：ZIPARCHIVE::CREATE没有即是创建  
$filename='./case.zip';
$exportPath='./';
if(!$zip->open($filename,ZIPARCHIVE::CREATE))  
{  
    echo "创建[$filename]失败<br/>";return;  
}  
//echo "创建[$exportPath.zip]成功<br/>";  
createZip(opendir($exportPath),$zip,$exportPath);  
$zip->close(); 

// 下载
// if(!file_exists($filename)){   
//      exit("无法找到文件"); //即使创建，仍有可能失败。。。。   
// }   
// header("Cache-Control: public"); 
// header("Content-Description: File Transfer"); 
// header('Content-disposition: attachment; filename='.basename($filename)); //文件名   
// header("Content-Type: application/zip"); //zip格式的   
// header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件    
// header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小   
// @readfile($filename);
exit;
    $openFile:目录句柄 
    $zipObj:Zip对象 
    $sourceAbso:源文件夹路径 
*/  
function createZip($openFile,$zipObj,$sourceAbso,$newRelat = '')  
{
    while(($file = readdir($openFile)) != false)
    {
        if($file=="." || $file=="..")
            continue;
        /*源目录路径(绝对路径)*/
        $sourceTemp = $sourceAbso.'/'.$file;
        /*目标目录路径(相对路径)*/
        $newTemp = $newRelat==''?$file:$newRelat.'/'.$file;
        if(is_dir($sourceTemp))
        {
            //echo '创建'.$newTemp.'文件夹<br/>';
            $zipObj->addEmptyDir($newTemp);/*这里注意：php只需传递一个文件夹名称路径即可*/
            createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);
        }
        if(is_file($sourceTemp))
        {
            //echo '创建'.$newTemp.'文件<br/>';
            $zipObj->addFile($sourceTemp,$newTemp);
        }
    }
}

/**
 * 文件或目录权限检查函数
 *
 * @access          public
 * @param           string  $file_path   文件路径
 * @param           bool    $rename_prv  是否在检查修改权限时检查执行rename()函数的权限
 *
 * @return          int     返回值的取值范围为{0 <= x <= 15}，每个值表示的含义可由四位二进制数组合推出。
 *                          返回值在二进制计数法中，四位由高到低分别代表
 *                          可执行rename()函数权限、可对文件追加内容权限、可写入文件权限、可读取文件权限。
 */
function file_mode_info($file_path)
{
    /* 如果不存在，则不可读、不可写、不可改 */
    if (!file_exists($file_path))
    {
        return false;
    }

    $mark = 0;

    if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')
    {
        /* 测试文件 */
        $test_file = $file_path . '/cf_test.txt';

        /* 如果是目录 */
        if (is_dir($file_path))
        {
            /* 检查目录是否可读 */
            $dir = @opendir($file_path);
            if ($dir === false)
            {
                return $mark; //如果目录打开失败，直接返回目录不可修改、不可写、不可读
            }
            if (@readdir($dir) !== false)
            {
                $mark ^= 1; //目录可读 001，目录不可读 000
            }
            @closedir($dir);

            /* 检查目录是否可写 */
            $fp = @fopen($test_file, 'wb');
            if ($fp === false)
            {
                return $mark; //如果目录中的文件创建失败，返回不可写。
            }
            if (@fwrite($fp, 'directory access testing.') !== false)
            {
                $mark ^= 2; //目录可写可读011，目录可写不可读 010
            }
            @fclose($fp);

            @unlink($test_file);

            /* 检查目录是否可修改 */
            $fp = @fopen($test_file, 'ab+');
            if ($fp === false)
            {
                return $mark;
            }
            if (@fwrite($fp, "modify test.\r\n") !== false)
            {
                $mark ^= 4;
            }
            @fclose($fp);

            /* 检查目录下是否有执行rename()函数的权限 */
            if (@rename($test_file, $test_file) !== false)
            {
                $mark ^= 8;
            }
            @unlink($test_file);
        }
        /* 如果是文件 */
        elseif (is_file($file_path))
        {
            /* 以读方式打开 */
            $fp = @fopen($file_path, 'rb');
            if ($fp)
            {
                $mark ^= 1; //可读 001
            }
            @fclose($fp);

            /* 试着修改文件 */
            $fp = @fopen($file_path, 'ab+');
            if ($fp && @fwrite($fp, '') !== false)
            {
                $mark ^= 6; //可修改可写可读 111，不可修改可写可读011...
            }
            @fclose($fp);

            /* 检查目录下是否有执行rename()函数的权限 */
            if (@rename($test_file, $test_file) !== false)
            {
                $mark ^= 8;
            }
        }
    }
    else
    {
        if (@is_readable($file_path))
        {
            $mark ^= 1;
        }

        if (@is_writable($file_path))
        {
            $mark ^= 14;
        }
    }

    return $mark;
}

/**
  +-----------------------------------------------------------------------------------------
 * 删除目录及目录下所有文件或删除指定文件
  +-----------------------------------------------------------------------------------------
 * @param str $path   待删除目录路径
 * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
  +-----------------------------------------------------------------------------------------
 * @return bool 返回删除状态
  +-----------------------------------------------------------------------------------------
 */
function delDirAndFile($path, $delDir = FALSE) {
    $handle = @opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir)
            return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}

/**
  +----------------------------------------------------------
 * 功能：检测一个目录是否存在，不存在则创建它
  +----------------------------------------------------------
 * @param string    $path      待检测的目录
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function makeDir($path) {
    return is_dir($path) or (makeDir(dirname($path)) and @mkdir($path, 0777));
}
/**
 * 检查目标文件夹是否存在，如果不存在则自动创建该目录
 *
 * @access      public
 * @param       string      folder     目录路径。不能使用相对于网站根目录的URL
 *
 * @return      bool
 */
function make_dir($folder)
{
    $reval = false;

    if (!file_exists($folder))
    {
        /* 如果目录不存在则尝试创建该目录 */
        @umask(0);

        /* 将目录路径拆分成数组 */
        preg_match_all('/([^\/]*)\/?/i', $folder, $atmp);

        /* 如果第一个字符为/则当作物理路径处理 */
        $base = ($atmp[0][0] == '/') ? '/' : '';

        /* 遍历包含路径信息的数组 */
        foreach ($atmp[1] AS $val)
        {
            if ('' != $val)
            {
                $base .= $val;

                if ('..' == $val || '.' == $val)
                {
                    /* 如果目录为.或者..则直接补/继续下一个循环 */
                    $base .= '/';

                    continue;
                }
            }
            else
            {
                continue;
            }

            $base .= '/';

            if (@!file_exists($base))
            {
                /* 尝试创建目录，如果创建失败则继续循环 */
                if (@mkdir(rtrim($base, '/'), 0777))
                {
                    @chmod($base, 0777);
                    $reval = true;
                }
            }
        }
    }
    else
    {
        /* 路径已经存在。返回该路径是不是一个目录 */
        $reval = is_dir($folder);
    }

    clearstatcache();

    return $reval;
}


/**
  +----------------------------------------------------------
 * 原样输出print_r的内容
  +----------------------------------------------------------
 * @param string    $content   待print_r的内容
  +----------------------------------------------------------
 */
function pre($content) {
    echo "<pre>";
    print_r($content);
    echo "</pre>";
}

/**
  +----------------------------------------------------------
 * 加密密码
  +----------------------------------------------------------
 * @param string    $data   待加密字符串
  +----------------------------------------------------------
 * @return string 返回加密后的字符串
 */
function encrypt($data) {
    return md5(C("AUTH_CODE") . md5($data));
}

/**
  +----------------------------------------------------------
 * 将一个字符串转换成数组，支持中文
  +----------------------------------------------------------
 * @param string    $string   待转换成数组的字符串
  +----------------------------------------------------------
 * @return string   转换后的数组
  +----------------------------------------------------------
 */
function strToArray($string) {
    $strlen = mb_strlen($string);
    while ($strlen) {
        $array[] = mb_substr($string, 0, 1, "utf8");
        $string = mb_substr($string, 1, $strlen, "utf8");
        $strlen = mb_strlen($string);
    }
    return $array;
}

/**
  +----------------------------------------------------------
 * 生成随机字符串
  +----------------------------------------------------------
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
  +----------------------------------------------------------
 * @return string
  +----------------------------------------------------------
 */
function randCode($length = 5, $type = 0) {
    $code='';
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if (in_array($type, array(1,2,3,4))) {
        $string = $arr[$type];
    } else {
        array_pop($arr);
        $string = implode("", $arr);
    }
    $count = strlen($string) - 1;
    for ($i = 0; $i < $length; $i++) {
        $str[$i] = $string[rand(0, $count)];
        $code .= $str[$i];
    }
    return $code;
}


/**
  +----------------------------------------------------------
 * 将一个字符串部分字符用*替代隐藏
  +----------------------------------------------------------
 * @param string    $string   待转换的字符串
 * @param int       $bengin   起始位置，从0开始计数，当$type=4时，表示左侧保留长度
 * @param int       $len      需要转换成*的字符个数，当$type=4时，表示右侧保留长度
 * @param string    $glue     替代字符，默认*
 * @param int       $type     转换类型：0，从左向右隐藏；1，从右向左隐藏；2，从指定字符位置分割前由右向左隐藏；3，从指定字符位置分割后由左向右隐藏；4，保留首末指定字符串
 * @param string    $recove     匹配查找分割符
  +----------------------------------------------------------
 * @return string   处理后的字符串
  +----------------------------------------------------------
 */
function hideStr($string, $bengin = 0, $len = 4, $glue = '*', $type = 0, $recove='@') {
    if (empty($string))
        return false;
    $array = array();
    if ($type == 0 || $type == 1 || $type == 4) {
        $strlen = $length = mb_strlen($string);
        while ($strlen) {
            $array[] = mb_substr($string, 0, 1, "utf8");
            $string = mb_substr($string, 1, $strlen, "utf8");
            $strlen = mb_strlen($string);
        }
    }
    switch ($type) {
        case 1:
            $array = array_reverse($array);
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = $glue;
            }
            $string = implode("", array_reverse($array));
            break;
        case 2:
            $array = explode($recove, $string);
            if(isset($array[1])){
                $array[0] = hideStr($array[0], $bengin, $len,$glue, 1);
            }
            $string = implode($recove, $array);
            break;
        case 3:
            $array = explode($recove, $string);
            if(isset($array[1])){
                $array[1] = hideStr($array[1], $bengin, $len,$glue, 0);
            }
            $string = implode($recove, $array);
            break;
        case 4:
            $left = $bengin;
            $right = $len;
            $tem = array();
            for ($i = 0; $i < ($length - $right); $i++) {
                if (isset($array[$i]))
                    $tem[] = $i >= $left ? $glue : $array[$i];
            }
            $array = array_chunk(array_reverse($array), $right);
            $array = array_reverse($array[0]);
            for ($i = 0; $i < $right; $i++) {
                $tem[] = $array[$i];
            }
            $string = implode("", $tem);
            break;
        default:
            for ($i = $bengin; $i < ($bengin + $len); $i++) {
                if (isset($array[$i]))
                    $array[$i] = $glue;
            }
            $string = implode("", $array);
            break;
    }
    return $string;
}


/**
  +----------------------------------------------------------
 * 功能：检测一个字符串是否是邮件地址格式
  +----------------------------------------------------------
 * @param string $value    待检测字符串
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function is_email($value) {
    return preg_match("/^[0-9a-zA-Z]+(?:[\_\.\-][a-z0-9\-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*\.[a-zA-Z]+$/i", $value);
}

/**
  +----------------------------------------------------------
 * 功能：系统邮件发送函数
  +----------------------------------------------------------
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
  +----------------------------------------------------------
 * @return boolean
  +----------------------------------------------------------
 */
function send_mail($to, $name, $subject = '', $body = '', $attachment = null, $config = '') {
    $config =array (
      // 'smtp_host' => 'smtp.qq.com',
      // 'smtp_port' => '465',
      // 'from_email' => '317205134@qq.com',
      // 'from_name' => '我的test',
      // 'smtp_user' => '317205134@qq.com',
      // // 'smtp_pass' => 'vjcyinhppnczbgdf',
      // 'smtp_pass' => 'tkbmwuarmqvdbhhb',
      // 'from_email' => 'laozhongyishop@163.com',
      // 'smtp_user' => 'laozhongyishop@163.com',
      // 'smtp_pass' => '188laozhongyi',

      'smtp_host' => 'mail.jyfame.com',
      'smtp_port' => '25',
      'from_email' => 'service@jyfame.com',
      'from_name' => '我的test',
      'smtp_user' => 'service@jyfame.com',
      'smtp_pass' => '9chengming2017',

      'reply_email' => '',
      'reply_name' => '',
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

/**
  +----------------------------------------------------------
 * 功能：剔除危险的字符信息
  +----------------------------------------------------------
 * @param string $val
  +----------------------------------------------------------
 * @return string 返回处理后的字符串
  +----------------------------------------------------------
 */
function remove_xss($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=@avascript:alert('XSS')>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
        // @ @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
        // @ @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;
}

/**
  +----------------------------------------------------------
 * 功能：计算文件大小
  +----------------------------------------------------------
 * @param int $bytes
  +----------------------------------------------------------
 * @return string 转换后的字符串
  +----------------------------------------------------------
 */
function byteFormat($bytes) {
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}

function checkCharset($string, $charset = "UTF-8") {
    if ($string == '')
        return;
    $check = preg_match('%^(?:
                                [\x09\x0A\x0D\x20-\x7E] # ASCII
                                | [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
                                | \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
                                | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
                                | \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
                                | \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
                                | [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
                                | \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
                                )*$%xs', $string);

    return $charset == "UTF-8" ? ($check == 1 ? $string : iconv('gb2312', 'utf-8', $string)) : ($check == 0 ? $string : iconv('utf-8', 'gb2312', $string));
}





//Create By TuJia @2014

/*删除文章内容图片（也就是删除编辑器上传的图片）*/
function remove_content_img($content){
    //匹配并删除图片
    $imgreg = "/<img.*src=\"([^\"]+)\"/U";

    $matches = array();
    preg_match_all($imgreg, $content, $matches);

    foreach($matches[1] as $img_url){
        if(strpos($img_url, 'emoticons')===false){
            $web_root = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            $filepath = str_replace($web_root,'',$img_url);
            if($filepath == $img_url) $filepath = substr($img_url, 1);
            @unlink($filepath);
            $filedir  = dirname($filepath);
            $files = scandir($filedir);
            if(count($files)<=2)@rmdir($filedir);//如果只剩下./和../,就删除文件夹
        }
    }
    unset($matches);
}

/**
 * 计算字符串的长度（汉字按照两个字符计算）
 *
 * @param   string      $str        字符串
 *
 * @return  int
 */
function str_len($str)
{
    $length = strlen(preg_replace('/[\x00-\x7F]/', '', $str));

    if ($length)
    {
        return strlen($str) - $length + intval($length / 3) * 2;
    }
    else
    {
        return strlen($str);
    }
}
/*截取字符串(中文截取)*/
function mySubstr($str,$len=20,$suffix='...',$charset='UTF-8'){
    $substr = mb_substr($str,0,$len,$charset);
    if($substr != $str)$substr .= $suffix;
    return $substr;
}

/*截取字符串2(断点截取)*/
function mySubstr2($str,$delimiter='('){
    $offset = strpos($str,$delimiter);
    $substr = $offset? substr($str, 0, $offset) : $str;
    return $substr;
}

/**
 * 截取UTF-8编码下字符串的函数
 *
 * @param   string      $str        被截取的字符串
 * @param   int         $length     截取的长度
 * @param   bool        $append     是否附加省略号
 *
 * @return  string
 */
function sub_str($str, $length = 0, $append = true)
{
    $str = trim($str);
    $strlength = strlen($str);

    if ($length == 0 || $length >= $strlength)
    {
        return $str;
    }
    elseif ($length < 0)
    {
        $length = $strlength + $length;
        if ($length < 0)
        {
            $length = $strlength;
        }
    }

    if (function_exists('mb_substr'))
    {
        $newstr = mb_substr($str, 0, $length, EC_CHARSET);
    }
    elseif (function_exists('iconv_substr'))
    {
        $newstr = iconv_substr($str, 0, $length, EC_CHARSET);
    }
    else
    {
        //$newstr = trim_right(substr($str, 0, $length));
        $newstr = substr($str, 0, $length);
    }

    if ($append && $str != $newstr)
    {
        $newstr .= '...';
    }

    return $newstr;
}


//追加地址参数(模版直接输出)
function aup($name,$value){
    $arr = $_GET;
    unset($arr['_URL_']);
    unset($arr[$name]);
    $arr[$name] = $value;
    echo U(MODULE_NAME.'/'.ACTION_NAME,$arr);
}

//从二维数组里返回一个一维数组
function get_array_column($arr, $column=''){
  $return = array();
  foreach($arr as $k=>$v){
    if($column){
        foreach($v as $kk=>$vv){
            if($kk==$column){
                $return[] = $vv;
            }
        }
    }else{
        $return = array_merge($return, $v);
    }
  }
  return $return;
}

//价格格式
function price_format($price){
    $str = strrev($price);
    $str = chunk_split($str,3,',');
    $str = substr($str, 0, -1);
    $new_price = strrev($str);
    return $new_price;
}

//通过IP查地区信息
function get_area_by_ip($ip){
    $urlreq     ='http://opendata.baidu.com/api.php?query='.$ip.'&co=&resource_id=6006&t=1398217370181&ie=utf8&oe=gbk&cb=op_aladdin_callback&format=json&tn=baidu&cb=jQuery110207946170251816511_1398217192726&_=139821719274';
    $info       = @file_get_contents($urlreq);
    $info       = iconv('gbk','utf-8',$info);
    $reg        = "/location\":\"([^\"]+)\"/U";
    preg_match($reg,$info,$matches);
    $location   = $matches[1];
    $city   = $matches;
    // $location   = explode(" ", $location);
    // $city       = $location[0];
    return $city;
}


//获取客户端IP
function get_ip(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }
    else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    else if(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }
    else{
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}

/**
 * 获得用户的真实IP地址
 *
 * @access  public
 * @return  string
 */
function real_ip()
{
    static $realip = NULL;

    if ($realip !== NULL)
    {
        return $realip;
    }

    if (isset($_SERVER))
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            /* 取X-Forwarded-For中第一个非unknown的有效IP字符串 */
            foreach ($arr AS $ip)
            {
                $ip = trim($ip);

                if ($ip != 'unknown')
                {
                    $realip = $ip;

                    break;
                }
            }
        }
        elseif (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }
        else
        {
            if (isset($_SERVER['REMOTE_ADDR']))
            {
                $realip = $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                $realip = '0.0.0.0';
            }
        }
    }
    else
    {
        if (getenv('HTTP_X_FORWARDED_FOR'))
        {
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }
        elseif (getenv('HTTP_CLIENT_IP'))
        {
            $realip = getenv('HTTP_CLIENT_IP');
        }
        else
        {
            $realip = getenv('REMOTE_ADDR');
        }
    }

    preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

    return $realip;
}


//验证手机号码格式
function is_phone($phone){
    $chars = "/^13[0-9]{1}[0-9]{8}$|15[0-9]{1}[0-9]{8}$|17[0-9]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/";
    if (preg_match($chars, $phone)){
        return true;
    }
    return false;
}

//验证固话格式
function is_tel($tel){
    $chars = "/^([0-9]{3,4}-)?[0-9]{7,8}$/";
    if (preg_match($chars, $tel)){
        return true;
    }
    return false;
}

//QQ格式验证
function is_qq($qq){
    $chars = "/^[1-9]{1}[0-9]{4,8}$/";
    if (preg_match($chars, $qq)){
        return true;
    }
    return false;
}
/**
 * 对 MYSQL LIKE 的内容进行转义
 *
 * @access      public
 * @param       string      string  内容
 * @return      string
 */
function mysql_like_quote($str)
{
    return strtr($str, array("\\\\" => "\\\\\\\\", '_' => '\_', '%' => '\%', "\'" => "\\\\\'"));
}

//处理表单的内容（转义和去除换行）
function handle_content($content){
    $content = str_replace("\r\n", '', $content);
    return addslashes($content);
}
/**
 * 过滤用户输入的基本数据，防止script攻击
 *
 * @access      public
 * @return      string
 */
function compile_str($str)
{
    $arr = array('<' => '＜', '>' => '＞');

    return strtr($str, $arr);
}

/**
 * 递归方式的对变量中的特殊字符进行转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function addslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
    }
}
/**
 * 将对象成员变量或者数组的特殊字符进行转义
 *
 * @access   public
 * @param    mix        $obj      对象或者数组
 * @author   Xuan Yan
 *
 * @return   mix                  对象或者数组
 */
function addslashes_deep_obj($obj)
{
    if (is_object($obj) == true)
    {
        foreach ($obj AS $key => $val)
        {
            $obj->$key = addslashes_deep($val);
        }
    }
    else
    {
        $obj = addslashes_deep($obj);
    }

    return $obj;
}

/**
 * 递归方式的对变量中的特殊字符去除转义
 *
 * @access  public
 * @param   mix     $value
 *
 * @return  mix
 */
function stripslashes_deep($value)
{
    if (empty($value))
    {
        return $value;
    }
    else
    {
        return is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
    }
}
/**
 *  将一个字串中含有全角的数字字符、字母、空格或'%+-()'字符转换为相应半角字符
 *
 * @access  public
 * @param   string       $str         待转换字串
 *
 * @return  string       $str         处理后字串
 */
function make_semiangle($str)
{
    $arr = array('０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
                 '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
                 'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
                 'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
                 'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
                 'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
                 'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
                 'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
                 'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
                 'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
                 'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
                 'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
                 'ｙ' => 'y', 'ｚ' => 'z',
                 '（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[',
                 '】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']',
                 '‘' => '[', '’' => ']', '｛' => '{', '｝' => '}', '《' => '<',
                 '》' => '>',
                 '％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-',
                 '：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.',
                 '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|',
                 '”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"',
                 '　' => ' ');

    return strtr($str, $arr);
}



/**
 * 冒泡排序
 * @ $arr   需要排序的数组
 * @ $key   用这个键来排序
 */
function bubbleSort($arr,$key,$desc=true){
    $count = count($arr);
    for($i=0; $i<$count; $i++){
        for($j=$i+1; $j<$count; $j++){
            if($desc){
                if($arr[$j][$key]>$arr[$i][$key]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }else{
                if($arr[$j][$key]<$arr[$i][$key]){
                    $temp = $arr[$i];
                    $arr[$i] = $arr[$j];
                    $arr[$j] = $temp;
                }
            }
        }
    }
    return $arr;
}
/**
* 二维数组按指定的键值排序
* @param $array 数组
* @param $key   排序键值
* @param $type  排序方式
*/
function array_sort($arr, $keys, $type = 'desc') {
    $keysvalue = $new_array = array();
    foreach ($arr as $k => $v) {
        $keysvalue[$k] = $v[$keys];
    }
    if ($type == 'asc') {
        asort($keysvalue);
    } else {
        arsort($keysvalue);
    }
    reset($keysvalue);
    foreach ($keysvalue as $k => $v) {
        $new_array[$k] = $arr[$k];
    }
    return $new_array;
}



/**
 * http请求
 * @ $url    请求的地址
 * @ $data   发送的参数
 */
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
/**
 * http请求  模拟登陆
 * @ $url    请求的地址
 * @ $data   发送的参数
 * array('url'=>'','data'=>null,'cookie'=>'cookiefile','use'=>false)
 */
function https_request2($url,$data = '',$ssl=false,$referer=false,$parm_cookie=array('use'=>false)){
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
 * 将上传文件转移到指定位置
 *
 * @param string $file_name
 * @param string $target_name
 * @return blog
 */
function move_upload_file($file_name, $target_name = '')
{
    if (function_exists("move_uploaded_file"))
    {
        if (move_uploaded_file($file_name, $target_name))
        {
            @chmod($target_name,0755);
            return true;
        }
        else if (copy($file_name, $target_name))
        {
            @chmod($target_name,0755);
            return true;
        }
    }
    elseif (copy($file_name, $target_name))
    {
        @chmod($target_name,0755);
        return true;
    }
    return false;
}
/**
  +----------------------------------------------------------
 * 文件上传
 * $upfile=upload(array('jpg', 'gif', 'png', 'jpeg'),'Uploads/users/','time',false,'','160','160','user_');
 * $data['img']  = $upfile[0]['savepath'].$upfile[0]['savename'];
  +----------------------------------------------------------
 */
function upload($allowExts=array('jpg', 'gif', 'png', 'jpeg'),$savePath,$saveRule,$thumb=false,$thumbPath,$thumbMaxWidth,$thumbMaxHeight,$thumbPrefix){
    import("ORG.Util.UploadFile");
    import("ORG.Util.File");
    $upload = new UploadFile(); // 实例化上传类 
    if(!is_dir($savePath)){
        File::make_dir('./'.$savePath);
    }
    $smPath = explode(',',$thumbPath);
    foreach($smPath as $key => $value){
        if(!is_dir($value)){
            File::make_dir('./'.$value);
        }
    }
    
    $upload->maxSize = 3145728 ; // 设置附件上传大小 
    $upload->allowExts = $allowExts; // 设置附件上传类型 
    $upload->savePath = $savePath; // 设置附件上传目录 
    $upload->saveRule = $saveRule; // 上传文件的保存规则 
    $upload->thumb = $thumb; // 是否需要对图片文件进行缩略图处理，默认为false       
    $upload->thumbPath = $thumbPath;  //缩略图的保存路径，留空的话取文件上传目录本身
    $upload->thumbMaxWidth=$thumbMaxWidth;   //缩略图的最大宽度，多个使用逗号分隔
    $upload->thumbMaxHeight=$thumbMaxHeight;   //缩略图的最大高度，多个使用逗号分隔
    $upload->thumbPrefix=$thumbPrefix;   //缩略图的文件前缀，默认为thumb_  （如果你设置了多个缩略图大小的话，请在此设置多个前缀）
    // $upload->autoSub=true;   //是否使用子目录保存上传文件
    // $upload->subType='date'; 
    
    if(!$upload->upload()) { // 上传错误 提示错误信息 
        $this->error($upload->getErrorMsg());
    }else{ // 上传成功 获取上传文件信息 
        $info = $upload->getUploadFileInfo(); 
    }
    
    return $info;
}


/**
 * Create By TuJia 
 */
//获取地区信息
function get_area($myip = null){
    import("ORG.Net.IpLocation");
    $Ip = new IpLocation('UTFWry.dat'); // 实例化类 参数表示IP地址库文件
    $data = $Ip->getlocation($myip); // 获取某个IP地址所在的位置
    return $data['area'];
}



/**
 * 默认值
 * @param  [type] $default [description]
 * @param  [type] $val     [description]
 * @return [type]          [description]
 */
function default_val($default, $val){
    if(empty($val)) return $default;
    return $val;
}



/**
 * 内容链接
 * @param  [type] $link_str [description]
 * @return [type]           [description]
 */
function content_links($link_str){
    $link_arr   = explode("\n",$link_str);
    $result     = array();
    foreach($link_arr as $key=>$value){
        $arr    = explode('|',$value);
        $result[$key]['name'] = $arr[0];
        $result[$key]['link'] = trim($arr[1]);
    }
    return $result;
}

//linux系统探测
function sys_linux()
{
    // CPU
    if (false === ($str = @file("/proc/cpuinfo"))) return false;
    $str = implode("", $str);
    @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(\@.-]+)([\r\n]+)/s", $str, $model);
    @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
    @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
    @preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips);
    if (false !== is_array($model[1]))
    {
        $res['cpu']['num'] = sizeof($model[1]);
        /*
        for($i = 0; $i < $res['cpu']['num']; $i++)
        {
            $res['cpu']['model'][] = $model[1][$i].'&nbsp;('.$mhz[1][$i].')';
            $res['cpu']['mhz'][] = $mhz[1][$i];
            $res['cpu']['cache'][] = $cache[1][$i];
            $res['cpu']['bogomips'][] = $bogomips[1][$i];
        }*/
        if($res['cpu']['num']==1)
            $x1 = '';
        else
            $x1 = ' ×'.$res['cpu']['num'];
        $mhz[1][0] = ' | 频率:'.$mhz[1][0];
        $cache[1][0] = ' | 二级缓存:'.$cache[1][0];
        $bogomips[1][0] = ' | Bogomips:'.$bogomips[1][0];
        $res['cpu']['model'][] = $model[1][0].$mhz[1][0].$cache[1][0].$bogomips[1][0].$x1;
        if (false !== is_array($res['cpu']['model'])) $res['cpu']['model'] = implode("<br />", $res['cpu']['model']);
        if (false !== is_array($res['cpu']['mhz'])) $res['cpu']['mhz'] = implode("<br />", $res['cpu']['mhz']);
        if (false !== is_array($res['cpu']['cache'])) $res['cpu']['cache'] = implode("<br />", $res['cpu']['cache']);
        if (false !== is_array($res['cpu']['bogomips'])) $res['cpu']['bogomips'] = implode("<br />", $res['cpu']['bogomips']);
    }

    // NETWORK

    // UPTIME
    if (false === ($str = @file("/proc/uptime"))) return false;
    $str = explode(" ", implode("", $str));
    $str = trim($str[0]);
    $min = $str / 60;
    $hours = $min / 60;
    $days = floor($hours / 24);
    $hours = floor($hours - ($days * 24));
    $min = floor($min - ($days * 60 * 24) - ($hours * 60));
    if ($days !== 0) $res['uptime'] = $days."天";
    if ($hours !== 0) $res['uptime'] .= $hours."小时";
    $res['uptime'] .= $min."分钟";

    // MEMORY
    if (false === ($str = @file("/proc/meminfo"))) return false;
    $str = implode("", $str);
    preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);
    preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers);

    $res['memTotal'] = round($buf[1][0]/1024, 2);
    $res['memFree'] = round($buf[2][0]/1024, 2);
    $res['memBuffers'] = round($buffers[1][0]/1024, 2);
    $res['memCached'] = round($buf[3][0]/1024, 2);
    $res['memUsed'] = $res['memTotal']-$res['memFree'];
    $res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;

    $res['memRealUsed'] = $res['memTotal'] - $res['memFree'] - $res['memCached'] - $res['memBuffers']; //真实内存使用
    $res['memRealFree'] = $res['memTotal'] - $res['memRealUsed']; //真实空闲
    $res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0; //真实内存使用率

    $res['memCachedPercent'] = (floatval($res['memCached'])!=0)?round($res['memCached']/$res['memTotal']*100,2):0; //Cached内存使用率

    $res['swapTotal'] = round($buf[4][0]/1024, 2);
    $res['swapFree'] = round($buf[5][0]/1024, 2);
    $res['swapUsed'] = round($res['swapTotal']-$res['swapFree'], 2);
    $res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round($res['swapUsed']/$res['swapTotal']*100,2):0;

    // LOAD AVG
    if (false === ($str = @file("/proc/loadavg"))) return false;
    $str = explode(" ", implode("", $str));
    $str = array_chunk($str, 4);
    $res['loadAvg'] = implode(" ", $str[0]);

    return $res;
}

//FreeBSD系统探测
function sys_freebsd()
{
    //CPU
    if (false === ($res['cpu']['num'] = get_key("hw.ncpu"))) return false;
    $res['cpu']['model'] = get_key("hw.model");
    //LOAD AVG
    if (false === ($res['loadAvg'] = get_key("vm.loadavg"))) return false;
    //UPTIME
    if (false === ($buf = get_key("kern.boottime"))) return false;
    $buf = explode(' ', $buf);
    $sys_ticks = time() - intval($buf[3]);
    $min = $sys_ticks / 60;
    $hours = $min / 60;
    $days = floor($hours / 24);
    $hours = floor($hours - ($days * 24));
    $min = floor($min - ($days * 60 * 24) - ($hours * 60));
    if ($days !== 0) $res['uptime'] = $days."天";
    if ($hours !== 0) $res['uptime'] .= $hours."小时";
    $res['uptime'] .= $min."分钟";
    //MEMORY
    if (false === ($buf = get_key("hw.physmem"))) return false;
    $res['memTotal'] = round($buf/1024/1024, 2);

    $str = get_key("vm.vmtotal");
    preg_match_all("/\nVirtual Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buff, PREG_SET_ORDER);
    preg_match_all("/\nReal Memory[\:\s]*\(Total[\:\s]*([\d]+)K[\,\s]*Active[\:\s]*([\d]+)K\)\n/i", $str, $buf, PREG_SET_ORDER);

    $res['memRealUsed'] = round($buf[0][2]/1024, 2);
    $res['memCached'] = round($buff[0][2]/1024, 2);
    $res['memUsed'] = round($buf[0][1]/1024, 2) + $res['memCached'];
    $res['memFree'] = $res['memTotal'] - $res['memUsed'];
    $res['memPercent'] = (floatval($res['memTotal'])!=0)?round($res['memUsed']/$res['memTotal']*100,2):0;

    $res['memRealPercent'] = (floatval($res['memTotal'])!=0)?round($res['memRealUsed']/$res['memTotal']*100,2):0;

    return $res;
}

//取得参数值 FreeBSD
function get_key($keyName)
{
    return do_command('sysctl', "-n $keyName");
}

//确定执行文件位置 FreeBSD
function find_command($commandName)
{
    $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
    foreach($path as $p) 
    {
        if (@is_executable("$p/$commandName")) return "$p/$commandName";
    }
    return false;
}

//执行系统命令 FreeBSD
function do_command($commandName, $args)
{
    $buffer = "";
    if (false === ($command = find_command($commandName))) return false;
    if ($fp = @popen("$command $args", 'r')) 
    {
        while (!@feof($fp))
        {
            $buffer .= @fgets($fp, 4096);
        }
        return trim($buffer);
    }
    return false;
}

//windows系统探测
function sys_windows()
{
    if (PHP_VERSION >= 5)
    {
        $objLocator = new COM("WbemScripting.SWbemLocator");
        $wmi = $objLocator->ConnectServer();
        $prop = $wmi->get("Win32_PnPEntity");
    }
    else
    {
        return false;
    }

    //CPU
    $cpuinfo = GetWMI($wmi,"Win32_Processor", array("Name","L2CacheSize","NumberOfCores"));
    $res['cpu']['num'] = $cpuinfo[0]['NumberOfCores'];
    if (null == $res['cpu']['num']) 
    {
        $res['cpu']['num'] = 1;
    }/*
    for ($i=0;$i<$res['cpu']['num'];$i++)
    {
        $res['cpu']['model'] .= $cpuinfo[0]['Name']."<br />";
        $res['cpu']['cache'] .= $cpuinfo[0]['L2CacheSize']."<br />";
    }*/
    $cpuinfo[0]['L2CacheSize'] = ' ('.$cpuinfo[0]['L2CacheSize'].')';
    if($res['cpu']['num']==1)
        $x1 = '';
    else
        $x1 = ' ×'.$res['cpu']['num'];
    $res['cpu']['model'] = $cpuinfo[0]['Name'].$cpuinfo[0]['L2CacheSize'].$x1;
    // SYSINFO
    $sysinfo = GetWMI($wmi,"Win32_OperatingSystem", array('LastBootUpTime','TotalVisibleMemorySize','FreePhysicalMemory','Caption','CSDVersion','SerialNumber','InstallDate'));
    $sysinfo[0]['Caption']=iconv('GBK', 'UTF-8',$sysinfo[0]['Caption']);
    $sysinfo[0]['CSDVersion']=iconv('GBK', 'UTF-8',$sysinfo[0]['CSDVersion']);
    $res['win_n'] = $sysinfo[0]['Caption']." ".$sysinfo[0]['CSDVersion']." 序列号:{$sysinfo[0]['SerialNumber']} 于".date('Y年m月d日H:i:s',strtotime(substr($sysinfo[0]['InstallDate'],0,14)))."安装";
    //UPTIME
    $res['uptime'] = $sysinfo[0]['LastBootUpTime'];

    $sys_ticks = 3600*8 + time() - strtotime(substr($res['uptime'],0,14));
    $min = $sys_ticks / 60;
    $hours = $min / 60;
    $days = floor($hours / 24);
    $hours = floor($hours - ($days * 24));
    $min = floor($min - ($days * 60 * 24) - ($hours * 60));
    if ($days !== 0) $res['uptime'] = $days."天";
    if ($hours !== 0) $res['uptime'] .= $hours."小时";
    $res['uptime'] .= $min."分钟";

    //MEMORY
    $res['memTotal'] = round($sysinfo[0]['TotalVisibleMemorySize']/1024,2);
    $res['memFree'] = round($sysinfo[0]['FreePhysicalMemory']/1024,2);
    $res['memUsed'] = $res['memTotal']-$res['memFree']; //上面两行已经除以1024,这行不用再除了
    $res['memPercent'] = round($res['memUsed'] / $res['memTotal']*100,2);

    $swapinfo = GetWMI($wmi,"Win32_PageFileUsage", array('AllocatedBaseSize','CurrentUsage'));

    // LoadPercentage
    $loadinfo = GetWMI($wmi,"Win32_Processor", array("LoadPercentage"));
    $res['loadAvg'] = $loadinfo[0]['LoadPercentage'];

    return $res;
}

function GetWMI($wmi,$strClass, $strValue = array())
{
    $arrData = array();

    $objWEBM = $wmi->Get($strClass);
    $arrProp = $objWEBM->Properties_;
    $arrWEBMCol = $objWEBM->Instances_();
    foreach($arrWEBMCol as $objItem) 
    {
        @reset($arrProp);
        $arrInstance = array();
        foreach($arrProp as $propItem) 
        {
            eval("\$value = \$objItem->" . $propItem->Name . ";");
            if (empty($strValue)) 
            {
                $arrInstance[$propItem->Name] = trim($value);
            } 
            else
            {
                if (in_array($propItem->Name, $strValue)) 
                {
                    $arrInstance[$propItem->Name] = trim($value);
                }
            }
        }
        $arrData[] = $arrInstance;
    }
    return $arrData;
}
function isfun($funName = '')
{
    if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp)) return '错误';
    return (false !== function_exists($funName)) ? '<font color="green">√</font>' : '<font color="red">×</font>';
}
function isfun1($funName = '')
{
    if (!$funName || trim($funName) == '' || preg_match('~[^a-z0-9\_]+~i', $funName, $tmp)) return '错误';
    return (false !== function_exists($funName)) ? '√' : '×';
}
//检测PHP设置参数
function show($varName)
{
    switch($result = get_cfg_var($varName))
    {
        case 0:
            return '<font color="red">×</font>';
        break;
        
        case 1:
            return '<font color="green">√</font>';
        break;
        
        default:
            return $result;
        break;
    }
}
/**
 * 是否微信浏览器访问
 * @return boolean [description]
 */
function is_weixin(){
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    if(strpos($user_agent, 'MicroMessenger') === false) {
        return false;
    }else{
        preg_match('/.*?(MicroMessenger\/([0-9.]+))\s*/', $user_agent, $matches);
        $version = $matches[2];
        return true;
    }
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
function get_php_file($filename) {
  return trim(substr(file_get_contents($filename), 15));
}
function set_php_file($filename, $content) {
  $fp = fopen($filename, "w");
  fwrite($fp, "<?php exit();?>" . $content);
  fclose($fp);
}
/**
*  @desc 根据两点间的经纬度计算距离
*  @param float $lat 纬度值
*  @param float $lng 经度值
*/
function getDistance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6367000; //approximate radius of earth in meters
    /*
    Convert these degrees to radians
    to work with the formula
    */
    $lat1 = ($lat1 * pi() ) / 180;
    $lng1 = ($lng1 * pi() ) / 180;
    $lat2 = ($lat2 * pi() ) / 180;
    $lng2 = ($lng2 * pi() ) / 180;
    /*
    Using the
    Haversine formula
    http://en.wikipedia.org/wiki/Haversine_formula
    calculate the distance
    */
    $calcLongitude = $lng2 - $lng1;
    $calcLatitude = $lat2 - $lat1;
    $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);  $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
    $calculatedDistance = $earthRadius * $stepTwo;
    return round($calculatedDistance);
}
//gps转换成google或者百度坐标(微信获取的是gps坐标，如果你直接用百度或google的api去解析的话肯定会出现误差的。)
function getgps($lats,$lngs, $gps=false, $google=false)//gpg 转百度坐标
{
    $lat=$lats;
    $lng=$lngs;
    if($gps)
        $c=file_get_contents("http://api.map.baidu.com/ag/coord/convert?from=0&to=4&x=$lng&y=$lat");
    else if($google)
        $c=file_get_contents("http://api.map.baidu.com/ag/coord/convert?from=2&to=4&x=$lng&y=$lat");
    else 
    return array($lat,$lng);
    $arr=(array)json_decode($c);
    if(!$arr['error'])
    {
        $lat=base64_decode($arr['y']);
        $lng=base64_decode($arr['x']);
    }
    return array($lat,$lng);
}  
function get_kuaidi($ecs,$num){
    $getcom = $ecs;
// 快递100查询接口专用KEY，申请KEY地址：http://www.kuaidi100.com/openapi/
// $kuaidi100key = "b0c887c349f3d126";
/*
提示：如果您需要的公司不在以下列表，请按以下方法自行添加或修改，快递公司名称区分大小写
case "与【shopex后台-商店配置-物流公司】下的公司名称一致":
$postcom '中的名称与【http://code.google.com/p/kuaidi-api/wiki/Open_API_API_URL】下的【快递公司代码】一致’;
*/
// $kuaidi100key = "b0c887c349f3d126";
// $customer = "b0c887c349f3d126";
// $kuaidi100key = "VMqzVUAb6146";
// $customer = "D79FFD47A0669B83CCFC2F5E3D68730D";
$kuaidi100key = "zczXPylZ1784";
$customer = "32514028908689846F531CF2D1D95D71";
switch ($getcom){
  case "EMS"://ecshop后台中显示的快递公司名称
    $postcom = 'ems';//快递公司代码
    break;
  case "中国邮政":
    $postcom = 'ems';
    break;
  case "申通快递":
    $postcom = 'shentong';
    break;
  case "圆通速递":
    $postcom = 'yuantong';
    break;
  case "顺丰速运":
    $postcom = 'shunfeng';
    break;
  case "天天快递":
    $postcom = 'tiantian';
    break;
  case "韵达快递":
    $postcom = 'yunda';
    break;
  case "中通速递":
    $postcom = 'zhongtong';
    break;
  case "龙邦物流":
    $postcom = 'longbanwuliu';
    break;
  case "宅急送":
    $postcom = 'zhaijisong';
    break;
  case "全一快递":
    $postcom = 'quanyikuaidi';
    break;
  case "汇通速递":
    $postcom = 'huitongkuaidi';
    break;  
  case "民航快递":
    $postcom = 'minghangkuaidi';
    break;  
  case "亚风速递":
    $postcom = 'yafengsudi';
    break;  
  case "快捷速递":
    $postcom = 'kuaijiesudi';
    break;  
  case "华宇物流":
    $postcom = 'tiandihuayu';
    break;  
  case "中铁快运":
    $postcom = 'zhongtiewuliu';
    break;    
  case "百世汇通":
    $postcom = 'huitongkuaidi';
    break;
  case "全峰快递":
    $postcom = 'quanfengkuaidi';
    break;
  case "德邦":
    $postcom = 'debangwuliu';
    break;
  case "FedEx":
    $postcom = 'fedex';
    break;    
  case "UPS":
    $postcom = 'ups';
    break;    
  case "DHL":
    $postcom = 'dhl';
    break;    
  default:
    $postcom = '';
}
    $post_data = array();
    $post_data["customer"] = $customer;
    $key= $kuaidi100key ;
    $post_data["param"] = '{"com":"'.$postcom.'","num":"'.$num.'"}';
    $url='http://poll.kuaidi100.com/poll/query.do';
    $post_data["sign"] = md5($post_data["param"].$key.$post_data["customer"]);
    $post_data["sign"] = strtoupper($post_data["sign"]);
    $o="";
    $arr1 = array();
    foreach ($post_data as $k=>$v)
    {
        $o.= "$k=".urlencode($v)."&";   //默认UTF-8编码格式
    }
    $post_data=substr($o,0,-1);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $result = curl_exec($ch);
    $data = str_replace("\&quot;",'"',$result );
    $data = json_decode($data,true);
    return $data;
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
/**
 * 发短信
 * @return  array cheney
 */function sendSMS($phone_id,$msg)
{
    $msg = iconv('utf-8','gb2312',$msg."\r\n");
    /*根据参数，生成调用URL,因为是测试例子，不对变量为空的情况做处理*/

    $URL = "http://sms3.mobset.com/SDK/Sms_Send.asp?CorpID=xxxxxxx&LoginName=xxxxx&Passwd=xxxxx&send_no=".$phone_id."&Timer=&LongSms=1&msg=" .rawurlencode($msg);
    $back = https_request($URL);

    $back_arr = explode(',', $back);
    if( $back_arr['0'] == 1 ){
        return true;
    }else{
        return false;
    }   
}