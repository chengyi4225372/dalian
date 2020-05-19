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
               $data['title'] = input('post.title');
               $data['imgs'] = input('post.imgs');
               $data['content'] = input('post.content');
               $data['create_time'] = time();

              $res = Db::name('wen')->insertGetId($data);

            if($res !== false){
                return json(['code'=>200,'msg'=>'添加成功']);
            }else{
                return json(['code'=>400,'msg'=>'添加失败']);
            }
        }

        return $this->fetch();
    }

    public function edit(){

        if($this->request->isGet()){
            $mid = input('get.mid');

            if(empty($mid) || !isset($mid)){
                return false;
            }
            $info =  Db::name('wen')->where(['id'=>$mid])->find();
            $this->assign('info',$info);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $data['title'] = input('post.title');
            $data['imgs'] = input('post.imgs');
            $data['content'] = input('post.content');
            $mid = input('post.mid');

            if(empty($mid) || !isset($mid)){
                return false;
            }

            $ret = Db::name('wen')->where(['id'=>$mid])->update($data);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>400,'msg'=>'编辑失败']);
            }

        }

        return false;
    }

    public function del(){
        if($this->request->isGet()){
            $mid = input('get.mid');

            if(empty($mid) || !isset($mid)){
                return false;
            }
            $ret = Db::name('wen')->where(['id'=>$mid])->update(['status'=>1]);
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