<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 推荐服务控制器
*/
class HotServiceController extends Controller
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
    $infoSql="SELECT js_hot_serv.*,picture.path FROM js_hot_serv JOIN picture ON js_hot_serv.picture_id=picture.id   WHERE  js_hot_serv.state=1";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT js_hot_serv.*,picture.path FROM js_hot_serv JOIN picture ON js_hot_serv.picture_id=picture.id WHERE js_hot_serv.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){
    $model=M();

    $updateId=$_GET['updateid'];
    $link_url=$_POST['link_url'];  //获取修改的信息
    $updateTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE js_hot_serv SET link_url='".$link_url."',update_time='".$updateTime."', manager_id=".$adminid." WHERE id=".$updateId;
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
     $updateSql="UPDATE js_hot_serv SET link_url='".$link_url."',update_time='".$updateTime."',picture_id=".$pictureId.", manager_id=".$adminid." WHERE id=".$updateId;

    }
    
    $model->execute($updateSql);

    $this->redirect('index');
  }

  public function add(){
    $model=M();

    $link_url=$_POST['link_url'];  //获取修改的信息

    $picturePath=uploadPicture();//上传图片

     //添加图片
      $addPicSql="INSERT INTO picture(path) VALUES ('".$picturePath."')";
      $model->execute($addPicSql);

      //查询添加图片id
      $pictureSql="SELECT MAX(id) AS maxid FROM picture";
      $idList=$model->query($pictureSql);
      $pictureId=$idList[0]['maxid'];

      $addTime=date('Y-m-d');
      $adminid=session("adminid");

    $addSql="INSERT INTO js_hot_serv(link_url,pub_time,update_time,picture_id,manager_id) values ('".$link_url."','".$addTime."','".$addTime."',".$pictureId.",".$adminid.")";
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
    $deleteSql="UPDATE js_hot_serv SET state=0,update_time='".$deleteTime."',manager_id=".$adminid." where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');
  }





}

?>