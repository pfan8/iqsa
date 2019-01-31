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
use think\Lang;
use think\Loader;

class OfferController extends HomeBaseController
{
    public function index()
    {
        return $this->fetch(':offer');
    }

    public function addOffer()
    {
//        $result = true;
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $phone = $data['phone'];
            if(!preg_match('#^1[34578]\d{9}$#',$phone)&&
                !preg_match('#^(\(\d{3,4}\)|\d{3,4}-|\s)?\d{7,14}$#',$phone)){
                $this->error("电话号码格式错误");
//                echo '<literal><script>alert("电话号码格式错误");</script></literal>';
//                $result = false;
//                $this->redirect('javascript:history.back(-1);');
            }
            $validate = Loader::validate('PortalOffer');

            if(!$validate->check($data)){
                $this->error($validate->getError());
//                echo '<literal><script>alert($validate->getError());</script></literal>';
//                $result = false;
            }

            $portalOfferModel = new PortalOfferModel();
            $data['created_time'] = time();
            $portalOfferModel->addOffer($data);

//            if ($result)

            $msg = Lang::get('OFFER_FEEDBACK');
            $this->success($msg,'/portal/offer');
        }
    }
}
