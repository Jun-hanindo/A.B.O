<?php

use Illuminate\Database\Seeder;
use App\Models\TixtrackAccount;

class TixtrackAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tixtrack_accounts')->truncate();

        $tixtrack = new TixtrackAccount();
        $tixtrack->account_id = 18;
        $tixtrack->name = '$100Gourmet';
        $tixtrack->login_account_id = 1;
        $tixtrack->save();

        $tixtrack = new TixtrackAccount();
        $tixtrack->account_id = 20;
        $tixtrack->name = 'AsiaBoxOffice';
        $tixtrack->login_account_id = 1;
        $tixtrack->save();
    }
}
