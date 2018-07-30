<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 新闻动态控制器
*/
class NewsController extends Controller
{

  public function index()
  {
    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************查询信息*************************/
    $infoSql="SELECT js_news.*,picture.path FROM js_news JOIN picture ON js_news.picture_id=picture.id   WHERE  state=1 ORDER BY update_time DESC,id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id

    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT js_news.*,picture.path FROM js_news JOIN picture ON js_news.picture_id=picture.id WHERE js_news.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);
    }

    $this->display();
  }


  public function update(){
    $model=M();

    $updateId=$_GET['updateid'];
    $title=$_POST['title'];  //获取修改的信息
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $type=$_POST['type']; //1/2

    $updateTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE js_news SET title='".$title."', content='".$content."',type=".$type.",update_time='".$updateTime."',summary='".$summary."',manager_id=".$adminid." WHERE id=".$updateId;
     }
     else{
      //添加图片
      $addPicSql="INSERT INTO picture(path) VALUES ('".$picturePath."')";
      $model->execute($addPicSql);

      //查询添加图片id
      $pictureSql="SELECT MAX(id) AS maxid FROM picture";
      $idList=$model->query($pictureSql);
      $pictureId=$idList[0]['maxid'];

      //修改信息
     $updateSql="UPDATE js_news SET title='".$title."', content='".$content."',type=".$type.",update_time='".$updateTime."',summary='".$summary."',picture_id=".$pictureId.",manager_id=".$adminid." WHERE id=".$updateId;

     }

    $model->execute($updateSql);

    $this->redirect('index');
  }

  public function add(){
    $model=M();

    $title=$_POST['title'];  //获取修改的信息
     $summary=$_POST['summary'];
    $content=$_POST['content'];
    $type=$_POST['type']; //1/2

    $addTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片

     //添加图片
      $addPicSql="INSERT INTO picture(path) VALUES ('".$picturePath."')";
      $model->execute($addPicSql);

      //查询添加图片id
      $pictureSql="SELECT MAX(id) AS maxid FROM picture";
      $idList=$model->query($pictureSql);
      $pictureId=$idList[0]['maxid'];

    $addSql="INSERT INTO js_news(title,content,type,pub_time,update_time,summary,picture_id,manager_id) values ('".$title."','".$content."',".$type.",'".$addTime."','".$addTime."','".$summary."',".$pictureId.",".$adminid.")";

    $model->execute($addSql);

    $this->redirect('index');
  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];
    $adminid=session("adminid");
    $deleteTime=date('Y-m-d');

    //删除：将state设为0
    $deleteSql="UPDATE js_news SET state=0,update_time='".$deleteTime."',manager_id=".$adminid." where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');
  }





}

?>