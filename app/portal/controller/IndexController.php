<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;
use app\portal\service\PostService;
use cmf\controller\HomeBaseController;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $postService         = new PostService();
        $case_list = $postService->publishedArticle(0,0);
        $new_list = $postService->publishedArticle(0,0);
        $this->assign('caseList', $case_list);
        $this->assign('newsList', $new_list);
        return $this->fetch(':index');
    }
}
