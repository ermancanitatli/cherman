<?php

namespace App\Models;


class Weather extends BaseModel
{

	public $weather_id;

	public $code;

	public $city_id;


	public function getInfo($userId)
	{

		try {
			return $this
				->modelsManager
				->createBuilder()
				->columns([
					'[App\Models\Weather].weather_id as weather_id',
					'[App\Models\Cities].name as city_name',
					'[App\Models\Weather].precipitation',
					'[App\Models\Weather].moisture',
					'[App\Models\Weather].wind',
					'[App\Models\Weather].temperature',
					'[App\Models\Weather].date',
				])
				->from(Weather::class)
				->leftJoin(Cities::class, '[App\Models\Cities].city_id = [App\Models\Weather].city_id')
				->limit(1)
				->orderBy('[App\Models\Weather].date')
				->getQuery()
				->execute()[0];

		} catch (\Exception $e) {

			return;

		}
	}

}
