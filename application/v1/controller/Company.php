<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/15
 * Time: 13:22
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;

class Company extends Controller {

    public function index(){

        return $this->fetch();
    }

}