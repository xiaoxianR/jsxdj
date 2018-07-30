<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 二级类目控制器
*/
class Category2Controller extends Controller
{
  public function index()
  {
    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************一级类目*************************/
    $c1Sql="SELECT js_category1.* FROM js_category1  WHERE  state=1 ORDER BY update_time ASC,id ASC";
    $category1List=$model->query($c1Sql);
    $this->assign("category1List",$category1List);

    /**************查询信息*************************/
    $infoSql="SELECT js_category2.*,js_category1.category1_name FROM js_category2 
              JOIN js_category1 ON js_category2.parent_id=js_category1.id   
              WHERE  js_category2.state=1 
              ORDER BY js_category2.update_time DESC,js_category2.id DESC";
    $infoList=$model->query($infoSql);
    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id
    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT js_category2.*,picture.path FROM js_category2 JOIN picture ON js_category2.picture_id=picture.id WHERE js_category2.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);
    }

    $this->display();
  }


  public function update(){
    $model=M();

    $updateId=$_GET['updateid'];
    $category2_name=$_POST['category2_name'];
    $category1_id=$_POST['category1_id'];
    $updateTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片
   
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE js_category2 SET category2_name='".$category2_name."',parent_id=".$category1_id.",update_time='".$updateTime."', manager_id=".$adminid." WHERE id=".$updateId;
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
     $updateSql="UPDATE js_category2 SET category2_name='".$category2_name."',parent_id=".$category1_id.",update_time='".$updateTime."',picture_id=".$pictureId.", manager_id=".$adminid." WHERE id=".$updateId;

     }
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){
    $model=M();

    $category2_name=$_POST['category2_name'];  //获取修改的信息
    $category1_id=$_POST['category1_id'];
  
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
    $addSql="INSERT INTO js_category2(category2_name,pub_time,update_time,picture_id,parent_id,manager_id) values ('".$category2_name."','".$addTime."','".$addTime."',".$pictureId.",".$category1_id.",".$adminid.")";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');
  }

  public function hot(){
    // 设为热门
    $model=M();

    $infoId=$_GET['infoid'];
    $adminid=session("adminid");
    $opTime=date('Y-m-d');

    
    $opSql="UPDATE js_category2 SET is_hot=1,update_time='".$opTime."',manager_id=".$adminid." where id=".$infoId;
    $model->execute($opSql);

    $this->redirect('index');
  }

  public function unhot(){
    $model=M();

    $infoId=$_GET['infoid'];
    $adminid=session("adminid");
    $opTime=date('Y-m-d');

    
    $opSql="UPDATE js_category2 SET is_hot=0,update_time='".$opTime."',manager_id=".$adminid." where id=".$infoId;
    $model->execute($opSql);

    $this->redirect('index');
  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];
    $adminid=session("adminid");
    $deleteTime=date('Y-m-d');

    //删除：将state设为0
    $deleteSql="UPDATE js_category2 SET state=0,update_time='".$deleteTime."',manager_id=".$adminid." where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');
  }
}
?>