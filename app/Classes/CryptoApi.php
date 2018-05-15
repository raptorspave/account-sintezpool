<?php

namespace App\Classes;

use App\Models\Currency;

class CryptoApi
{
	private $error = false;

	public function __construct()
	{
		// $this->update();
	}

	public function update()
	{
		$currencies = Currency::select('id', 'api_url')->get();

		foreach ($currencies as $currency) {

			$price = $this->api_price($currency->api_url);

			if ($price)
				Currency::where('id', $currency->id)
					->update(['api_price' => $price]);
		}
	}

	private function api_price($url)
	{
		$host = parse_url($url, PHP_URL_HOST);

		switch ($host) {
			case 'api.cryptonator.com':
				$price = $this->curl_request($url)['ticker']['price'];
				break;

			case 'api.coinmarketcap.com':
				$price = $this->curl_request($url)[0]['price_usd'];
				break;
		}

		return isset($price)? $price: false;
	}

	private function check_curl_response($code)
	{
		$code = (int)$code;
		if($code != 200){
			$this->error = $code;
			return false;
		} else {
			$this->error = false;
			return true;
		}
	}

	private function curl_request($link)
	{
		$ch = curl_init($link);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 7);

		$out = curl_exec($ch);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		$check = $this->check_curl_response($code);

		if($check) return json_decode($out, true);
		else return false;
	}
}