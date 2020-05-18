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
        $list = Db::name($this->table)->where(['status'=>1])->paginate(15);
        $this->assign('list',$list);
        return $this->fetch();
    }


    public function add(){
        if($this->request->isPost()){
               $data['title'] =
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


    /**
     * 上传图片
     */
    public function uploadfimgs(){
        // 获取上传文件
        $file =$this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH.'public/uploads/imgs/wen/';

        if(!is_dir($path)){
            mkdir($path,0755,true);
        }

        $info = $file->move($path);
        if($info){
            $mes = $info->getSaveName();
            $mes = str_replace("\\",'/',$mes);
            return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/wen/'.$mes]);
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code'=>'400','msg'=>$mes]);
        }
    }

}