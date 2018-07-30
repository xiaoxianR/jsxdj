<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 企业文化控制器
*/
class CultureController extends Controller
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
    $infoSql="SELECT company_info.*,picture.path FROM company_info JOIN picture ON company_info.picture_id=picture.id  WHERE  type=2";
    $infoList=$model->query($infoSql);

    $this->assign("info",$infoList[0]);


    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];//获取要修改信息的id

    $title=$_POST['title'];
    $key_words=$_POST['key_words'];
    $content=$_POST['content'];


     $picturePath=uploadPicture();//上传图片
     echo "paht=".$picturePath;
     if (!$picturePath) {    //未选择图片
       $updateSql="UPDATE company_info SET title='".$title."', content='".$content."',key_words='".$key_words."' WHERE id=".$updateId;
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
      $updateSql="UPDATE company_info SET title='".$title."', content='".$content."',key_words='".$key_words."',picture_id=".$pictureId." WHERE id=".$updateId;

     }



     $model->execute($updateSql);


     $this->redirect('index');



  }







}

?>