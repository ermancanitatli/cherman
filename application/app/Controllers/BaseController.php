<?php 

namespace App\Controllers;

use Phalcon\Mvc\Controller;



class BaseController extends Controller
{

	public function view($view, array $params = [], $code = 200)
	{
		$content = $this->view->render($view, $params);

		$this->response->setStatusCode($code, null);
		$this->response->setContent($content);
	}


	public function json($data = [], $message = '', $code = 200, $status = '', $type = null)
	{
		$data = [
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        $this->response->setJsonContent($data);
		$this->response->setStatusCode($code, $type);
        $this->response->send();
	}


	public function response($data = '', $code = 200, $type = null)
	{
		$this->response->setStatusCode($code, $type);
		$this->response->setContent($data);
	}
	
}
