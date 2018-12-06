<?php
namespace app\test\validate;

use think\Validate;

class ValidateTest extends Validate {

	protected $rule = [
		'name' => ['require', 'max' => 25, 'regex' => '/^[\w|\d]\w+/'],
		'age' => ['number', 'between' => '1,120'],
		'email' => 'email',
	];

	protected $message = [
		'name.require' => '名称必须',
		'name.max' => '名称最多不能超过25个字符',
		'age.number' => '年龄必须是数字',
		'age.between' => '年龄只能在1-120之间',
		'email' => '邮箱格式错误',
	];

	protected $scene = [
		'edit' => ['name','age'],
	];

} 
