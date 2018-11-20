<?php
namespace app\test\controller;

use think\facade\Env;

class Index
{
    public function hello($name = 'ThinkPHP5')
    {
    	$test = new \myExtend\Test();
    	dump($test->sayHello(), true, "test->Index");
    	dump($test->sayGood());
    	$html = "app path: ".Env::get("APP_PATH")."<br />".
    			"root app: ".Env::get("ROOT_PATH")."<br />".
    			"think app: ".Env::get("THINK_PATH")."<br />".
    			"config path: ".Env::get("CONFIG_PATH")."<br />".
    			"extend path: ".Env::get("EXTEND_PATH")."<br />".
    			"vendor path: ".Env::get("VENDOR_PATH")."<br />".
    			"runtime path: ".Env::get("RUNTIME_PATH")."<br />".
    			"route path: ".Env::get("ROUTE_PATH")."<br />".
    			"module path: ".Env::get("MODULE_PATH")."<br />";
        return $html;
    }
}