<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Weather;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Request;
use App\Auth\Auth;

class WeatherController extends BaseController
{
	private $jwt;

	public function onConstruct()
	{
		$this->jwt = new Auth;
	}

	public function getInfo()
	{

		/**
		 *
		 * Weather information by user's city
		 *
		 */

		$request = new Request();
		$userId = $this->jwt->getUserId($request);

		$weather = new Weather();

		$weatherData = $weather->getInfo($userId);


		return [$weatherData];

	}


}
