<?php
namespace app\test\controller;

use think\Controller;
use think\facade\Env;
use think\facade\Request;

#use app\test\model\NbaTeam;

class Index extends Controller {

	//protected $middleware = ['Auth'];

	public function hello($name = 'ThinkPHP5') {
		echo request()->param('name');
		$test = new \myExtend\Test();
		dump($test->sayHello(), true, "test->Index");
		dump($test->sayGood());
		$html = "app path: " . Env::get("APP_PATH") . "<br />" .
		"root app: " . Env::get("ROOT_PATH") . "<br />" .
		"think app: " . Env::get("THINK_PATH") . "<br />" .
		"config path: " . Env::get("CONFIG_PATH") . "<br />" .
		"extend path: " . Env::get("EXTEND_PATH") . "<br />" .
		"vendor ptath: " . Env::get("VENDOR_PATH") . "<br />" .
		"runtime pah: " . Env::get("RUNTIME_PATH") . "<br />" .
		"route path: " . Env::get("ROUTE_PATH") . "<br />" .
		"module path: " . Env::get("MODULE_PATH") . "<br />";
		return $html;
	}

	public function otherController() {
		$html = "test->index->otherController" . "<br />";
		$event = controller("index/index");
		$otherHtml = $event->hello();
		$html = $html . $otherHtml;
		return $html;
	}

	public function serverinfo() {
		$html = "url(): " . Request::url() . "<br />" .
		"url(true): " . Request::url(true) . "<br />" .
		"baseFile(): " . Request::baseFile() . "<br />" .
		"baseFile(true): " . Request::baseFile(true) . "<br />" .
		"root(): " . Request::root() . "<br />" .
		"root(true): " . Request::root(true) . "<br />";
		return $html;
	}

	public function gotoSuccess() {
		$this->success('got to success', 'index/hello');
	}

	public function gotoError() {
		$this->error('error');
	}
}