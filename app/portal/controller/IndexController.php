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
        $filter_case = [
                'category' => 61
            ];
        $filter_news = [
            'category' => 8
        ];
        $case_list = $postService->adminPostList($filter_case);
        $new_list = $postService->adminPostList($filter_news);
        $this->assign('caseList', $case_list);
        $this->assign('newsList', $new_list);
        return $this->fetch(':index');
    }
}
