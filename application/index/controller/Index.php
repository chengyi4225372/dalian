<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    //首页
    public function index()
    {
        $news     =Db::name('news')->where(['status'=>1])->select();
        $gao      =Db::name('gao')->where(['status'=>1])->select();
        $company  =Db::name('company')->order('id desc')->find();
        $this->assign('news',$news);
        $this->assign('gao',$gao);
        $this->assign('company',$company);
        return $this->fetch();
    }

    /**
     * 新闻列表
     */
    public function news()
    {
        $list = Db::name('news')->where(['status'=>1])->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    /**
     * 新闻详情
     */
    public function info(){
        if($this->request->isGet()){
            $mid = input('get.mid','','int');

            if(empty($mid) || !isset($mid)){
                return false;
            }

            $infos = Db::name('news')->where(['id'=>$mid,'status'=>1])->find();

            $this->assign('infos',$infos);
            
            return $this->fetch();
        }

        return  false;
    }

    /**
     * 联系我们
     */
    public function contact()
    {
        return $this->fetch();
    }

    /**
     * 党建工作
     */
    public function works()
    {
        $dang = Db::name('dang')->order('id desc')->find();
        $this->assign('dang',$dang);
        return $this->fetch();
    }

    /**
     * 服务实施
     */
    public function service()
    {
        $ret = Db::name('ye')->order('id desc')->find();
        $this->assign('ret',$ret);
        return $this->fetch();
    }

    /**
     * 经营范围
     */
    public function rands()
    {
        $ret = Db::name('rands')->order('id desc')->find();
        $this->assign('ret',$ret);
        return $this->fetch();
    }

    /**
     * 企业文化
     */
    public function qiye()
    {

        return $this->fetch();
    }


    /**
     * 人力资源
     */
    public function resource()
    {
        return $this->fetch();
    }

    /**
     * 中燃大连
     */
    public function zrdl()
    {
        return $this->fetch();
    }

    /**
     * 公告详情
     */
    public function ginfos(){
        if($this->request->isGet()){
             $mid = input('get.mid','','int');

            if(empty($mid) || !isset($mid)){
                return false;
            }

            $infos = Db::name('gao')->where(['id'=>$mid,'status'=>1])->find();

            $this->assign('infos',$infos);

            return $this->fetch();
        }

        return false;
    }
}
