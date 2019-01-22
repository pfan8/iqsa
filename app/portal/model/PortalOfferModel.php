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
namespace app\portal\model;

use think\db\Query;
use think\Model;

class PortalOfferModel extends Model
{

    /**
     * 添加报价表单
     * @param $data
     * @return bool
     */
    public function addOffer($data)
    {
        $result = true;
        self::startTrans();
        try {
            $this->allowField(true)->save($data);
            self::commit();
        } catch (\Exception $e) {
            self::rollback();
            $result = false;
        }

        return $result;
    }


}