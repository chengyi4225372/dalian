<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/15
 * Time: 13:24
 */

namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;

class Banner extends Base {

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

    /**
     * 上传图片
     */
    public function uploadfimgs(){
        // 获取上传文件
        $file =$this->request->file('file');
        // 验证图片,并移动图片到框架目录下。
        $path = ROOT_PATH.'public/uploads/imgs/fimgs/';

        if(!is_dir($path)){
            mkdir($path,0755,true);
        }

        $info = $file->move($path,false,true);
        if($info){
            $mes = $info->getSaveName();
            $mes = str_replace("\\",'/',$mes);
            return json(['code'=>'200','msg'=>'上传成功','path'=>'/uploads/imgs/fimgs/'.$mes]);
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
            return json(['code'=>'400','msg'=>$mes]);
        }
    }
}