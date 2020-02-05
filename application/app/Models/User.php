<?php

namespace App\Models;


use Exception;

class User extends BaseModel
{


	public $user_id;


	public function getSource()
	{
		return 'users';

	}



	public function initialize() {
		$this->useDynamicUpdate(true);
	}


	public function checkGift($userId)
	{

		$ct = Gift::findFirst([
			'user_id = :id:',
			'bind' => [
				'id' => $userId
			]
		]);

		return ($ct != false) ? true : false;

	}




	public function setPassword($password)
	{
		return md5($password);
	}


}
