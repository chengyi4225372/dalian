<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/14 0014
 * Time: 14:50
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use app\v1\controller\Base;

class Member extends Base {

    public function index(){

        return $this->fetch();
    }

    public function add(){

        return $this->fetch();
    }

    public function edit(){
        return $this->fetch();
    }


    public function del(){
        return $this->fetch();
    }
}