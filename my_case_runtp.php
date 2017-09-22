<?php

ini_set("max_execution_time", "18000000");
ini_set("memory_limit", "1000M");
date_default_timezone_set('PRC');  // PRC


// 时间
$time_str='2016/08/09 11:37:11';  //  完成了加功能
$time_str='2016/08/09 11:37:11';  //  
$time_str='2016/08/11 11:21:07';
$time_str='2016/08/11 11:21:11';
$time_str='2016/08/11 11:30:46';
$time_str='2016/08/11 11:30:50';
// sublimeAutoTimeLastSyn


$option=array(
    'dir1'=>'E:/www/test/test/',
    'dirSave'=>'E:/www/test/test2/',
    'time_str'=>$time_str,
    // 要排除的短目录
    'notIsOneDirArr'=>array('Cache','.svn','Uploads'),
    );
$deleImage=new contrastFile($option);

// header("Content-Disposition: attachment; filename=goods_list.zip");
// header("Content-Type: application/unknown");
// die($zip->file());

// file_put_contents('new.zip', $zip->file());
// die();

echo 'nowTime: '.date('Y/m/d H:i:s')."\n";
var_dump( $deleImage->count );
var_dump( $deleImage->countAll );
var_dump( $deleImage->fileArr );


/***  文件提取函数
 *
$deleImage=new contrastFile();
$option=array(                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    // 要处理的目录
    'dir1'=>'E:/www/mynotes/',
    // 要导出的目录
    'dirSave'=>'E:/flyskyyun/autoSyn/mynotes/web/',
    // 要对比的时间
    'time_str'=>'2016/06/11 16:42:46',
    // 是否要清理网盘同步文件夹
    'CallTrast'=>false,
    // 对比的目录
    'dirContrast'=>'',
    // 要限定的文件扩展名
    'isFile_list'=>array('php','png','dwt','htm','jpg','js','css','txt','lbi','gif','sql','xml','html'),
    // 要排除的文件扩展名
    'noIsFile_list'=>array(),
    // 要限定的短目录
    'isOneDirArr'=>array(),
    // 要排除的短目录
    'notIsOneDirArr'=>array('temp','includes/modules/cron'),
    // 要排除的特定文件,短文件路径
    'notIsShorDir'=>array('11111.txt','data/config.php','includes/lib_mynewCommon.php')
    );
$deleImage->toGetContrast($option);
 *
**/
class contrastFile{
    private $dir1;        // 要对比的目录1
    private $dirSave;     // 要导出的目录
    private $time;        // 要比对的时间
    private $dirContrast; // 对比的目录
    public  $count=0;     // 实际的文件同步数
    public  $countAll=0;  // 总的文件处理数
    public  $CallTrast=true;  // 是否生成缓存列表
    public  $fileArr=array(); // 实际的文件同步列表
    public  $delete=array();  // 删除的文件
    public  $dir_all=array(); // 文件缓存数组

    public function __construct($option=array()){
        ini_set("max_execution_time", "18000");
        $this->add_option($option);
        $this->deleteDir();
        $this->getFlieListCall();
    }
    public function toGetContrast($option=array()){

        $this->add_option($option);
        // 运行一次清空统计
        $this->count=0;
        $this->delete=array();
        $this->countAll=0;
        $this->fileArr=array();
        $this->dir_all=array();

        $this->getFlieListCall();
        if($this->CallTrast)$this->getFlieListCallTrast();
    }
    // 配置参数加载
    private function add_option($option=array()){
             
        $this->dir1   = $option['dir1'];
        $this->dirSave= $option['dirSave'];  

        $this->time          =isset($option['time_str'])?strtotime($option['time_str']):time();
        $this->dirContrast   =isset($option['dirContrast'])?$option['dirContrast']:'';
        $this->isFile_list   =isset($option['isFile_list'])?$option['isFile_list']:array();          
        $this->noIsFile_list =isset($option['noIsFile_list'])?$option['noIsFile_list']:array();          
        $this->isOneDirArr   =isset($option['isOneDirArr'])?$option['isOneDirArr']:array();          
        $this->notIsOneDirArr=isset($option['notIsOneDirArr'])?$option['notIsOneDirArr']:array();          
        $this->notIsShorDir  =isset($option['notIsShorDir'])?$option['notIsShorDir']:array();  
        $this->dirSave       = $this->dirSave=='' ? $this->dir1: $this->dirSave;    

        if(!file_exists($this->dirSave))mkdir($this->dirSave,0700,true);
    }
    // 删除目录
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
    // 本地对比网盘同步文件夹,若本地没有则删除网盘同步文件
    private function getFlieListCallTrast($dirSeachNew=''){
        $dirSeachNew=$dirSeachNew===''?$this->dirSave:$dirSeachNew;
        $arr=scandir($dirSeachNew);
        foreach($arr as $k=>$d){
            //if($k>4)break;
            if($d=='.'||$d=='..')continue;
            $tmp=$dirSeachNew.$d;
            if(is_dir($tmp)){
                $this->getFlieListCallTrast($tmp.'/');
            }else{

                $shorDir=str_replace($this->dirSave,'',$tmp);

                // var_dump( $shorDir );
                // var_dump( array_slice($this->dir_all,0,4) );
                // exec("pause"); 
                // die();

                $shorDirName=dirname($shorDir);
                $pos=strpos($shorDir,'/');
                if($pos !== false){

                    $oneDir=substr($shorDir,0,$pos);
                    if( count($this->notIsOneDirArr) !== 0 && in_array($oneDir,$this->notIsOneDirArr))break;
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

                // 使用文件缓存列表
                if(!isset($this->dir_all[$shorDirName]) 
                    || !in_array($shorDir,$this->dir_all[$shorDirName])){
                    $this->delete[]=$tmp;
                    unlink($tmp);
                }else{
                    continue;
                }

                // //  直接判断文件是否存在
                // if(!file_exists($this->dir1.$shorDir) ){
                //     unlink($tmp);
                // }
            }
        }; 
    }
    // 对比并处理目录
    private function getFlieListCall($dirSeachNew=''){
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

                // 生成文件缓存列表
                if($this->CallTrast)$this->dir_all[dirname($shorDir)][]=$shorDir;

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
              
                // 排除指定文件  extract.php
                if( count($this->notIsShorDir) !== 0 && in_array($shorDir,$this->notIsShorDir))continue;


                // 用时间作为最主要的对比条件
                if($fileTime < $this->time)continue;  // 1457885863
                

                // 生成目标目录  
                if(!file_exists(dirname($this->dirSave.$shorDir)))
                    mkdir(dirname($this->dirSave.$shorDir),0700,true);
                
                // 复件文件
                copy($tmp,$this->dirSave.$shorDir);
                touch($this->dirSave.$shorDir,$fileTime);

                $this->count++;  // 实际操作文件数
                $this->fileArr[]=$shorDir;
            }
        };
    }
}















?>