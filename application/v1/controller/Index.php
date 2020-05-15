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
       return $this->fetch();
   }

    public function welcome(){
        $member = Db::name('users')->where(['status'=>1])->count();
        $gongs  = Db::name('gao')->where(['status'=>1])->count();
        $news   = Db::name('news')->where(['status'=>1])->count();
        $this->assign('members',$member);
        $this->assign('gongs',$gongs);
        $this->assign('news',$news);
        return $this->fetch();
    }
    
}