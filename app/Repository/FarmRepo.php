<?php

namespace App\Repository;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use TCG\Voyager\Facades\Voyager;

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

    public function access($table_name)
    {
        $access['browse'] = Voyager::can('browse_' . $table_name);
        $access['read'] = Voyager::can('read_' . $table_name);
        $access['edit'] = Voyager::can('edit_' . $table_name);
        $access['add'] = Voyager::can('add_' . $table_name);
        $access['delete'] = Voyager::can('delete_' . $table_name);

        return $access;
    }

	/**
     *
     */

    public function first_farm()
    {
        $menu_items = Menu::select('id')
            ->where('name', 'farm')
            ->first()
            ->parent_items;

        if($menu_items){
            foreach ($menu_items as $item) {
                if(isset($item->parameters->farm))
                    $farms[] = $item->parameters->farm;
            }
        }

        if(isset($farms)){
            if(auth()->user()->role_id == 1)
                return $farms[0];

            $user_farm = explode(',', auth()->user()->status);

            foreach ($farms as $farm) {
                if(in_array($farm, $user_farm)) return $farm;
            }
        }

        return false;
    }

    /**
     *
     */

	public function menu($farm_id, $name_menu)
	{
        $menu = Menu::select('id')
            ->where('name', $name_menu)
            ->first();

        if($menu){
            $menu_items = $menu->parent_items;

            foreach ($menu_items as $item) {
                $farm = isset($item->parameters->farm)? $item->parameters->farm: false;

                if($farm == $farm_id){
                    $title = $item->title;
                    break;
                }
            }
        }

        return isset($title)? $title: false;
	}

    /**
     *
     */

    public function farm_tcg()
    {
        $menu_items = Menu::select('id')
            ->where('name', 'farm')
            ->first()
            ->parent_items;

        return $menu_items;
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

    public function currency()
    {
        $currencies = Currency::select('id', 'name')->get();

        return $currencies?: false;
    }

    /**
     *
     */

    public function transaction($farm_id, $currency_id)
    {
        $transactions = Transaction::select('id', 'currency_id', 'price', 'comment', DB::raw('DATE_FORMAT(`transaction_at`, "%d.%m.%Y") as `date`'), DB::raw('DATE_FORMAT(`transaction_at`, "%Y-%m-%d %H:%i") as `modal_date`'))
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

    /**
     *
     */

    public function transaction_edit($id, $request)
    {
        if(Voyager::can('edit_transactions')){
            $transaction = Transaction::find($id);
            $transaction->price = $request->input('price');
            $transaction->comment = $request->input('comment');
            $transaction->transaction_at = $request->input('date');
            $transaction->save();

            return $transaction;
        }

        return false;
    }

    /**
     *
     */

    public function transaction_delete($id)
    {
        if(Voyager::can('delete_transactions')){
            $transaction = Transaction::find($id)->delete();

            return $transaction;
        }

        return false;
    }

    /**
     *
     */

    public function transaction_add($farm_id, $request)
    {
        if(Voyager::can('add_transactions')){
            $transaction = new Transaction;
            $transaction->farm_id = $farm_id;
            $transaction->currency_id = $request->input('currency');
            $transaction->price = $request->input('price');
            $transaction->comment = $request->input('comment');
            $transaction->transaction_at = $request->input('date');
            $transaction->save();

            return $transaction;
        }

        return false;
    }
}