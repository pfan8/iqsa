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
use think\Cookie;
use think\Db;

class PageController extends HomeBaseController
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
        $categoryId      = $this->request->param('cid', 0, 'intval');
        $page        = $postService->publishedPage($pageId);
        if($categoryId == '4' | $categoryId == '141' | $categoryId == '1005') {
            $portalCategoryModel = new PortalCategoryModel();
            $category = $portalCategoryModel->where('id', $categoryId)->where('status', 1)->find();

            $this->assign('category', $category);
        }
        if (empty($page)) {
            abort(404, ' 页面不存在!');
        }
        $this->assign('theme_page', $page);
        $this->assign('cid', $categoryId);

        $more = $page['more'];

        $tplName = empty($more['template']) ? 'page' : $more['template'];
        return $this->fetch("/$tplName");
    }

    public function ruanjianzt()
    {
        return $this->fetch("/ruanjianzt");
    }

}
