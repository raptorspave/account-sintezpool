<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Currency;
use App\Models\Transaction;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 3;

        // $currencies = Currency::select('id', 'name', 'api_price', 'set_price')
        //     ->get()
        //     ->toArray();

        $price['day'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 DAY');
        $price['week'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 WEEK');
        $price['month'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 MONTH');
        $price['months'] = $this->transaction_interval($id, 'NOW() - INTERVAL 3 MONTH');
        $price['halfyear'] = $this->transaction_interval($id, 'NOW() - INTERVAL 6 MONTH');
        $price['year'] = $this->transaction_interval($id, 'NOW() - INTERVAL 1 YEAR');
        $price['total'] = $this->transaction_interval($id, false);

        $color = ['primary', 'success', 'danger', 'warning', 'info', 'dark', 'pink'];

        $transactions = Transaction::select('currency_id', 'price', DB::raw('DATE_FORMAT(transaction_at, "%d.%m.%Y") as transaction_at'))
            ->where('farm_id', $id)->get()->toArray();

        dump(implode(',', array_unique($this->currency_id)));

        return;
    }

    private function currencies()
    {

    }

    private function transaction_interval($id, $interval)
    {
        $rows = Transaction::select('currency_id', 'price')->where('farm_id', $id);
        if($interval) $rows->where('transaction_at', '>', DB::raw($interval));
        $rows = $rows->get();

        foreach ($rows as $row) {
            if(empty($price[$row->currency_id]['crypto']))
                $price[$row->currency_id]['crypto'] = 0;
            $price[$row->currency_id]['crypto'] += $row->price;
            $this->currency_id[] = $row->currency_id;
        }

        return isset($price)? $price: false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
