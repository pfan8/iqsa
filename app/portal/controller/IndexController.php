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
use app\portal\service\ApiService;
use app\portal\service\PostService;
use cmf\controller\HomeBaseController;
use think\Cookie;

class IndexController extends HomeBaseController
{
    public function index()
    {
        $language = $this->request->param('lang', Cookie::has('lang') ? \cookie('lang') : 'zh-cn');
        if ($language == 'en-us') {
            Cookie::set('lang','en-us');
        } else {
            Cookie::set('lang','zh-cn');
        }
        $postService         = new PostService();
        $cate_case = $language=='zh-cn' ? 61 : 1005;
        $cate_news =  $language=='zh-cn' ? 8 : 1066;
        $this->assign('cate_case',$cate_case);
        $this->assign('cate_news',$cate_news);
        $filter_case = [
                'category' => $cate_case,
                'language' => $language
            ];
        $filter_news = [
            'category' => $cate_news,
            'language' => $language
        ];
        $case_list = $postService->adminPostList($filter_case);
        $new_list = $postService->adminPostList($filter_news);
        if ($language == 'zh-cn') {

            $param_cate['where'] = [
                'parent_id'  => 2,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p2'] = ApiService::categories($param_cate);
            $param_cate['where'] = [
                'parent_id'  => 3,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p3'] = ApiService::categories($param_cate);
            $param_cate['where'] = [
                'parent_id'  => 5,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p5'] = ApiService::categories($param_cate);
            $param_cate['where'] = [
                'parent_id'  => 73,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p73'] = ApiService::categories($param_cate);
        } else {

            $param_cate['where'] = [
                'parent_id'  => 1002,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p1002'] = ApiService::categories($param_cate);
            $param_cate['where'] = [
                'parent_id'  => 1003,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p1003'] = ApiService::categories($param_cate);
            $param_cate['where'] = [
                'parent_id'  => 1004,
            ];
            $param_cate['order'] = 'id ASC';
            $categorys['p1004'] = ApiService::categories($param_cate);
        }
        $this->assign('categorys', $categorys);
        $this->assign('caseList', $case_list);
        $this->assign('newsList', $new_list);
        return $this->fetch(':index');
    }
}
