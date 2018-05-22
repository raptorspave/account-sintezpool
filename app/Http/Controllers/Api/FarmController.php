<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repository\FarmRepo;

class FarmController extends Controller
{
	/**
	 *
	 */

	public function transaction(FarmRepo $farm, $farm_id, $currency_id)
	{
		$income['transactions'] = $farm->transaction($farm_id, $currency_id);
		$access = $farm->access('transactions');

		return view('pages.card-body', [
            'income' => $income,
            'access_transactions' => $access,
        ]);
	}
}