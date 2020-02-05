<?php 

namespace App\Presenters\Abstracts;

abstract class AbstractPresenter {


	protected $model;

	public function setModel($model)
	{
		$this->model = $model;

		return $this;
	}

	public function getModel()
	{
		 return $this->model;
	}


	public function __get($property)
	{
		if (method_exists($this, $property)) {
			return $this->{$property}();
		}

		return $this->model->{$property}();
	}

} 