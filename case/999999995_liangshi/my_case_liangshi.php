<?php

ini_set("max_execution_time", "18000000");
ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC');  // PRC

// 要处理的目录
$dir1='E:/www/liangshi/';
// 要导出的目录
$dirSave='E:/svn文件导出/';
// 对比的目录
$dirContrast='';//'E:/www/liudao/';


// 时间


$time_str='2016/04/25 11:23:01';  //  之前的更新

$time_str='2016/05/09 17:18:51';  //  完成了加功能

$time_str='2016/05/10 11:32:53';  //  完成了加功能

$time_str='2016/05/13 09:28:39';  //  完成了加功能
$time_str='2016/05/13 10:45:46';  //  完成了加功能
$time_str='2016/05/18 14:44:22';  //  完成了加功能
$time_str='2016/05/20 09:57:04';  //  完成了加功能





//打开输出文件夹   E:\svn文件导出\contraSaver

// 要限定的文件扩展名
$isFile_list=array('php','png','dwt','htm','jpg','js','css','txt','lbi','gif','sql','xml','html');
$isFile_list=array();
// 要排除的文件扩展名
$noIsFile_list=array();
// 要限定的短目录
$isOneDirArr=array();
// 要排除的短目录
$notIsOneDirArr=array('Cache','.svn','Uploads');

// 要排除的特定文件,短文件路径
$notIsShorDir=array('11111.txt','data/config.php','api/cron/cron.txt',
    'mess_short.txt','mess_web.txt','mess_files.txt','includes/lib_mynewCommon.php');


// include_once('cls_phpzip.php');
// $zip = new PHPZip;

$deleImage=new contrastFile($dir1,$dirSave,$time_str,$isFile_list,$noIsFile_list,$isOneDirArr,$notIsOneDirArr,$notIsShorDir,$dirContrast);
$deleImage->getContrast();

// header("Content-Disposition: attachment; filename=goods_list.zip");
// header("Content-Type: application/unknown");
// die($zip->file());

// file_put_contents('new.zip', $zip->file());
// die();

echo 'nowTime: '.date('Y/m/d H:i:s')."\n";
var_dump( $deleImage->count );
// var_dump( $deleImage->countContrast );
var_dump( $deleImage->countAll );
var_dump( $deleImage->fileArr );


class contrastFile{
    private $dir1;//要对比的目录1
    private $dirSave;//要保存的目录
    private $time;//要保存的目录
    private $dirContrast;
    public  $count=0;
    public  $countAll=0;
    public  $countContrast=0;
    public  $fileArr=array();
    public  $dirArr=array();
    public function __construct($dir1,$dirSave='',$time_str,$isFile_list=array(),$noIsFile_list=array(),$isOneDirArr=array(),$notIsOneDirArr=array(),$notIsShorDir=array(),$dirContrast=''){
        header('Content-Type:text/html;charset=GBK');
        ini_set("max_execution_time", "18000");
        $this->dir1  = $dir1;
        $this->dirContrast  = $dirContrast;
        $this->time  = strtotime($time_str);
        $this->dirSave=$dirSave;             
        $this->isFile_list=$isFile_list;          
        $this->noIsFile_list=$noIsFile_list;          
        $this->isOneDirArr=$isOneDirArr;          
        $this->notIsOneDirArr=$notIsOneDirArr;          
        $this->notIsShorDir=$notIsShorDir;          
        $this->dirSave  = $dirSave=='' ? $this->dir1.'/contraSaver/' : $dirSave.'/contraSaver/';             
        if(!file_exists($this->dirSave))mkdir($this->dirSave);
    }

    public function getContrast($dirSeachNew=''){
        $this->deleteDir();
        $this->getFlieListCall();
    }

    private function deleteDir($dir=''){
        $dir=$dir==''?$this->dirSave:$dir;
        $arr=scandir($dir);
        foreach($arr as $k=>$d){
            if($d=='.'||$d=='..')continue;
            $tmp=$dir.'/'.$d;
            if(is_dir($tmp)){
                $this->deleteDir($tmp);
            }else{
                unlink($tmp);
            }
        };
        if($dir != $this->dirSave)rmdir($dir);
    }

    private function getFlieListCall($dirSeachNew=''){
        global $zip;
        $dirSeachNew=$dirSeachNew==''?$this->dir1:$dirSeachNew;
        $arr=scandir($dirSeachNew);
        foreach($arr as $k=>$d){
            //if($k>4)break;
            if($d=='.'||$d=='..')continue;
            $tmp=$dirSeachNew.$d;
 
            if(is_dir($tmp)){
                $this->getFlieListCall($tmp.'/');
            }else{
                     
                $shorDir=str_replace($this->dir1,'',$tmp);
                $fileTime=filemtime($tmp);
                $this->countAll++;  // 总文件数

                // 限制文件夹
                $pos=strpos($shorDir,'/');
                if($pos !== false){
                    $oneDir=substr($shorDir,0,$pos);
                    $shorDirName=dirname($shorDir);
                    if( count($this->isOneDirArr) !== 0 && !in_array($oneDir,$this->isOneDirArr))break;
                    if( count($this->notIsOneDirArr) !== 0 && in_array($oneDir,$this->notIsOneDirArr))break;
                    if( count($this->isOneDirArr) !== 0){
                        $is_break=1;
                        foreach($this->isOneDirArr as $v){
                            if(strpos($shorDirName,$v) === 0 ){
                                $is_break=0;
                                break;
                            }
                        }
                        if($is_break)break;
                    }
                    if( count($this->notIsOneDirArr) !== 0 ){
                        $is_break=0;
                        foreach($this->notIsOneDirArr as $v){
                            if(strpos($shorDirName,$v) === 0 ){ //  extract.php
                                $is_break=1;
                                break;
                            }
                        }
                        if($is_break)break;
                    }
                }
                     
                // 扩展名限制
                $ext = strtolower(pathinfo($tmp,PATHINFO_EXTENSION));
                if( count($this->noIsFile_list) !== 0 && in_array($ext,$this->noIsFile_list))continue;
                if( count($this->isFile_list) !== 0 && !in_array($ext,$this->isFile_list))continue;
              
                // 时间排除文件  extract.php
                if($fileTime < $this->time)continue;  // 1457885863

                // 文件内容详细对比排除文件,不存不排除
                // echo $this->dirContrast.$shorDir.'<br />';
                // if($this->dirContrast !== '' && file_exists($this->dirContrast.$shorDir) ){
                //     $this->countContrast++;  // 总文件数
                //     $is_same=1;
                //     $each_size=100000; // 单位 B
                //     $for_len=ceil(filesize($tmp)/$each_size);
                //     $fp = fopen($tmp, "r");
                //     $fp2 = fopen($this->dirContrast.$shorDir, "r");
                //     for($i=1;$i<=$for_len;$i++){
                //         fseek($fp,$each_size*($i-1));
                //         fseek($fp2,$each_size*($i-1));                             
                //         if(fread($fp,$each_size) !== fread($fp2,$each_size)){
                //             $is_same=0;
                //             break;
                //         }
                //     }
                //     fclose($fp);
                //     fclose($fp2);
                //     if($is_same)continue;
                // }

                // 排除指定文件  extract.php
                if( count($this->notIsShorDir) !== 0 && in_array($shorDir,$this->notIsShorDir))continue;

                // 生成目标目录 与 复件文件
                if(!in_array($shorDir,$this->dirArr)){  // 
                    $temlist=explode('/',$shorDir);
                    $tem_str='';
                    foreach($temlist as $k2=>$v2){
                        if($k2+1 == count($temlist))break;
                        $tem_str.='/'.$v2;
                        if(!file_exists($this->dirSave.$tem_str))mkdir($this->dirSave.$tem_str);
                    }
                    $this->dirArr[]=$shorDir;
                }
                copy($tmp,$this->dirSave.$shorDir);
                touch($this->dirSave.$shorDir,$fileTime);

                // 生成压缩文件
                // $zip->add_file(file_get_contents($tmp), $tmp);

                $this->count++;  // 实际操作文件数
                $this->fileArr[]=$shorDir;
            }
        };
    }
}





?>




