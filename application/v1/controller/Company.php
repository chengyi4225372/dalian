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
use app\v1\controller\Base;
class Company extends Base {

    public function index(){
        if($this->request->isGet()){
            $info =Db::name('company')->order('id desc')->find();
            $this->assign('info',$info);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $mid  = input('post.mid');
            $text = input('post.text');
            if(empty($mid) || !isset($mid)){
                $ret = Db::name('company')->insert(['texts'=>$text]);
            }else {
                $ret = Db::name('company')->where(['id'=>$mid])->update(['texts'=>$text]);
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