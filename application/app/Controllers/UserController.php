<?php

namespace App\Controllers;

use Phalcon\Http\Request;
use App\Auth\Auth;
use App\Controllers\BaseController;
use App\Models\User;

class UserController extends BaseController
{
	private $jwt;


	public function onConstruct()
	{
		$this->jwt = new Auth;
	}

	/**
	 *
	 * Update user info
	 *
	 */
	public function update()
	{

		try {


			$request = new Request();

			$userId = $this->jwt->getUserId($request);

			$userData = User::findFirst($userId);

			$user = new User();
			$user->user_id = $userId;
			$user->city_id = $request->getPut('city_id');
			$user->os_type = $request->getPut('os_type');
			$user->lang = $request->getPut('lang');
			$user->notification_token = $request->getPut('notification_token');
			$user->email = $request->getPut('email');
			$user->timezone = $request->getPut('timezone');
			$user->password = $userData->password;

			if ($user->update() === false) {

				$messages = $user->getMessages();
				$allMessage = '';

				foreach ($messages as $message) {
					$allMessage .= $message . ", ";
				}

				return ['code' => 400, 'message' => $allMessage, 'data' => []];

			} else {
				return [$user];
			}

		} catch (Exception $e) {

			return ['code' => 400, 'message' => $e->getMessage(), 'data' => []];

		}

	}

	/**
	 *
	 * Update User Password
	 *
	 */
	public function changePassword()
	{

		try {
			// Update User Password
			$request = new Request();

			$userId = $this->jwt->getUserId($request);

			$user = new User();
			$user->user_id = $userId;
			$user->setPassword($request->getPost('Password'));

			if ($user->save() === false) {
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

			return ['code' => 400, 'message' => $e->getMessage(), 'data' => []];

		}
	}


}
