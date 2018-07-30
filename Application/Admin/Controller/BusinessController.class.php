<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 业务管理控制器
*/
class BusinessController extends Controller
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
    $infoSql="SELECT business.*,picture.path FROM business JOIN picture ON business.picture_id=picture.id   WHERE  state=1";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT business.*,picture.path FROM business JOIN picture ON business.picture_id=picture.id WHERE business.id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $business_name=$_POST['business_name'];  //获取修改的信息
    $key_words=$_POST['key_words'];
    $introduction=$_POST['introduction'];
    $ismain=$_POST['ismain']; //1/2



    $picturePath=uploadPicture();//上传图片
    //dump($picturePath);
     //echo "paht=".$picturePath;
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE business SET business_name='".$business_name."', introduction='".$introduction."',ismain=".$ismain.",key_words='".$key_words."'"." WHERE id=".$updateId;
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
     $updateSql="UPDATE business SET business_name='".$business_name."', introduction='".$introduction."',ismain=".$ismain.",picture_id=".$pictureId.",key_words='".$key_words."'"." WHERE id=".$updateId;

     }
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();


    $title=$_POST['title'];  //获取修改的信息
    $key_words=$_POST['key_words'];
     $business_name=$_POST['business_name'];  //获取修改的信息
    $introduction=$_POST['introduction'];
    $ismain=$_POST['ismain']; //1/2



    $picturePath=uploadPicture();//上传图片

     //添加图片
      $addPicSql="INSERT INTO picture(path) VALUES ('".$picturePath."')";
      $model->execute($addPicSql);

      //查询添加图片id
      $pictureSql="SELECT MAX(id) AS maxid FROM picture";
      $idList=$model->query($pictureSql);
      $pictureId=$idList[0]['maxid'];

    $addSql="INSERT INTO business(business_name,introduction,key_words,ismain,picture_id) values ('".$business_name."','".$introduction."','".$key_words."',".$ismain.",".$pictureId.")";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE business SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>