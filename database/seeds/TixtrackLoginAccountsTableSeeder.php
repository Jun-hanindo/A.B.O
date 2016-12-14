<?php

use Illuminate\Database\Seeder;
use App\Models\TixtrackLoginAccount;

class TixtrackLoginAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tixtrack_login_accounts')->truncate();

        $tixtrack = new TixtrackLoginAccount();
        $tixtrack->email = 'asiaboxoffice@hanindogroup.com';
        $tixtrack->password = 'AsiaBoxOffice#55';
        $tixtrack->save();
    }
}
