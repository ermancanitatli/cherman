<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Auth\Auth;
use App\Models\User;
use Phalcon\Http\Request;
use Phalcon\Mvc\Model\Manager;

class AuthController extends BaseController
{

	private $jwt;


	public function onConstruct()
	{
		$this->jwt = new Auth;
	}

	/**
	 *
	 * Register
	 *
	 */
	public function register()
	{

		try {

			$request = new Request();

			$user = new User();

			if($request->getPost('password') == null || strlen($request->getPost('password')) < 8){

				return ['code' => 400, 'message' => 'invalid password', 'data' => []];

			}

			$user->password = md5($request->getPost('password'));
			$user->lang = $request->getPost('lang');
			$user->city_id = $request->getPost('city_id');
			$user->notification_token = $request->getPost('notification_token');
			$user->email = $request->getPost('email');
			$user->timezone = $request->getPost('timezone');
			$user->os_type = $request->getPost('os_type');


			if($user->save() === false) {
				
				$messages = $user->getMessages();
				$allMessage = '';
				foreach ($messages as $message) {
					$allMessage .= $message . ", ";
				}
				return ['code' => 400, 'message' => $allMessage, 'data' => []];
			} else {

				return $this->jwt->encode([$user]);
			}

		} catch (Exception $e) {

			echo $e->getMessage();
			return $this->jwt->encode([$e]);

		}
	}


	/**
	 *
	 * Refresh Token
	 *
	 */
	public function refresh()
	{

		try {

			$request = new Request();
			$userId = $this->jwt->getUserId($request);
			$userData = User::find($userId);
			return $this->jwt->encode([$userData[0]]);

		} catch (\Exception $e) {

			return $e->getMessage();

		}

	}

	/**
	 *
	 * Login
	 *
	 */
	public function login()
	{

		try {

			$user = new User();
			$request = new Request();
			$userData = $this
				->modelsManager
				->createBuilder()
				->columns('*')
				->from(User::class)
				->where("[App\Models\User].password={$user->setPassword($request->getPost('Password'))}")
				->andWhere("[App\Models\User].email={$request->getPost('Email')}")
				->limit(1)
				->getQuery()
				->execute()[0];


			return $this->jwt->encode([$userData]);

		} catch (\Exception $e) {

			return $e->getMessage();

		}

	}

}
