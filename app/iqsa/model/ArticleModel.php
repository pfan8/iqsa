<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Powerless < wzxaini9@gmail.com>
// +----------------------------------------------------------------------
namespace app\iqsa\model;

use think\Db;
use think\Model;

class ArticleModel extends Model
{

    public function getCaseList($language)
    {
        if ($language == 'cn')
        {
            $result = Db::name('iqsa_archive_cn')
                ->where('typeid',61)
                ->limit(10)
                ->order('sortrank desc')
                ->select();
        } else {
            $result = Db::name('iqsa_archive_en')
                ->order('sortrank desc')
                ->where('typeid',61)
                ->limit(10)
                ->select();
        }
        if (!empty($result)) {
            return $result;
        }
        return null;
    }

    public function getNewsList($language)
    {
        if ($language == 'cn')
        {
            $result = Db::name('iqsa_archive_cn')
                ->order('sortrank desc')
                ->where('typeid',8)
                ->limit(10)
                ->select();
        } else {

            $result = Db::name('iqsa_archive_en')
                ->order('sortrank desc')
                ->where('typeid',8)
                ->limit(10)
                ->select();
        }
        if (!empty($result)) {
            return $result;
        }
        return null;
    }


}
