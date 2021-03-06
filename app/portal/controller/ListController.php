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

use app\portal\model\PortalCategoryModel;
use cmf\controller\HomeBaseController;

class ListController extends HomeBaseController
{
    /***
     * 文章列表
     * @return mixed
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $id                  = $this->request->param('id', 0, 'intval');
        $portalCategoryModel = new PortalCategoryModel();
        $categorys[] = $portalCategoryModel->where('id', $id)->where('status', 1)->find();
        $categoryids[] = $categorys[0]['id'];
        $temp = $portalCategoryModel->where('parent_id', $id)->where('status', 1)->select();
        // 字符转义
        $categorys[0]['content'] = htmlspecialchars_decode($categorys[0]['content']);
        foreach ($temp as $category) {
            $category['content'] = htmlspecialchars_decode($category['content']);
            $categorys[] = $category;
            $categoryids[] = $category['id'];
        }
        $this->assign('categorys', $categorys);
        $this->assign('categoryids', $categoryids);
        $listTpl = empty($category['list_tpl']) ? 'list' : $category['list_tpl'];
        return $this->fetch('/' . $listTpl);
    }

}
