<?php

namespace App\Http\Controllers;

use App\Repository\FarmRepo;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $this->show(1);
        return redirect()->route('site.farm', ['id' => 1]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmRepo $farm, $id)
    {
        $this->validate($this->request, [
            'date' => 'required|date_format:"Y-m-d"',
            'price' => 'required|regex:/^([0-9]{1,4}\.[0-9]{1,8})$/'
        ]);

        if($farm->transaction_edit($id, $this->request))
            return redirect()->back();
        else
            abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add(FarmRepo $farm, $farm_id)
    {
        $this->validate($this->request, [
            'date' => 'required|date_format:"Y-m-d"',
            'currency' => 'required|exists:currencies,id',
            'price' => 'required|regex:/^([0-9]{1,4}\.[0-9]{1,8})$/'
        ]);

        if($farm->transaction_add($farm_id, $this->request))
            return redirect()->back();
        else
            abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(FarmRepo $farm, $id)
    {
        if($farm->transaction_delete($id))
            return redirect()->back();
        else
            abort(403);
    }
}
