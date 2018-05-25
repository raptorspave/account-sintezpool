<?php

namespace App\Http\Controllers;

use App\Repository\FarmRepo;

class FarmController extends Controller
{
    /**
     *
     */

    public function index(FarmRepo $farm)
    {
        return redirect()->route('site.farm', [
            'farm_id' => $farm->first_farm()
        ]);
    }

    /**
     *
     */

    public function create()
    {
        //
    }

    /**
     *
     */

    public function store(Request $request)
    {
        //
    }

    /**
     *
     */

    public function show(FarmRepo $farm, $id)
    {
        $name_menu = 'farm';

        $title = $farm->menu($id, $name_menu);
        if(!$title) abort(404);

        $incomes = $farm->farm($id);

        $access = $farm->access('transactions');

        if($access['add'])
            $modal_currency = $farm->currency();
        else $modal_currency = '';

        return view('pages.farm', [
            'title' => $title,
            'farm_menu' => menu($name_menu, 'menu.farm-menu'),
            'incomes' => $incomes,
            'access_transactions' => $access,
            'modal_currency' => $modal_currency,
            'farm_id' => $id,
        ]);
    }

    /**
     *
     */

    public function edit(FarmRepo $farm, $id)
    {
        $this->validate($this->request, [
            'date' => 'required|date_format:"Y-m-d H:i"',
            'price' => 'required|regex:/^([0-9]{1,4}\.[0-9]{1,8})$/',
            'comment' => 'nullable|max:120'
        ]);

        if($farm->transaction_edit($id, $this->request))
            return redirect()->back();
        else
            abort(500);
    }

    /**
     *
     */

    public function add(FarmRepo $farm, $farm_id)
    {
        $this->validate($this->request, [
            'date' => 'required|date_format:"Y-m-d H:i"',
            'currency' => 'required|exists:currencies,id',
            'price' => 'required|regex:/^([0-9]{1,4}\.[0-9]{1,8})$/',
            'comment' => 'nullable|max:120'
        ]);

        if($farm->transaction_add($farm_id, $this->request))
            return redirect()->back();
        else
            abort(500);
    }

    /**
     *
     */

    public function delete(FarmRepo $farm, $id)
    {
        if($farm->transaction_delete($id))
            return redirect()->back();
        else
            abort(500);
    }
}
