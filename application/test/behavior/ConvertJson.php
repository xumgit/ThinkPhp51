<?php

namespace app\test\behavior;

class ConvertJson {

	public function run($response) {
		$response->contentType('application/json');
	}

}