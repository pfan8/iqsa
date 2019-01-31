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

use think\Model;
use think\Db;

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
        $data = $this->setOverall($data);
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
    /**
     * 标记报价表单
     * @param $data
     * @return bool
     */
    public function markOffer($data)
    {
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            $data['used'] = $data['used'] ? 0 : 1;
            self::startTrans();
            try {
                $this->allowField('used')->where('id', $id)->update($data);
                self::commit();
            } catch (\Exception $e) {
//                echo $e;
                self::rollback();
                return false;
            }
            return true;
        } elseif (isset($data['ids'])) {
            $ids = $data['ids'];

            $res = $this->where('id', 'in', $ids)
                ->select();
            if ($res) {
                Db::startTrans(); //开启事务
                $transStatus = false;
                try {
                    foreach ($res as $offer) {
                        $offer['used'] = $offer['used'] ? 0 : 1;
                        Db::name('portal_offer')->where('id', $offer['id'])
                            ->update([
                                'used' => $offer['used']
                            ]);
                    }
                    $transStatus = true;
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();
                }
                return $transStatus;
            } else {
                return false;
            }
        }
    }

    /**
     * @param $data
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function adminDeleteOffer($data)
    {

        if (isset($data['id'])) {
            $id = $data['id']; //获取删除id

            $res = $this->where('id', $id)->find();

            if ($res) {
                $res = json_decode(json_encode($res), true); //转换为数组

                $recycleData = [
                    'object_id'   => $res['id'],
                    'create_time' => time(),
                    'table_name'  => 'portal_offer#page',
                    'name'        => $res['cpn'],

                ];

                Db::startTrans(); //开启事务
                $transStatus = false;
                try {
                    Db::name('portal_offer')->where('id', $id)->update([
                        'delete_time' => time()
                    ]);
                    Db::name('recycle_bin')->insert($recycleData);

                    $transStatus = true;
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {

                    // 回滚事务
                    Db::rollback();
                }
                return $transStatus;


            } else {
                return false;
            }
        } elseif (isset($data['ids'])) {
            $ids = $data['ids'];

            $res = $this->where('id', 'in', $ids)
                ->select();

            if ($res) {
                $res = json_decode(json_encode($res), true);
                foreach ($res as $key => $value) {
                    $recycleData[$key]['object_id']   = $value['id'];
                    $recycleData[$key]['create_time'] = time();
                    $recycleData[$key]['table_name']  = 'portal_offer';
                    $recycleData[$key]['name']        = $value['cpn'];

                }

                Db::startTrans(); //开启事务
                $transStatus = false;
                try {
                    Db::name('portal_offer')->where('id', 'in', $ids)
                        ->update([
                            'delete_time' => time()
                        ]);


                    Db::name('recycle_bin')->insertAll($recycleData);

                    $transStatus = true;
                    // 提交事务
                    Db::commit();

                } catch (\Exception $e) {

                    // 回滚事务
                    Db::rollback();


                }
                return $transStatus;


            } else {
                return false;
            }

        } else {
            return false;
        }
    }


    public function setOverall($data)
    {
        // 社会责任管理类 整合字段
        $shzr_overall = '';
        if (isset($data['icti'])) $shzr_overall .= "ICTI";
        if (isset($data['bsci'])) $shzr_overall .= "," . "BSCI";
        if (isset($data['disney'])) $shzr_overall .= "," . "Disney";
        if (isset($data['walmart'])) $shzr_overall .= "," . "Wal-mart";
        if (isset($data['rba'])) $shzr_overall .= "," . "RBA(EICC)";
        if (isset($data['sedex'])) $shzr_overall .= "," . "SEDEX(SMETA)";
        if (isset($data['wrap'])) $shzr_overall .= "," . "WRAP";
        if (isset($data['coc'])) $shzr_overall .= "," . "COC";
        if (isset($data['wca'])) $shzr_overall .= "," . "WCA";
        if (isset($data['sa8000'])) $shzr_overall .= "," . "SA8000";
        if ($data['shzrother'] != '') $shzr_overall .= "," . $data['shzrother'];
        if (!empty($shzr_overall)) {
            if ($shzr_overall[0] == ',') {
                $shzr_overall = substr($shzr_overall, 1);
            }
        }
        $data['shzr_overall'] = $shzr_overall;
        // 生产品质管理类 整合字段
        $scpz_overall = '';
        if (isset($data['sqp'])) $scpz_overall .= "SQP";
        if (isset($data['gmp'])) $scpz_overall .= "," . "GMP";
        if (isset($data['haccp'])) $scpz_overall .= "," . "HACCP";
        if (isset($data['iatf16949'])) $scpz_overall .= "," . "IATF16949";
        if (isset($data['fcca'])) $scpz_overall .= "," . "沃尔玛FCCA";
        if ($data['scpzother'] != '') $scpz_overall .= "," . $data['scpzother'];
        if (!empty($scpz_overall)) {
            if ($scpz_overall[0] == ',') {
                $scpz_overall = substr($scpz_overall, 1);
            }
        }
        $data['scpz_overall'] = $scpz_overall;
        // 反恐安全管理类 整合字段
        $fkaq_overall = '';
        if (isset($data['ctpat'])) $fkaq_overall .= "C-TPAT";
        if (isset($data['gsv'])) $fkaq_overall .= "," . "GSV";
        if (isset($data['scan'])) $fkaq_overall .= "," . "SCAN";
        if (isset($data['scs'])) $fkaq_overall .= "," . "沃尔玛SCS";
        if ($data['fkaqother'] != '') $fkaq_overall .= "," . $data['fkaqother'];
        if (!empty($fkaq_overall)) {
            if ($fkaq_overall[0] == ',') {
                $fkaq_overall = substr($fkaq_overall, 1);
            }
        }
        $data['fkaq_overall'] = $fkaq_overall;
        // 管理体系认证类 整合字段
        $gltx_overall = '';
        if (isset($data['iso45000'])) $gltx_overall .= "ISO45000";
        if (isset($data['iso14000'])) $gltx_overall .= "," . "ISO14000";
        if (isset($data['iso9000'])) $gltx_overall .= "," . "ISO9000";
        if ($data['gltxother'] != '') $gltx_overall .= "," . $data['gltxother'];
        if (!empty($gltx_overall)) {
            if ($gltx_overall[0] == ',') {
                $gltx_overall = substr($gltx_overall, 1);
            }
        }
        $data['gltx_overall'] = $gltx_overall;
        // 信息安全认证类 整合字段
        $xxaq_overall = '';
        if (isset($data['iso27000'])) $xxaq_overall .= "ISO27001";
        if ($data['xxaqother'] != '') $xxaq_overall .= "," . $data['xxaqother'];
        if (!empty($xxaq_overall)) {
            if ($xxaq_overall[0] == ',') {
                $xxaq_overall = substr($xxaq_overall, 1);
            }
        }
        $data['xxaq_overall'] = $xxaq_overall;
        return $data;
    }

}