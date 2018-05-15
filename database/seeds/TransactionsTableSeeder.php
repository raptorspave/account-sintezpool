<?php

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         *	Farm 3
         */

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '1',
            'price' => '0.0665129',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '4',
            'price' => '1.614953',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '6',
            'price' => '0.131338',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '8',
            'price' => '8155.993091',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '7',
            'price' => '430.450789',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '3',
            'currency_id' => '5',
            'price' => '1388.506112',
            'transaction_at' => '2018-05-14 03:00:00',
        ]);

        /**
         *	Farm 4
         */

        Transaction::firstOrCreate([
            'farm_id' => '4',
            'currency_id' => '3',
            'price' => '3131.55906',
            'transaction_at' => '2018-05-12 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '4',
            'currency_id' => '4',
            'price' => '0.2322665',
            'transaction_at' => '2018-05-12 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '4',
            'currency_id' => '6',
            'price' => '0.1111135',
            'transaction_at' => '2018-05-12 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '4',
            'currency_id' => '8',
            'price' => '1527.83716',
            'transaction_at' => '2018-05-12 03:00:00',
        ]);

        Transaction::firstOrCreate([
            'farm_id' => '4',
            'currency_id' => '5',
            'price' => '40.9261915',
            'transaction_at' => '2018-05-12 03:00:00',
        ]);
    }
}
