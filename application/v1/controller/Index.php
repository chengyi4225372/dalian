<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 17:39
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Session;
use app\v1\controller\Base;

class Index extends Base {

   public function index(){
       $member = session('amember');
       $this->assign('member',$member);
       return $this->fetch();
   }

    public function welcome(){
        $member = session('amember');
        $this->assign('member',$member);
        return $this->fetch();
    }
    
}