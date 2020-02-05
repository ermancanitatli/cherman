<?php

namespace App\Auth;

use Phalcon\Di;
use Firebase\JWT\JWT;


class Auth
{

	protected $config;

	protected $authenticated = false;

	public function __construct()
	{
		$this->config = Di::getDefault()->get('config')->auth;
	}

	public function decode($token)
	{
		return JWT::decode($token, $this->config->secret, [$this->config->algo]);
	}


	public function encode(array $data = [])
	{
		$payload = $this->getPayload($data);

		return [
			'access_token' => JWT::encode($payload, $this->config->secret, $this->config->algo),
			'expires' => $payload['exp'],
			"token_type" => "Bearer",
			'refresh_token' => ''
		];
	}


	public function tokenId()
	{
		return base64_encode(random_bytes(32));
	}

	public function getUserId($request)
	{
		$token = $request->getHeader('Authorization');

		if (preg_match('/Bearer\s+(.*)$/i', $token, $authData)) {
			try {

				return $this->decode($authData[1])->data[0]->user_id;

			} catch (\Exception $e) {

				print($e);

			}
		}

	}


	public function check(
		$token
	) {
		if ($result = !$this->isValid($token)) {
			return false;
		}

		if ($result = $this->isExpared($token)) {
			return false;
		}

		$this->authenticated = true;

		return $result;
	}


	public function isValid($token) {
		try {
			$result = $this->decode($token);
			return $result;
		} catch (\Firebase\JWT\UnexpectedValueException $e) {
			return true;
		}

		$this->authenticated = false;

		return $result;
	}


	public function isExpared($token) {
		try {
			$result = $this->decode($token);
		} catch (\Firebase\JWT\SignatureInvalidException $e) {
			return true;
		}

		$this->authenticated = false;

		return $result;
	}


	public function isAuthorized()
	{
		return $this->authenticated;
	}

	public function getPayload(array $data = []) {
		$iat = time();
		$nbf = $iat + 15;
		$expire = $nbf + $this->config->lifetime;

		return [
			'iss' => Di::getDefault()->get('config')->app->url,
			'exp' => $expire,
			'nbf' => $nbf,
			'iat' => $iat,
			'jti' => $this->tokenId(),
			'data' => $data
		];
	}
}
