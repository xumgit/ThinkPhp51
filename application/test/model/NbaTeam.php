<?php
namespace app\test\model;
use think\Model;

class NbaTeam extends Model
{
	protected $table = DB_NBATEAM_TAB;
	
	public function _get_test_data()
	{
		$where = [
				   DB_NBATEAM_ALLIANCE => ['eq','East'],
				   DB_NBATEAM_ID       => ['like','%'],
				   DB_NBATEAM_WIN      => [['gt',50],['lt',60],'and']
		         ];
		$order = [DB_NBATEAM_RANK => 'asc'];
		$field = [DB_NBATEAM_NAME,DB_NBATEAM_WIN,DB_NBATEAM_LOSE,DB_NBATEAM_PARTITION];
		$data = $this->where($where)->order($order)->field($field)->limit(8)->select();
		return $data;
	}
	
	public function _get_one_data($id)
	{
		$where = [DB_NBATEAM_ID => $id];
		$data = $this->where($where)->find();
		return $data;
	}
	
	public function _get_team_info()
	{
		$field = [DB_NBATEAM_NAME,DB_NBATEAM_WIN,DB_NBATEAM_LOSE,DB_NBATEAM_PARTITION];
		$where[DB_NBATEAM_WIN] = ['elt',20];
		$where[DB_NBATEAM_LOSE] = ['egt',20];
		$order = [DB_NBATEAM_WIN => 'asc', DB_NBATEAM_ID => 'desc'];
		$data = $this->limit(5)->field($field)->where($where)->order($order)->select();
		//$data = $this->max(DB_NBATEAM_WIN);
		//$data = $this->count();
		return $data;
	}
	
	public function _get_team_by_paginate($list_rows)
	{
		$where[DB_NBATEAM_WIN] = ['egt',40];
		$order = [DB_NBATEAM_WIN => 'desc'];
		$data = $this->where($where)->order($order)->paginate($list_rows);
		return $data;
	}
}