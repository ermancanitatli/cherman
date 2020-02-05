<?php

namespace App\Models;


class Gift extends BaseModel
{

	public $gift_id;

	public $code;

	public $user_id;



	public function getSource()
	{
		return 'gift_code';
	}



}
