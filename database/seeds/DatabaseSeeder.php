<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MenusTableSeeder::class);
        $this->call(UpdateSequenceId::class);
        $this->call(HastagsTableSeeder::class);
        $this->call(IconsTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        //$this->call(EventsTableSeeder::class);
        $this->call(TixtrackLoginAccountsTableSeeder::class);
        $this->call(TixtrackAccountsTableSeeder::class);
    }
}
