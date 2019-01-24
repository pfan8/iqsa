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

use cmf\controller\HomeBaseController;
use app\portal\service\PostService;
use app\portal\model\PortalCategoryModel;

class OtherPageController extends HomeBaseController
{
    /**
     * 页面管理
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $postService = new PostService();
        $pageId      = $this->request->param('id', 0, 'intval');
        $lmId = 0;
        $pages = array();
        if (cookie('lang') == 'en-us') {
            if ($pageId == 10290) {
                $lmId = 1;
                array_push($pages, $postService->publishedPage(10290));
            } else if ($pageId > 10290 && $pageId <= 10292) {
                $lmId = 2;
                array_push($pages, $postService->publishedPage(10291));
                array_push($pages, $postService->publishedPage(10292));
            } else if ($pageId == 10293) {
                $lmId = 3;
                array_push($pages, $postService->publishedPage(10293));
            } else if ($pageId > 10293 && $pageId <= 10299) {
                $lmId = 4;
                array_push($pages, $postService->publishedPage(10294));
                array_push($pages, $postService->publishedPage(10295));
                array_push($pages, $postService->publishedPage(10296));
                array_push($pages, $postService->publishedPage(10297));
                array_push($pages, $postService->publishedPage(10298));
                array_push($pages, $postService->publishedPage(10299));
            } else if ($pageId == 10284) {
                $lmId = 5;
                $page = $postService->publishedPage(10284);
                $page['post_title'] = 'Company Qualification';
                array_push($pages, $page);
            } else if ($pageId == 10304) {
                $lmId = 6;
                array_push($pages, $postService->publishedPage(10304));
            } else if ($pageId > 10304 && $pageId <= 10306) {
                $lmId = 7;
                array_push($pages, $postService->publishedPage(10305));
                array_push($pages, $postService->publishedPage(10306));
            } else if($pageId > 10306 && $pageId <= 10308) {
                $lmId = 8;
                array_push($pages, $postService->publishedPage(10307));
                array_push($pages, $postService->publishedPage(10308));
            }


            $left_menu = array();
            if ($pageId < 10300) {
                $left_menu_name = 'About';
                $left_menu = array(['pid'=>10290,'name'=>'Company Profile','lm'=>1],
                    ['pid'=>10291,'name'=>'Development History','lm'=>2],
                    ['pid'=>10293,'name'=>'Why IQSA?','lm'=>3],
                    ['pid'=>10294,'name'=>'Scope of Services','lm'=>4],
                    ['pid'=>10284,'name'=>'Company Qualification','lm'=>5]);
            } elseif ($pageId < 10307) {
                $left_menu_name = 'FIP';
                $left_menu = array(['pid'=>10305,'name'=>'IQSA·FIP','lm'=>6],
                    ['pid'=>10306,'name'=>'IQSA·Could','lm'=>7]);
            }
        } else {
            if ($pageId == 10274) {
                $lmId = 1;
                array_push($pages, $postService->publishedPage(10274));
            } else if ($pageId > 10274 && $pageId <= 10276) {
                $lmId = 2;
                array_push($pages, $postService->publishedPage(10275));
                array_push($pages, $postService->publishedPage(10276));
            } else if ($pageId == 10277) {
                $lmId = 3;
                array_push($pages, $postService->publishedPage(10277));
            } else if ($pageId > 10277 && $pageId <= 10283) {
                $lmId = 4;
                array_push($pages, $postService->publishedPage(10278));
                array_push($pages, $postService->publishedPage(10279));
                array_push($pages, $postService->publishedPage(10280));
                array_push($pages, $postService->publishedPage(10281));
                array_push($pages, $postService->publishedPage(10282));
                array_push($pages, $postService->publishedPage(10283));
            } else if ($pageId == 10284) {
                $lmId = 5;
                array_push($pages, $postService->publishedPage(10284));
            } else if ($pageId == 10285) {
                $lmId = 6;
                array_push($pages, $postService->publishedPage(10285));
            } else if ($pageId > 10285 && $pageId <= 10287) {
                $lmId = 7;
                array_push($pages, $postService->publishedPage(10286));
                array_push($pages, $postService->publishedPage(10287));
            } else if($pageId > 10287 && $pageId <= 10289) {
                $lmId = 8;
                array_push($pages, $postService->publishedPage(10288));
                array_push($pages, $postService->publishedPage(10289));
            }


            $left_menu = array();
            if ($pageId < 10285) {
                $left_menu_name = '关于我们';
                $left_menu = array(['pid'=>10274,'name'=>'公司简介','lm'=>1],
                    ['pid'=>10275,'name'=>'发展历程','lm'=>2],
                    ['pid'=>10277,'name'=>'企业优势','lm'=>3],
                    ['pid'=>10278,'name'=>'服务范围','lm'=>4],
                    ['pid'=>10284,'name'=>'公司资质','lm'=>5]);
            } elseif ($pageId < 10288) {
                $left_menu_name = '验厂通';
                $left_menu = array(['pid'=>10285,'name'=>'综中和·验厂通','lm'=>6],
                    ['pid'=>10286,'name'=>'综中和·云','lm'=>7]);
            }
        }

        $this->assign('lmId',$lmId);
        if (empty($pages)) {
            abort(404, ' 页面不存在!');
        }
        $this->assign('pages', $pages);

        $more = $pages[0]['more'];

        $tplName = empty($more['template']) ? 'other_page' : $more['template'];
        $img = empty($more['photos']) ? 'null' : $more['photos'][0];
        $this->assign('img', $img);
        $this->assign('left_menu',$left_menu);
        $this->assign('left_menu_name',empty($left_menu_name)?'':$left_menu_name);
        return $this->fetch("/$tplName");
    }

}
