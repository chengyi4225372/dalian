<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 17:38
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\session;

class Base extends Controller {


    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub

        //判断session是否存在账号
        if(empty(session('member')) && $this->request->url() !== '/v1/index/index'){
           //  $this->redirect('login/index');
            //待完成 todo
        }

    }


}