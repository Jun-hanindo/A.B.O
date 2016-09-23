<?php

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->truncate();

        $currency = new Currency();
        $currency->title = 'Australian Dollar';
        $currency->code = 'AUD';
        $currency->symbol_left = 'A$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Brazilian Real';
        $currency->code = 'BRL';
        $currency->symbol_left = 'R$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Canadian Dollar';
        $currency->code = 'CAD';
        $currency->symbol_left = 'Can$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Czech Koruna';
        $currency->code = 'CZK';
        $currency->symbol_left = '';
        $currency->symbol_right = 'Kč';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Danish Krone';
        $currency->code = 'DKK';
        $currency->symbol_left = 'Dkr';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Euro';
        $currency->code = 'EUR';
        $currency->symbol_left = '€';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Hong Kong Dollar';
        $currency->code = 'HKD';
        $currency->symbol_left = 'HK$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Hungarian Forint';
        $currency->code = 'HUF';
        $currency->symbol_left = 'Ft';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Indonesian Rupiah';
        $currency->code = 'IDR';
        $currency->symbol_left = 'Rp';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Japanese Yen';
        $currency->code = 'JPY';
        $currency->symbol_left = '¥';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Korean won';
        $currency->code = 'KRW';
        $currency->symbol_left = '₩';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Malaysian Ringgit';
        $currency->code = 'MYR';
        $currency->symbol_left = 'RM';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Mexican Peso';
        $currency->code = 'MXN';
        $currency->symbol_left = 'Mex$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Norwegian Krone';
        $currency->code = 'NOK';
        $currency->symbol_left = 'kr';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'New Zealand Dollar';
        $currency->code = 'NZD';
        $currency->symbol_left = 'NZ$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Philippine Peso';
        $currency->code = 'PHP';
        $currency->symbol_left = 'Php';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Polish Zloty';
        $currency->code = 'PLN';
        $currency->symbol_left = '';
        $currency->symbol_right = 'zł';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Pound Sterling';
        $currency->code = 'GBP';
        $currency->symbol_left = '£';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Singapore Dollar';
        $currency->code = 'SGD';
        $currency->symbol_left = 'S$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Swedish Krona';
        $currency->code = 'SEK';
        $currency->symbol_left = 'kr';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Swiss Franc';
        $currency->code = 'CHF';
        $currency->symbol_left = 'SFr';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Taiwan New Dollar';
        $currency->code = 'TWD';
        $currency->symbol_left = 'NT$';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'Thai Baht';
        $currency->code = 'THB';
        $currency->symbol_left = '฿';
        $currency->symbol_right = '';
        $currency->save();

        $currency = new Currency();
        $currency->title = 'U.S. Dollar';
        $currency->code = 'USD';
        $currency->symbol_left = 'US$';
        $currency->symbol_right = '';
        $currency->save();
        //
    }
}
