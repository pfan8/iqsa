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
<<<<<<< HEAD
        $language = $this->request->param('lang', 'cn');
        $postService         = new PostService();

        $filter_case = [
                'category' => $language=='cn' ? 61 : 1005,
                'language' => $language
            ];
        $filter_news = [
            'category' => $language=='cn' ? 8 : 1066,
            'language' => $language
=======
        $postService         = new PostService();
        $filter_case = [
                'category' => 61
            ];
        $filter_news = [
            'category' => 8
>>>>>>> 1cf5c36160afd82963cf50beaa693213ea01c59e
        ];
        $case_list = $postService->adminPostList($filter_case);
        $new_list = $postService->adminPostList($filter_news);
        $this->assign('caseList', $case_list);
        $this->assign('newsList', $new_list);
<<<<<<< HEAD
        if($language == 'cn')
            return $this->fetch(':index_cn');
        elseif($language == 'en')
            return $this->fetch(':index_en');
        else
            return $this->error('Language Set Error（语言设置有误）');
=======
        return $this->fetch(':index');
>>>>>>> 1cf5c36160afd82963cf50beaa693213ea01c59e
    }
}
