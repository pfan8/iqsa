<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\portal\service;

use app\portal\model\PortalOfferModel;
use think\db\Query;

class OfferService
{
    /**
     * 订单查询
     * @param      $filter
     * @param bool $isPage
     * @return \think\Paginator
     * @throws \think\exception\DbException
     */
    public function adminOfferList($filter)
    {
        $portalOfferModel = new PortalOfferModel();
        $field = 'id,cpn,region,created_time,shzr_overall,scpz_overall,fkaq_overall,gltx_overall,xxaq_overall,used';
        $offers        = $portalOfferModel -> field($field)
            ->where('delete_time',0)
            ->where('created_time', '>=', 0)
            ->where(function (Query $query) use ($filter) {

                $startTime = empty($filter['start_time']) ? 0 : strtotime($filter['start_time']);
                $endTime   = empty($filter['end_time']) ? 0 : strtotime($filter['end_time']);
                if (!empty($startTime)) {
                    $query->where('created_time', '>=', $startTime);
                }
                if (!empty($endTime)) {
                    $query->where('created_time', '<=', $endTime);
                }

                $keyword = empty($filter['keyword']) ? '' : $filter['keyword'];
                if (!empty($keyword)) {
                    $query->where('cpn|region|shzr_overall|scpz_overall|fkaq_overall|gltx_overall|xxaq_overall', 'like', "%$keyword%");
                }
            })
            ->order('created_time', 'DESC')
            ->paginate(10);
        return $offers;

    }

//    /**
//     * 页面管理查询
//     * @param int $pageId 文章id
//     * @return array|string|\think\Model|null
//     * @throws \think\db\exception\DataNotFoundException
//     * @throws \think\db\exception\ModelNotFoundException
//     * @throws \think\exception\DbException
//     */
//    public function publishedPage($pageId)
//    {
//
//        $where = [
//            'post_type'   => 2,
//            'post_status' => 1,
//            'delete_time' => 0,
//            'id'          => $pageId
//        ];
//
//        $portalPostModel = new PortalPostModel();
//        $page            = $portalPostModel
//            ->where($where)
//            ->where('published_time', ['< time', time()], ['> time', 0], 'and')
//            ->find();
//
//        return $page;
//    }

}