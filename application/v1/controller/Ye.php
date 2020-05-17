<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/15
 * Time: 13:22
 * 企业文话
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Ye extends Base {

    public function index(){

        if($this->request->isGet()){
            $info = Db::name('ye')->order('id desc')->find();
            $this->assign('info',$info);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $mid  = input('post,id');
            $text = input('post,text');
            if(empty($mid) || !isset($mid)){
                $ret = Db::name('ye')->insert(['texts'=>$text]);
            }else {
                $ret = Db::name('ye')->where(['id'=>$mid])->update(['texts'=>$text]);
            }

            if($ret !== false){
                return json(['code'=>200,'msg'=>'提交成功']);
            }else{
                return json(['code'=>400,'msg'=>'提交失败']);
            }
        }

        return false;
    }
}