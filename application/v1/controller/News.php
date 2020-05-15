<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/5/13 0013
 * Time: 18:11
 * 新闻控制器
 */
namespace  app\v1\controller;

use think\Controller;
use think\Db;
use think\Request;
use app\v1\controller\Base;
class News extends Base {

    protected $table = 'news';
    
    public function index(){
        $list = Db::name($this->table)->where(['status'=>1])->order('id desc')->paginate(15);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add(){
        if($this->request->isPost()){
            $data['title']   = input('post.title','','trim');
            $data['content'] = input('post.content','','trim');
            $data['create_time'] = time();

            if(empty($data['title'] || !isset($data['content']))){
                return false;
            }

            $rets = Db::name($this->table)->insertGetId($data);

            if($rets !== false){
                return json(['code'=>200,'msg'=>'操作成功']);
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

            $infos = Db::name($this->table)->where(['id'=>$mid,'status'=>1])
                ->find();

            $this->assign('infos',$infos);
            return $this->fetch();
        }

        if($this->request->isPost()){
            $mid     = input('post.mid');
            $title   = input('post.title','','trim');
            $content = input('post.content','','trim');

            if(empty($mid) || !isset($mid)){
                return false;
            }

            $ret = Db::name($this->table)->where(['id'=>$mid])->update(['title'=>$title,'content'=>$content]);

            if($ret !== false){
                return json(['code'=>200,'msg'=>'编辑成功']);
            }else{
                return json(['code'=>400,'msg'=>'编辑失败']);
            }
        }
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
            }else {
                return json(['code'=>400,'msg'=>'删除失败']);
            }
        }
        return false;
    }

}