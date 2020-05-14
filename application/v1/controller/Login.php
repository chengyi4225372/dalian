<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 17:37
 */
namespace app\v1\controller;

use think\Controller;
use think\Db;

class Login extends Controller {
   protected  $dataform ='users';


    /**
     * @return bool|mixed\
     * 登录
     */
    public function index(){
        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){
            $users = input('post.users','','trim');
            $pwd   = input('post.pwds','','trim');
            $data = Db::name($this->dataform)->where('users',$users)->find();
            if(empty($data)){
                return json(['code'=>'302' ,'msg'=>'账号或者密码为空']);
            }

             if(md5($pwd) !== $data['pwd']){
                 return json(['code'=>'402' ,'msg'=>'密码不正确']);
            }

            if(isset($data) && md5($pwd) == $data['pwd']){
                 session('amember',$data);
                 return json(['code'=>'200' ,'msg'=>'登录成功']);
            }
        }

        return false;
    }


    public function loginout(){
        if($this->request->isGet()){

        }
        return false;
    }




}