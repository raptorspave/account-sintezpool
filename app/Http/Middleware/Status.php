<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Transaction;

class Status
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $index = 0)
    {
        if (auth()->user()->role_id == 1 || ($index === 'home' && auth()->user()->status))
            return $next($request);

        if($request->route('farm_id') || $request->route('transaction_id')){
            if($request->route('farm_id'))
                $farm = $request->route('farm_id');

            elseif($request->route('transaction_id')){
                $transaction_id = $request->route('transaction_id');
                $transaction = Transaction::select('farm_id')->find($transaction_id);

                $farm = $transaction->farm_id;
            }

            $farms = explode(',', auth()->user()->status);

            if(in_array($farm, $farms))
                return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
