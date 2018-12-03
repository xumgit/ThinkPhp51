<?php

namespace app\test\event;
use app\test\model\NbaTeam;

class NbaTeam
{
	public function beforeUpdate($nbateam)
	{
		if ('thinkphp' == $nbateam->Name) {
			return false;
		}
	}

	public function afterDelete($nbateam)
	{
		//Profile::destroy($nbateam->Id);
	}
}