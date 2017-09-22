<?php
header('Content-Type:text/html;charset=utf-8');
ini_set("max_execution_time", "18000");
ini_set("memory_limit", "2048M");
ini_set( 'display_errors', 'On' ); // Off
error_reporting(E_ALL);
date_default_timezone_set('PRC'); // PRC
// echo date('Y-m-d H:i:s')."\n\n";
// sleep(2); 秒
// usleep(1666666) — 以指定的微秒数延迟执行 百万分之一秒
// E:\phpStudy\MySQL\bin\mysql.exe -uroot -proot
// http://mynotes.com/test/二维码/demo/
// site:/www.w3school.com.cn cursor


   
    // 参数加载
    $case=isset($_GET['case'])?$_GET['case']:'';
    $file=$u_file=isset($_GET['file'])?$_GET['file']:'';
    if(empty($case))die('项目不正确!');
    if(empty($u_file))die('文件不正确!');
    $u_file=str_replace('E:/www/'.$case.'/','',$u_file);


    // 项目信息
    $acc=array(
        'mynotes'=>array('120.27.28.7','test','df1256bv','1'),
        'maitai'=>array('222.191.251.103','maitai','458427170Bd9d8','2'),
        'jindou'=>array('183.61.109.99','jindouyun','AF028AAD5912a5','3'),
        'liudao'=>array('183.61.109.86','web001','Liudao888','2'),
        'yitaixiang'=>array('183.61.109.86','web00sss','sd','2')
    );

    
   
    // 加载项目配置
    $now_acc=isset($acc[$case])?$acc[$case]:'';
    if(empty($now_acc))die('查找不到该项目!');
    if($now_acc['3'] ==2){
        $u_file='/'.$case.'/web/'.$u_file;
    }elseif($now_acc['3'] ==3){
        $u_file='/jindouyun/web/'.$u_file;
    }elseif($now_acc['3'] == 1){
        $u_file='/'.$u_file;
    }

    // ftp参数调试
    // var_dump($u_file);
    // var_dump($now_acc);
    // die();




    // 运行
    $ftp = new class_ftp($now_acc['0'],21,$now_acc['1'],$now_acc['2']); // 打开FTP连接 


    // // 返回的对象调试
    // if ( $type  =  ftp_systype ( $ftp->conn_id )) {
    //     echo  "Example.com is powered by  $type \n" ;
    // } else {
    //     echo  "Couldn't get the systype" ;
    // }
    // var_dump(ftp_pwd($ftp->conn_id));
    // var_dump(ftp_rawlist($ftp->conn_id,'/jindouyun/web'));
    // var_dump(ftp_nlist($ftp->conn_id,'/jindouyun/web'));
    // var_dump(ftp_nlist($ftp->conn_id,'/jindouyun/web'));
    // die();



    $back=$ftp->up_file($file,$u_file,false); // 上传文件 
    $ftp->close(); // 关闭FTP连接 

    var_dump($back);
    die();

 
    // class class_ftp end  
    /************************************** 测试 *********************************** 
    $ftp = new class_ftp('192.168.100.143',21,'user','pwd'); // 打开FTP连接 
    //$ftp->up_file('aa.txt','a/b/c/cc.txt'); // 上传文件 
    //$ftp->move_file('a/b/c/cc.txt','a/cc.txt'); // 移动文件 
    //$ftp->copy_file('a/cc.txt','a/b/dd.txt'); // 复制文件 
    //$ftp->del_file('a/b/dd.txt'); // 删除文件 
    $ftp->close(); // 关闭FTP连接 
    ******************************************************************************/  

    /** 
    * 作用：FTP操作类( 拷贝、移动、删除文件/创建目录 ) 
    * QQ交流群：136112330 
    */  
    class class_ftp  
    {  
        public $off; // 返回操作状态(成功/失败)  
        public $conn_id; // FTP连接  
        /** 
         * 方法：FTP连接 
         * @FTP_HOST -- FTP主机 
         * @FTP_PORT -- 端口 
         * @FTP_USER -- 用户名 
         * @FTP_PASS -- 密码 
         */  
        function __construct($FTP_HOST,$FTP_PORT,$FTP_USER,$FTP_PASS)  
        {  
            $this->conn_id = @ftp_connect($FTP_HOST,$FTP_PORT) or die("FTP服务器连接失败");  
            @ftp_login($this->conn_id,$FTP_USER,$FTP_PASS) or die("FTP服务器登陆失败");  
            @ftp_pasv($this->conn_id,1); // 打开被动模拟  
        }  
        /** 
         * 方法：上传文件 
         * @path -- 本地路径 
         * @newpath -- 上传路径 
         * @type -- 若目标目录不存在则新建 
         */  
        function up_file($path,$newpath,$type=true)  
        {  
            if($type) $this->dir_mkdirs($newpath);  
            $this->off = @ftp_put($this->conn_id,$newpath,$path,FTP_BINARY);  
            if(!$this->off) echo "文件上传失败，请检查权限及路径是否正确！"; 
            return $this->off; 
        }  
        /** 
         * 方法：移动文件 
         * @path -- 原路径 
         * @newpath -- 新路径 
         * @type -- 若目标目录不存在则新建 
         */  
        function move_file($path,$newpath,$type=true)  
        {  
            if($type) $this->dir_mkdirs($newpath);  
            $this->off = @ftp_rename($this->conn_id,$path,$newpath);  
            if(!$this->off) echo "文件移动失败，请检查权限及原路径是否正确！";  
        }  
        /** 
         * 方法：复制文件 
         * 说明：由于FTP无复制命令,本方法变通操作为：下载后再上传到新的路径 
         * @path -- 原路径 
         * @newpath -- 新路径 
         * @type -- 若目标目录不存在则新建 
         */  
        function copy_file($path,$newpath,$type=true)  
        {  
            $downpath = "c:/tmp.dat";  
            $this->off = @ftp_get($this->conn_id,$downpath,$path,FTP_BINARY);// 下载  
            if(!$this->off) echo "文件复制失败，请检查权限及原路径是否正确！";  
            $this->up_file($downpath,$newpath,$type);  
        }  
        /** 
         * 方法：删除文件 
         * @path -- 路径 
         */  
        function del_file($path)  
        {  
            $this->off = @ftp_delete($this->conn_id,$path);  
            if(!$this->off) echo "文件删除失败，请检查权限及路径是否正确！";  
        }  
        /** 
         * 方法：生成目录 
         * @path -- 路径 
         */  
        function dir_mkdirs($path)  
        {   
            $path_arr = explode('/',trim($path,'/')); // 取目录数组   
            $file_name = array_pop($path_arr); // 弹出文件名 
            if(empty($path_arr))return false; 
            $path_div = count($path_arr); // 取层数  
            foreach($path_arr as $val) // 创建目录  
            {  
                if(@ftp_chdir($this->conn_id,$val) == FALSE)  
                {  
                    $tmp = @ftp_mkdir($this->conn_id,$val);  
                    if($tmp == FALSE)  
                    {  
                        echo "目录创建失败，请检查权限及路径是否正确！";  
                        exit;  
                    }  
                    @ftp_chdir($this->conn_id,$val);  
                }  
            }  
            for($i=1;$i=$path_div;$i++) // 回退到根  
            {  
                @ftp_cdup($this->conn_id);  
            }  
        }  
        /** 
         * 方法：关闭FTP连接 
         */  
        function close()  
        {  
            @ftp_close($this->conn_id);  
        }  
    }







?>


