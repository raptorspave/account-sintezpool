<?php

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::firstOrCreate([
            'name' => 'Bitcoin',
            'api_url' => 'https://api.cryptonator.com/api/ticker/btc-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Ethereum',
            'api_url' => 'https://api.cryptonator.com/api/ticker/eth-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'DigiByte',
            'api_url' => 'https://api.cryptonator.com/api/ticker/dgb-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Litecoin',
            'api_url' => 'https://api.cryptonator.com/api/ticker/ltc-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Karbo',
            'api_url' => 'https://api.cryptonator.com/api/ticker/krb-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Dash',
            'api_url' => 'https://api.cryptonator.com/api/ticker/dash-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'PASC',
            'api_url' => 'https://api.cryptonator.com/api/ticker/pasc-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Verge',
            'api_url' => 'https://api.cryptonator.com/api/ticker/xvg-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Electroneum',
            'api_url' => 'https://api.coinmarketcap.com/v1/ticker/electroneum/',
        ]);

        Currency::firstOrCreate([
            'name' => 'Zcash',
            'api_url' => 'https://api.cryptonator.com/api/ticker/zec-usd',
        ]);

        Currency::firstOrCreate([
            'name' => 'Quark',
            'api_url' => 'https://api.coinmarketcap.com/v1/ticker/quark/',
        ]);

        Currency::firstOrCreate([
            'name' => 'Siacoin',
            'api_url' => 'https://api.cryptonator.com/api/ticker/sc-usd',
        ]);
    }
}
