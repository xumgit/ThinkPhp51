<?php
namespace app\test\controller;

use think\Controller;
use think\facade\Env;
use think\facade\Request;

use app\test\model\NbaTeam;

class Index extends Controller
{
    public function hello($name = 'ThinkPHP5')
    {
        echo request()->param('name');
    	$test = new \myExtend\Test();
    	dump($test->sayHello(), true, "test->Index");
    	dump($test->sayGood());
        dump($this->request->param("name", "default name=>request"));
        dump(input("name", "default name=>input"));
    	$html = "app path: ".Env::get("APP_PATH")."<br />".
    			"root app: ".Env::get("ROOT_PATH")."<br />".
    			"think app: ".Env::get("THINK_PATH")."<br />".
    			"config path: ".Env::get("CONFIG_PATH")."<br />".
    			"extend path: ".Env::get("EXTEND_PATH")."<br />".
    			"vendor ptath: ".Env::get("VENDOR_PATH")."<br />".
    			"runtime pah: ".Env::get("RUNTIME_PATH")."<br />".
    			"route path: ".Env::get("ROUTE_PATH")."<br />".
    			"module path: ".Env::get("MODULE_PATH")."<br />";
        return $html;
    }

    public function databaseTest() {
        $nbaTeam = new Nbateam();
        $data = $nbaTeam->_get_team_info();
        //foreach($data as $key=>$value) {
            dump($data);
        //}
    }

    public function responseType() {
        $data = ["key1"=>"value1", "key2"=>"value2", "key3"=>"value3"];
        $json_data = json($data);
        dump(json()->data($data)->code(201));
        dump($json_data);
        dump($json_data->getContent());
        //rerturn redirect("http://www.baidu.com");
        return $json_data;
    }

    public function downloadTest() {
        $path = Request::root()."/static/images/test.jpg";
        $download = new \think\response\Download($path);
        return $download->name("1.jpg");
    }

    public function serverInfo() {
        $html = "url(): ".Request::url()."<br />".
                "url(true): ".Request::url(true)."<br />".
                "baseFile(): ".Request::baseFile()."<br />".
                "baseFile(true): ".Request::baseFile(true)."<br />".
                "root(): ".Request::root()."<br />".
                "root(true): ".Request::root(true)."<br />";
        return $html;
    } 

    public function headerInfo() {
        $info = Request::header();
        dump("accept:".$info["accept"]);
        dump("accept-encoding:".$info["accept-encoding"]);
        dump("user-agent:".$info["user-agent"]);
    }

    public function gotoSuccess()
    {
        $this->success('got to success', 'index/hello');
    }

    public function gotoError(){
        $this->error('error');
    }
    
}