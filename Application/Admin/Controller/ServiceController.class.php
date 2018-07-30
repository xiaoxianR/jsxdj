<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 服务管理控制器
*/
class ServiceController extends Controller
{

  public function index()
  {
    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************查询一级类目*************************/
    // 没有二级类目的不显示
    $c1Sql="SELECT js_category1.* FROM js_category1 JOIN js_category2 ON js_category2.parent_id=js_category1.id  WHERE  js_category1.state=1 AND js_category2.state=1 GROUP BY js_category1.id ORDER BY update_time ASC,id ASC";
    $c1List=$model->query($c1Sql);
    $this->assign("c1List",$c1List);


    /**************查询信息*************************/
    $infoSql="SELECT js_service.*,js_category1.category1_name,js_category2.category2_name 
              FROM js_service JOIN js_category1 ON js_service.category1_id=js_category1.id 
              JOIN js_category2 ON js_service.category2_id=js_category2.id   
              WHERE  js_service.state=1 ORDER BY js_service.update_time DESC,js_service.id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id

    $c1Id = $c1List[0]['id'];
    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT js_service.*,picture.path FROM js_service JOIN picture ON js_service.picture_id=picture.id WHERE js_service.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);
      $c1Id = $editInfoList[0]['category1_id'];
    }
    /**************查询二级类目*************************/
    
    $c2Sql="SELECT js_category2.* FROM js_category2  WHERE parent_id=".$c1Id." AND  state=1 ORDER BY update_time ASC,id ASC";
    $c2List=$model->query($c2Sql);
    $this->assign("c2List",$c2List);

    $this->display();
  }

  public function getC2(){
    $model=M();
    $c1Id=$_GET['c1id'];
    $c2Sql="SELECT js_category2.* FROM js_category2  WHERE parent_id=".$c1Id." AND  state=1 ORDER BY update_time ASC,id ASC";
    $c2List=$model->query($c2Sql);
    $this->ajaxReturn (json_encode($c2List),'JSON');
  }


  public function update(){
    $model=M();

    $updateId=$_GET['updateid'];
    $title=$_POST['title'];  //获取修改的信息
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $price=$_POST['price'];
    $unit=$_POST['unit'];
    $category1_id=$_POST['category1_id'];
    $category2_id=$_POST['category2_id'];

    $updateTime=date('Y-m-d');
    $adminid=session("adminid");

    $picturePath=uploadPicture();//上传图片
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE js_service SET title='".$title."',summary='".$summary
                  ."', content='".$content."',price='".$price."',unit='".$unit
                  ."',category1_id=".$category1_id.",category2_id=".$category2_id
                  .",update_time='".$updateTime."',manager_id=".$adminid." WHERE id=".$updateId;
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
      $updateSql="UPDATE js_service SET title='".$title."',summary='".$summary
                  ."', content='".$content."',price='".$price."',unit='".$unit
                  ."',category1_id=".$category1_id.",category2_id=".$category2_id
                  .",update_time='".$updateTime."',picture_id=".$pictureId.",manager_id=".$adminid." WHERE id=".$updateId;
     }

    $model->execute($updateSql);

    $this->redirect('index');
  }

  public function add(){
    $model=M();

    $title=$_POST['title'];  //获取修改的信息
    $summary=$_POST['summary'];
    $content=$_POST['content'];
    $price=$_POST['price'];
    $unit=$_POST['unit'];
    $category1_id=$_POST['category1_id'];
    $category2_id=$_POST['category2_id'];

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

    $addSql="INSERT INTO js_service(title,summary,content,price,unit,category1_id,category2_id,pub_time,update_time,picture_id,manager_id) 
            values 
            ('".$title."','".$summary."','".$content."',".$price.",'".$unit."',".$category1_id.",".$category2_id.",'".$addTime."','".$addTime."',".$pictureId.",".$adminid.")";

    $model->execute($addSql);

    $this->redirect('index');
  }

  public function pick(){
    // 设为推荐服务
    $model=M();

    $infoId=$_GET['infoid'];
    $adminid=session("adminid");
    $opTime=date('Y-m-d');

    
    $opSql="UPDATE js_service SET is_pick=1,update_time='".$opTime."',manager_id=".$adminid." where id=".$infoId;
    $model->execute($opSql);

    $this->redirect('index');
  }

  public function unpick(){
    // 取消推荐
    $model=M();

    $infoId=$_GET['infoid'];
    $adminid=session("adminid");
    $opTime=date('Y-m-d');

    
    $opSql="UPDATE js_service SET is_pick=0,update_time='".$opTime."',manager_id=".$adminid." where id=".$infoId;
    $model->execute($opSql);

    $this->redirect('index');
  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];
    $adminid=session("adminid");
    $deleteTime=date('Y-m-d');

    //删除：将state设为0
    $deleteSql="UPDATE js_service SET state=0,update_time='".$deleteTime."',manager_id=".$adminid." where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');
  }





}

?>