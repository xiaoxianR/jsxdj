<?php
/**
 * 字符串截取，支持中文和其他编码
 * static
 * access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * return string
 */
 function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr")){
        $slice = mb_substr($str, $start, $length, $charset);
        $strlen = mb_strlen($str,$charset);
    }elseif(function_exists('iconv_substr')){
        $slice = iconv_substr($str,$start,$length,$charset);
        $strlen = iconv_strlen($str,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        $strlen = count($match[0]);
    }
    if($suffix && $strlen>$length)$slice.='...';
    return $slice;
 }


 /**
 * 页码
 * @param  [type] $pageIndex  [description]
 * @param  [type] $totalPages [description]
 * @param  [type] $href       [description]
 * @return [type]             [description]
 */
function getPages($pageIndex,$totalPages,$href){

     //echo "getPages() href=".$href;


     $showPageSize=5;//页码导航显示数量

     $page="";
     if($totalPages > 0){


     $page=$page."<div class='about-main'>";
     $page=$page."<div id='p' class='fanye1' style='text-align:right'>";
     $page=$page."<a href='".$href."1"."'>首页</a>";
     //echo "getPages pageIndex=".$pageIndex;
     if($pageIndex > 1){
        $page=$page." <a href='".$href.($pageIndex-1)."'>上一页</a>";
      }



     $mid=floor($showPageSize/2);
     //echo "getpages mid=".$mid."<br>";
     $begin=1;

     if($pageIndex>$mid){
       $begin=$pageIndex-$mid+1;
    }

    $end=$begin+$showPageSize-1;
    if($end>$totalPages){
      $end=$totalPages;
    }

    //calc begin
    $begin=$end-$showPageSize+1;
    if($begin<1){
      $begin=1;
    }

    for ($i=$begin;$i<=$end;$i++) {
      //echo "getpages i=".$i."<br>";
      $page=$page." <a href='".$href.$i."'>".$i."</a>";

    }


     if($pageIndex < $totalPages){
        $page=$page." <a href='".$href.($pageIndex+1)."'>下一页</a>";
     }

     $page=$page." <a href='".$href.$totalPages."'>尾页</a>";
     $page=$page."</div>";
     $page=$page."</div>";

     }


    return $page;

}

/**
 * 查询总记录数
 * @param  [type] $tableName 表名
 * @return [type]            总记录数
 */
function getTotalRecords($tableName)
{
    $model=M();
    $totalRecords=0;

    $sql="SELECT count(*) AS count FROM ".$tableName." where state=1";
    $record=$model->query($sql);
     //echo getTotalRecords() dump($record);
     $row=$record[0];
     $totalRecords=$row['count'];

     return $totalRecords;
}

function uploadPicture(){
    $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小,定位B
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =     './Public/upload/'; // 设置附件上传根目录
    echo $upload->rootPath."<br>";
    // $upload->savePath  =     ''; // 设置附件上传（子）目录
    // $upload->thumb = true;
    // $upload->thumbMaxWidth= 425;
    // $upload->thumbMaxHeight=220;

    // 上传文件
    $info   =   $upload->upload();
    // dump($info);

    /*foreach ($info as $key => $file) {
        $file_path=$file['savepath'];
         $file=$file['savepath'].$file['savename'];
    }
    echo "filepath=".$file_path."<br>";
    echo "file=".$file."<br>";
    $image=new \Think\Image();
    $image->open($file_path);
    $image->thumb(525,220)->save($file_mini);*/








    //echo $info;
    if(!$info) {// 上传错误提示错误信息
        //$this->error($upload->getError());
        echo "upload info false"."<br>";
        $picturePath=false;
    }else{// 上传成功
        //echo "upload success"."<br>";
        $uploadPath=C('PICTURE_PATH');
        $picturePath=$uploadPath.$info['picture']['savepath'].$info['picture']['savename'];//picture为file name
        echo "upload path1=".$picturePath."<br>";
    }

    //echo "upload path=".$picturePath."<br>";


    return $picturePath;

}

/*********城市定位***************/
function getIPaddress(){
        $IPaddress='';
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $IPaddress = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $IPaddress = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $IPaddress = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $IPaddress = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $IPaddress = getenv("HTTP_CLIENT_IP");
            } else {
                $IPaddress = getenv("REMOTE_ADDR");
            }
        }
        return $IPaddress;
    }

 function taobaoIP($clientIP){
        $taobaoIP = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$clientIP;
        $IPinfo = json_decode(file_get_contents($taobaoIP));
        $province = $IPinfo->data->region;
        $city = $IPinfo->data->city;
        $data = $province.$city;
        return $data;
    }



?>