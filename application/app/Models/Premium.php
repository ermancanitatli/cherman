<?php


namespace App\Models;


class Premium extends BaseModel
{

	public $premium_id;

	public $status;

	public $user_id;


	public function getSource()
	{
		return 'premium_status';
	}


}
