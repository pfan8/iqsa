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
namespace app\portal\validate;

use think\Validate;

class PortalOfferValidate extends Validate
{
    protected $rule = [
        'email' => 'email',
        'gender' => 'in:0,1',
        'name' => 'chsAlpha|max:25',
        'cn' => 'number|min:0',
        'cpn' => 'chsDash',
        'mb' => 'chsDash',
    ];
    protected $message = [
        'name.chsAlpha' => '联系人姓名只能是汉子或英文字母',
        'email.emial' => '邮箱格式错误',
        'gender.in' => '性别非法',
        'name.max' => '姓名超过长度限制',
        'cn.number' => '工厂人数只能为数字',
        'cn.min' => '工厂人数必须为正',
        'cpn.chsDash' => '公司名称只能是汉字、字母、数字和下划线_及破折号-',
        'mb.chsDash' => '主营业务只能是汉字、字母、数字和下划线_及破折号-',
    ];
}