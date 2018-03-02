<?php
namespace Common\Controller;
use Think\Controller;
use Predis\Autoloader;

/**
 * 基类Controller
 */
class BaseController extends Controller{
    protected  $redis;
    /**
     * 初始化方法
     */
    public function _initialize(){
        //自动加载predis
        Autoloader::register();
    }


   
}

