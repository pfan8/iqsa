<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\iqsa\controller;

use app\iqsa\model\ArticleModel;
use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    /**
     * 首页
     */
    public function index()
    {
        $articleModel = new ArticleModel();
        $caseList = $articleModel->getCaseList('cn');
        $newsList = $articleModel->getNewsList('cn');
//        if (empty($caseList)) {
//            $this->error("查无此人！");
//        }

        $this->assign('caseList',$caseList);
        $this->assign('newsList',$newsList);
        return $this->fetch(':index');
    }

}
