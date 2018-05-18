<?php

namespace App\Repository;

use Illuminate\Support\Facades\DB;

use TCG\Voyager\Models\Menu;
use App\Models\Currency;
use App\Models\Transaction;

class FarmRepo
{
    private $currency_id = false;
    private $paginate = 6;

	/**
     *
     */

	public function menu($farm_id, $name_menu)
	{
        $menu_items = Menu::select('id')
            ->where('name', $name_menu)
            ->first()
            ->parent_items;

        foreach ($menu_items as $item) {
            $farm = parameters($item->parameters)[$name_menu];

            if($farm == $farm_id){
                $title = $item->title;
                break;
        }}

        return isset($title)? $title: false;
	}

	/**
     *
     */

    public function farm($id)
    {
        $price['total'] = $this->transaction_interval($id, false);
        if(!is_array($this->currency_id)) return false;

        $price['day'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 DAY');
        $price['week'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 WEEK');
        $price['month'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 MONTH');
        $price['months'] = $this->transaction_interval($id, 'NOW() - INTERVAL 3 MONTH');
        $price['halfyear'] = $this->transaction_interval($id, 'NOW() - INTERVAL 6 MONTH');
        $price['year'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 YEAR');

        $income = $this->income($id, $price);

        return is_array($income)? $income: false;
    }

    /**
     *
     */

    private function income($farm_id, $price)
    {
        if(is_array($this->currency_id)){
            $currencies = Currency::select('id', 'name', 'api_price', 'set_price')
                ->whereIn('id', array_unique($this->currency_id))
                ->get();

            $hn = function($d, $id) use ($price) {
                return isset($price[$d][$id])? $price[$d][$id]: 0;
            };

            $arr = ['day', 'week', 'month', 'months', 'halfyear', 'year', 'total'];

            foreach ($currencies as $currency) {
                $id = $currency->id;
                $p = $currency->set_price > 0? $currency->set_price: $currency->api_price;
                $income[$id]['name'] = $currency->name;
                $income[$id]['transactions'] = $this->transaction($farm_id, $id);

                foreach ($arr as $d) {
                    $income[$id][$d] = [
                        'crypto' => round($hn($d, $id), 4),
                        'usd' => round($hn($d, $id) * $p, 2),
                    ];
                }
            }

            return isset($income)? $income: false;
        }
        else return false;
    }

    /**
     *
     */

    public function transaction($farm_id, $currency_id)
    {
        $transactions = Transaction::select('currency_id', 'price', DB::raw('DATE_FORMAT(`transaction_at`, "%d.%m.%Y") as `date`'))
            ->where('farm_id', $farm_id)
            ->where('currency_id', $currency_id)
            ->orderBy('transaction_at', 'desc')
            ->paginate($this->paginate)
            ->withPath('/api/transaction/' . $farm_id . '/' . $currency_id);

        return $transactions?: false;
    }

    /**
     *
     */

    private function transaction_interval($farm_id, $interval)
    {
        $rows = Transaction::select('currency_id', DB::raw('SUM(`price`) as `sum_price`'))
            ->where('farm_id', $farm_id)
            ->groupBy('currency_id');
        if($interval) $rows->where('transaction_at', '>', DB::raw($interval));
        $rows = $rows->get();

        foreach ($rows as $row) {
            $price[$row->currency_id] = $row->sum_price;
            if(!$interval) $this->currency_id[] = $row->currency_id;
        }

        return isset($price)? $price: false;
    }
}