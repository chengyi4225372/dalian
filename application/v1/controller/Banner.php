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

    protected $table= 'banner';
    
    public function index(){
        $list = Db::name($this->table)->where(['status'=>1])->order('id desc')->paginate(15);
        $this->assign('list',$list);
        return $this->fetch();
    }
    
    public function add(){
        if($this->request->isPost()){
            $imgs = input('post.imgs','','trim');
            if(empty($imgs)){
                return false;
            }
            $ret = Db::name($this->table)->insertGetId(['imgs'=>$imgs,'create_time'=>time()]);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'添加成功']);
            }else {
                return json(['code'=>400,'msg'=>'添加失败']);
            }
        }
        return $this->fetch();
    }
    
    public function edit(){
        if($this->request->isPost()){
            $mid = input('post.mid','','int');
            $imgs= input('post.imgs','','trim');

            if(empty($mid) || !isset($mid)){
                return false;
            }

            $res= Db::name($this->table)->where(['id'=>$mid])->update(['imgs'=>$imgs]);

            if($res !== false){
                return json(['code'=>200,'msg'=>'编辑成功']);
            }else {
                return json(['code'=>400,'msg'=>'编辑失败']);
            }

        } 
        
        if($this->request->isGet()){
            $mid = input('get.mid','','int');
            if(empty($mid) || !isset($mid)){
                return false;
            }
            $info = Db::name($this->table)->where(['id'=>$mid])->find();
            $this->assign('info',$info);
            return $this->fetch();
        }
       return false;
    }
    
    public function del(){
        if($this->request->isGet()){
            $mid = input('get.mid');
            if(empty($mid) || !isset($mid)){
                return false;
            }


            $ret = Db::name($this->table)->where(['id'=>$mid])->update(['status'=>0]);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'删除成功']);
            }else{
                return json(['code'=>400,'msg'=>'删除失败']);
            }
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
        $path = ROOT_PATH.'public/uploads/imgs/fimgs/';

        if(!is_dir($path)){
            mkdir($path,0755,true);
        }

        $info = $file->move($path);
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