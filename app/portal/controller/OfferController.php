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
use app\portal\model\PortalOfferModel;
use cmf\controller\HomeBaseController;
use think\Loader;

class OfferController extends HomeBaseController
{
    public function index()
    {
        return $this->fetch(':offer');
    }

    public function addOffer()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $phone = $data['phone'];
            if(!preg_match('#^1[34578]\d{9}$#',$phone)&&
                !preg_match('#^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$#',$phone)){
                $this->error("电话号码格式错误");
            }
            $validate = Loader::validate('PortalOffer');

            if(!$validate->check($data)){
                $this->error($validate->getError());
            }

            $portalOfferModel = new PortalOfferModel();

            $portalOfferModel->addOffer($data);

            $this->success('添加成功!','/portal/offer');
        }
    }
}
