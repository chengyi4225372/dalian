<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/18
 * Time: 23:33
 * 企业文化
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Wen extends Base {

    protected $table= 'wen';


    public  function index(){
        return $this->fetch();
    }


    public function add(){
        if($this->request->isPost()){

        }

        return $this->fetch();
    }

    public function  edit(){

        if($this->request->isGet()){
            return $this->fetch();
        }

        if($this->request->isPost()){

        }
        return false;
    }


    public function del(){
        if($this->request->isGet()){

        }

        return false;
    }
}