<?php
namespace app\test\controller;

use think\Controller;
use think\facade\Env;
use think\facade\Request;

use app\test\model\NbaTeam;
use app\test\validate\ValidateTest;

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
    
    public function test() {
        debug('begin');
        $nbaTeam = new Nbateam();
        $teamInfo = $nbaTeam->_get_team_info();
        $this->assign("teamInfo", $teamInfo);
        $arr = ["a"=>"aa","b"=>"bb","c"=>"cc"];
        $this->assign("arr", $arr);
        $this->assign("nameTest", "yii");
        $this->assign("idTest", 3);
        $view = "index/test";
        $this->view->engine->layout('layout/mainlayout');
        debug('end');
        $timeConsume = debug('begin','end').'s';
        $flowConsume = debug('begin','end', 'm');
        $this->assign("timeConsume", $timeConsume);
        $this->assign("flowConsume", $flowConsume);
        return $this->fetch($view);
    }
    
    public function validateTest() {
        $data = [
            'name' => 'thinkphp',
            'email' => 'thinkphp@qq.com',
            'age' => 10
        ];
        $validate = new ValidateTest();

        $result_1 = $validate->check($data);
        $result_2 = $this->validate($data, 'app\test\validate\ValidateTest');
        if(!$result_1) {
            dump($validate->getError());
        }
        $result_3 = $validate->scene('edit')->check($data);
        if (!$result_3) {
            dump($validate->getError());
        }

        dump($result_1." | ".$result_2." | ".$result_3);
    }

    public function cacheTest() {
        $value = ["a"=>"aa","b"=>"bb","c"=>"cc"];                            
        cache('name1', 'thinkphp', 3600);
        $cacheValue = cache('name1');
        dump("cache=".$cacheValue);
        cache('name1', NULL);

        session('name2', 'thinkphp');
        $sessionValue = session('name2');
        if ($sessionValue != null) {
           dump("session=".$sessionValue); 
        } else {
           dump("session="."sessionValue is null");
        }
        session('name2', null);

        cookie('name3', 'thinkphp', 3600);
        $cookieValue = cookie('name3');
        if ($cookieValue != null) {
            dump("cookie=".$cookieValue);
        } else {
            dump("cookie="."cookieValueis null");
        }
        cookie('name3', null);

        $varLang = lang('hello thinkphp');
        dump("lang=".$varLang);
    }

    public function paginate() {
        $currentPage = Request::instance()->param('page');
        if(empty($currentPage)){
            $currentPage = 1;
        }
        $nbaTeam = new Nbateam();
        $list_rows = 7; // 每页显示多少
        $list = $nbaTeam->_get_team_by_paginate($list_rows);
        $this->assign('list', $list);
        $this->assign('currentPage', $currentPage);
        $this->assign('list_rows', $list_rows);
        $view = "index/paginate";
        return $this->fetch();
    }

    public function databaseTest() {
        //$nbaTeam = new Nbateam();
        //$data = $nbaTeam->_get_team_info();        
        //dump($data);
        
        //$data_1 = Nbateam::where(DB_NBATEAM_WIN, ">", 60)->column(DB_NBATEAM_NAME, DB_NBATEAM_ID);
        //foreach($data_1 as $key=>$value) {
            //dump($key."=>".$value);
        //}
        //dump($data_1);

        //$idKey = "1f9622d54781f79da17bbd9ab829bbf0";
        //$nbateamGet = Nbateam::get($idKey);
        //dump($nbateamGet);
        //dump("name:".$nbateamGet->Rank);
        //dump($nbateamGet->getData());

        $data_2 = Nbateam::withSearch([DB_NBATEAM_WIN, DB_NBATEAM_ALLIANCE], [
                        DB_NBATEAM_WIN => [50,60],
                        DB_NBATEAM_ALLIANCE => 'West',
                        'sort' => [DB_NBATEAM_WIN => 'desc']])->select(); 
        dump(Nbateam::getLastSql());
        dump($data_2->toJson());
        dump($data_2->toArray());

        //$data_3 = Nbateam::Win(60)->select();
        //dump($data_3);
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