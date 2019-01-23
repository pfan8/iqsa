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
namespace app\portal\controller;

use app\portal\model\PortalOfferModel;
use app\portal\service\OfferService;
use cmf\controller\AdminBaseController;

class AdminOfferController extends AdminBaseController
{

    /**
     * 订单管理
     * @adminMenu(
     *     'name'   => '订单管理',
     *     'parent' => 'iqsa/AdminIndex/default',
     *     'display'=> true,
     *     'hasView'=> true,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '订单管理',
     *     'param'  => ''
     * )
     */
    public function index()
    {
        $content = hook_one('portal_admin_offer_index_view');

        if (!empty($content)) {
            return $content;
        }

        $param = $this->request->param();

        $offerModel = new OfferService();
        $data        = $offerModel->adminOfferList($param);
        $data->appends($param);

        $this->assign('keyword', isset($param['keyword']) ? $param['keyword'] : '');
        $this->assign('start_time', isset($param['start_time']) ? $param['start_time'] : '');
        $this->assign('end_time', isset($param['end_time']) ? $param['end_time'] : '');
        $this->assign('pages', $data->items());
        $this->assign('page', $data->render());

        return $this->fetch();
    }

    /**
     * 标记订单
     * @author    pfan8
     * @adminMenu(
     *     'name'   => '标记订单',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '标记订单',
     *     'param'  => ''
     * )
     */
    public function mark()
    {
        $portalOfferModel = new PortalOfferModel();
        $data            = $this->request->param();

        $result = $portalOfferModel->markOffer($data);
        if ($result) {
            if (isset($data['used'])) {
                $message = $data['used'] ? '取消标记成功' : '标记成功';
            } else {
                $message = '修改标记成功';
            }
            $this->success(lang($message));
        } else {
            $this->error(lang('标记失败'));
        }

    }

    /**
     * 删除订单
     * @author    iyting@foxmail.com
     * @adminMenu(
     *     'name'   => '删除订单',
     *     'parent' => 'index',
     *     'display'=> false,
     *     'hasView'=> false,
     *     'order'  => 10000,
     *     'icon'   => '',
     *     'remark' => '删除订单',
     *     'param'  => ''
     * )
     */
    public function delete()
    {
        $portalOfferModel = new PortalOfferModel();
        $data            = $this->request->param();

        $result = $portalOfferModel->adminDeleteOffer($data);
        if ($result) {
            $this->success(lang('DELETE_SUCCESS'));
        } else {
            $this->error(lang('DELETE_FAILED'));
        }

    }

}
