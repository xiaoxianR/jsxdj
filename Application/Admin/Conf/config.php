<?php
return array(
	//'配置项'=>'配置值'
  //开启路由
  'URL_ROUTER_ON' => true,
  'URL_ROUTE_RULES' =>array(
    'manager/[:infoid\d]'=>'Manager/index',
    'manager/update/[:updateid\d]'=>'Manager/update',
    'manager/delete/[:deleteid\d]'=>'Manager/delete',

    'category1/[:infoid\d]'=>'Category1/index',
    'category1/update/[:updateid\d]'=>'Category1/update',
    'category1/delete/[:deleteid\d]'=>'Category1/delete',

    'category2/[:infoid\d]'=>'Category2/index',
    'category2/update/[:updateid\d]'=>'Category2/update',
    'category2/delete/[:deleteid\d]'=>'Category2/delete',
    'category2/hot/[:infoid\d]'=>'Category2/hot',
    'category2/unhot/[:infoid\d]'=>'Category2/unhot',

    'hotservice/[:infoid\d]'=>'HotService/index',
    'hotservice/add'=>'HotService/add',
    'hotservice/update/[:updateid\d]'=>'HotService/update',
    'hotservice/delete/[:deleteid\d]'=>'HotService/delete',

    'ad/[:infoid\d]'=>'Ad/index',
    'ad/update/[:updateid\d]'=>'Ad/update',
    'ad/delete/[:deleteid\d]'=>'Ad/delete',

    'news/[:infoid\d]'=>'News/index',
    'news/update/[:updateid\d]'=>'News/update',
    'news/delete/[:deleteid\d]'=>'News/delete',

    'service/[:infoid\d]'=>'Service/index',
    'service/update/[:updateid\d]'=>'Service/update',
    'service/delete/[:deleteid\d]'=>'Service/delete',
    'service/getC2/[:c1id\d]'=>'Service/getC2',
    'service/pick/[:infoid\d]'=>'Service/pick',
    'service/unpick/[:infoid\d]'=>'Service/unpick',

    'basic/[:infoid\d]'=>'Basic/index',
    'basic/update/[:updateid\d]'=>'Basic/update',
    'banner/[:infoid\d]'=>'Banner/index',
    'banner/update/[:updateid\d]'=>'Banner/update',
    'banner/delete/[:deleteid\d]'=>'Banner/delete',
    'notice/[:infoid\d]'=>'Notice/index',
    'notice/update/[:updateid\d]'=>'Notice/update',
    'notice/delete/[:deleteid\d]'=>'Notice/delete',
    'introduction/update/[:updateid\d]'=>'Introduction/update',
    'culture/update/[:updateid\d]'=>'Culture/update',
    'question/[:infoid\d]'=>'Question/index',
    'question/update/[:updateid\d]'=>'Question/update',
    'question/delete/[:deleteid\d]'=>'Question/delete',
    'recruit/[:infoid\d]'=>'Recruit/index',
    'recruit/update/[:updateid\d]'=>'Recruit/update',
    'recruit/delete/[:deleteid\d]'=>'Recruit/delete',
    'team/[:infoid\d]'=>'Team/index',
    'team/update/[:updateid\d]'=>'Team/update',
    'team/delete/[:deleteid\d]'=>'Team/delete',
    'message/[:infoid\d]'=>'Message/index',
    'message/update/[:updateid\d]'=>'Message/update',
    'message/delete/[:deleteid\d]'=>'Message/delete',
    'link/[:infoid\d]'=>'Link/index',
    'link/update/[:updateid\d]'=>'Link/update',
    'link/delete/[:deleteid\d]'=>'Link/delete',
    'loginout/[:infoid\d]'=>'Index/loginout',
    'business/[:infoid\d]'=>'Business/index',
    'business/update/[:updateid\d]'=>'Business/update',
    'business/delete/[:deleteid\d]'=>'Business/delete',
    'product/[:infoid\d]'=>'Product/index',
    'product/update/[:updateid\d]'=>'Product/update',
    'product/delete/[:deleteid\d]'=>'Product/delete',
    'development/update/[:updateid\d]'=>'Development/update',
    'institution/update/[:updateid\d]'=>'Institution/update',
    'honor/update/[:updateid\d]'=>'Honor/update'
    ),
);