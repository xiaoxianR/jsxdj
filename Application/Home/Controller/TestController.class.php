<?php
namespace Home\Controller;
use Think\Controller;

/**
*
*/
class TestController extends Controller
{

  public function index()
  {

    $model=M();

    //basic表添加数据
    //$nameArr=array("公司名称","联系电话","网站备案","客服电话","客服QQ","商务邮箱","公司地址");
    //$valueArr=array("重庆圣灵科技信息有限公司 ","023-62897001","渝TCP备案：16004600号","023-62897001/023-62891977","77981978","sl@cqslkj.cn","重庆市南岸区南坪百盛浪高凯悦国际商务大厦B座24楼C1");
    //$typeArr=array(1,3,3,2,2,2,2);
    //$sql="";
    //for ($i=0;$i<count($nameArr);$i++) {
      //$sql="insert into basic(name,value,type) values ('".$nameArr[$i]."','".$valueArr[$i]."',".$typeArr[$i].")";
      /*$sql="insert into basic(title,introduction,type) values ('高端网站搭建，专属定制','专业技术团队，轻松搭建属于自己网站',5)";
      for($i=0;$i<3;$i++){
      $model->execute($sql);
    }*/
      //$model->execute($sql);
    //}

    //link表添加数据
   /* $nameArr=array("U站网","建筑劳务网","小咪拉票网","票盟");
    $urlArr=array("http://www.u-z.wang","http://www.jz-lw.com","http://www.2017828.cn","http://www.2017828.com");
    $introArr=array("App/微站/网站开发服务","建筑劳务信息网","拉票网","投票网");
    for ($i=0;$i<count($nameArr);$i++) {
      $sql="insert into link(web_name,web_url,introduction) values ('".$nameArr[$i]."','".$urlArr[$i]."','".$introArr[$i]."')";
      $model->execute($sql);
    }*/

    //picture表添加
   /* $sql="insert into picture(path) values ('./Public/home/images/ultra.jpg')";
    for($i=0;$i<1;$i++){
      $model->execute($sql);
    }*/

    //修改图片路径
    /*$pictureList=$model->query("select * from picture");
    foreach ($pictureList as $picture) {
      $path=$picture['path'];
      $path=str_replace("/thinkphp_sl/","/",$path);
      $sql="update picture set path='".$path."'"." where id=".$picture['id'];
      $model->execute($sql);

    }*/


    //company_info表添加
    /*$sql="insert into company_info(type,title,content) values (2,'公司文化决定企业态度',' 精诚为企业信息化所做的努力使其解决方案和技术服务向着更广泛和更高层次的领域迈进。回首来路，我们把取得的成绩看作是一个新的起点。我们将继续发挥最大的技术优势，以高品质的产品，一流的服务，在互联网领域中永远领先一步。与强者为伍，与巨人同行，面前的道路没有终点，前进的脚步永不停息！') ";
    $model->execute($sql);*/


    //business表添加
   /* $nameArr=array("计算机硬件批发","网络工程建设","企业信息化智能建站","网站专属定制与开发","智能化办公","软件及游戏开发","微信公众号开发和运营","移动手机端/APP开发","网上商城店铺装修和运营");
    $summaryArr=array("","","","","","","","","");
    $introArr=array("","","","","","","","","");
    //$sql="";
    for ($i=0;$i<count($nameArr);$i++) {
      $sql="insert into business(business_name,summary,introduction) values ('".$nameArr[$i]."','".$summaryArr[$i]."','".$introArr[$i]."')";
      $model->execute($sql);
    }*/

    //案例添加

   /* $titleArr=array("重庆奎星楼","重庆申新大厦","U站网","小咪拉票网");
    $introArr=array("综合布线+智能系统集成","综合布线+智能系统集成","专业定制属于您的专属网站/APP等服务","最专业的拉票投票网站");
    for($i=0;$i<count($titleArr);$i++){
      //$sql="insert into case_info(title,introduction) values ('".$titleArr[$i]."','".$introArr[$i]."')";
      $sql="update case_info set introduction='".$introArr[$i]."'"." where id=".($i+1);
      $model->execute($sql);

    }*/


    //question表添加
    /*$sql="insert into question(title,answer) values ('什么是综合布线？','综合布线是一种模块化的、灵活性极高的建筑物内或建筑群之间的信息传输通道。通过它可使话音设备、数据设备、交换设备及各种控制设备与信息管理系统连接起来，同时也使这些设备与外部通信网络相连的综合布线。')";

    for($i=0;$i<3;$i++){
      $model->execute($sql);
    }*/

   //添加新闻
   /*$sql="insert into news(type,title,content) values (1,'重庆圣灵科技信息有限公司官网改版上线','重庆圣灵科技信息有限公司其前身是1997年成立的重庆吉力电脑，后于2004年4月更名正式成立重庆市圣灵科技信息有限公司，圣灵科技一直致力于给大中小企业、事业单位、政府机关等搭建互联网高科技电子商务信息平台和网络平台综合服务平台的互联网科技公司！')";
   for($i=0;$i<10;$i++){
      $model->execute($sql);
    }*/

    //招聘推荐
    /*$sql="insert into recruit(position,introduction) values ('文案编辑','不不一工在一一一以一有一工少有有一一工在在一工在发了了了工工有有我我在')";

    for($i=0;$i<4;$i++){
      $model->execute($sql);
    }
*/
    //team表添加
    /*$sql="insert into team(name,position,words) values ('李继宏','首席网站设计师','“在圣灵科技这段时间，总结出一个道理：千里马不应待在骡子群当中，选择最适合施展你能力的平台，而不是薪水最高的那个。”')";

    for($i=0;$i<5;$i++){
      $model->execute($sql);
    }*/

    //产品类型添加
    //$sql="insert into product_type(name,picture_id) values ('计算机硬件',16)";
    //


    //产品添加
   /* $sql="insert into product(type_id,title,introduction) values (1,'主机','是啊个个啊想车吧v从啊爱的的额他啊是的了看去额他想吧车是的人人额啊的你')";
    for($i=0;$i<6;$i++){
      $model->execute($sql);
    }*/



    $this->show("test");
  }

public function getLocation(){



        //淘宝IP
        $ip = get_client_ip(); //获取当前用户的ip
        echo "ip=".$ip."<br>";




  $ipaddress=getIPaddress();
  dump($ipaddress);
  $ip=taobaoIP($ipaddress);
  dump($ip);

  $this->show("location");

}







}



?>