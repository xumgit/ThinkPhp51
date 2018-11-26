<?php

namespace app\test\behavior;

class TestInfo {

	public function run() {
		$id = request()->route("id");
		dump("id:".$id);
	}
	
}