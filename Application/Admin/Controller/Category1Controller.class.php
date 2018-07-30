<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 一级类目控制器
*/
class Category1Controller extends Controller
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
    $infoSql="SELECT js_category1.*,picture.path FROM js_category1 JOIN picture ON js_category1.picture_id=picture.id   WHERE  state=1 ORDER BY update_time DESC,id DESC";
    $infoList=$model->query($infoSql);
    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id
    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT js_category1.*,picture.path FROM js_category1 JOIN picture ON js_category1.picture_id=picture.id WHERE js_category1.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }

    $this->display();
  }

  public function update(){
    $model=M();

    $updateId=$_GET['updateid'];
    $category1_name=$_POST['category1_name'];
    $updateTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片
   
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE js_category1 SET category1_name='".$category1_name."',update_time='".$updateTime."', manager_id=".$adminid." WHERE id=".$updateId;
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
     $updateSql="UPDATE js_category1 SET category1_name='".$category1_name."',update_time='".$updateTime."',picture_id=".$pictureId.", manager_id=".$adminid." WHERE id=".$updateId;

     }
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');
  }

  public function add(){
    $model=M();

    $category1_name=$_POST['category1_name'];  //获取修改的信息
    $addTime=date('Y-m-d');
    
    $picturePath=uploadPicture();//上传图片
     //添加图片
      $addPicSql="INSERT INTO picture(path) VALUES ('".$picturePath."')";
      $model->execute($addPicSql);

      //查询添加图片id
      $pictureSql="SELECT MAX(id) AS maxid FROM picture";
      $idList=$model->query($pictureSql);
      $pictureId=$idList[0]['maxid'];

      $adminid=session("adminid");
    $addSql="INSERT INTO js_category1(category1_name,pub_time,update_time,picture_id,manager_id) values ('".$category1_name."','".$addTime."','".$addTime."',".$pictureId.",".$adminid.")";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');
  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];
    $adminid=session("adminid");
    $deleteTime=date('Y-m-d');

    //删除：将state设为0
    $deleteSql="UPDATE js_category1 SET state=0,update_time='".$deleteTime."',manager_id=".$adminid." where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');
  }
}
?>