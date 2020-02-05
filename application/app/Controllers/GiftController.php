<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Gift;
use App\Models\Premium;
use Phalcon\Http\Request;
use App\Auth\Auth;
use App\Models\User;
use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
use Phalcon\Mvc\Model\Transaction\Manager as TxManager;

class GiftController extends BaseController
{
	private $jwt;

	public function onConstruct()
	{
		$this->jwt = new Auth;
	}

	public function takeGift()
	{

		// Create a transaction manager
		$manager = new TxManager();

		// Request a transaction
		$transaction = $manager->get();

		try {

			// Get User Info
			$request = new Request();
			$userId = $this->jwt->getUserId($request);
			$user = new User();

			// Did it use a gift?
			$checkUserGift = $user->checkGift($userId);

			if (!$checkUserGift) {

				// is the code valid?
				$checkGiftCode = Gift::findFirst([
					'code = :gift_code:',
					'bind' => [
						'gift_code' => $request->getPost('GiftCode')
					]
				]);

				if ($checkGiftCode->gift_id != null) {

					// I activated the gift code
					$gift = new Gift();
					$gift->gift_id = $checkGiftCode->gift_id;
					$gift->user_id = $userId;
					$gift->code = $checkGiftCode->code;
					$gift->updated_at = $checkGiftCode->updated_at;
					$gift->created_at = $checkGiftCode->created_at;


					if ($gift->save() === false) {
						throw new \Exception('Error saving file');
					}

					// the user's most recent premium action. 1 free - 0 premium
					$premium = new Premium();

					$premium->user_id = $userId;
					$premium->status = 1;


					if ($premium->save() === false) {
						throw new \Exception('Error saving file');
					}

				} else {

					return ['code' => 400, 'message' => 'unknown code', 'data' => []];

				}

			} else {

				return ['code' => 400, 'message' => 'forbidden', 'data' => []];

			}


			return ['code' => 200, 'message' => 'success', 'data' => []];


		} catch (TxFailed $e) {

			$transaction->rollback();
			return ['code' => 400, 'message' => $e->getMessage(), 'data' => []];

		}

	}


}
