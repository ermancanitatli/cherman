<?php

namespace App\Controllers;

use App\Models\User;
use DateTime;
use Phalcon\Mvc\Model\Manager;


class TaskController extends BaseController
{

	public function sendNotification()
	{
		/**
		 *
		 * Time difference
		 *
		 */


		$href = new DateTime("09:41:00"); //UTC-0
		$now = new DateTime();

		/**
		 *
		 * rabbitmq,sqs or redis may be required
		 *
		 */

	    if (intval($href->diff($now)->format('%i')) == 0) {



			$hour_diff = intval($href->diff($now)->format('%r%h'));

			$userData = $this
				->modelsManager
				->createBuilder()
				->columns('
				[App\Models\User].notification_token,
				[App\Models\Cities].name,
				[App\Models\Weather].precipitation,
				[App\Models\Weather].moisture,
				[App\Models\Weather].wind,
				[App\Models\Weather].temperature')
				->innerJoin('[App\Models\Cities]','[App\Models\Cities].city_id = [App\Models\User].city_id')
				->innerJoin('[App\Models\Weather]','[App\Models\Cities].city_id = [App\Models\Weather].city_id')
				->from(User::class)
				->where("[App\Models\User].timezone={$hour_diff}")
				->getQuery()
				->execute();

			return [$userData];

			 /**
			 *		$notificationData
			 *
			 * 	Notification or mail will be sent
			 *
			 */

			 // CRON * * * * * /usr/bin/wget --spider "http://127.0.0.1/NfAPGTGBPsrZfROqtfK20BhGfroXaL5X/send_notification" >/dev/null 2>&1


		}

	}


}
