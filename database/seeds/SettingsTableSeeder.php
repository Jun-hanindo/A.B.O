<?php

use Illuminate\Database\Seeder;

use \App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->truncate();

        foreach ($this->getSettings() as $setting) {
            Setting::create($setting);
        }
    }

    private function getSettings()
    {
    	return [
            ['name' => 'language', 'value' => 'en'],
            ['name' => 'currency', 'value' => '19'],
            ['name' => 'facebook', 'value' => ''],
            ['name' => 'google_play', 'value' => ''],
            ['name' => 'apple_store', 'value' => ''],
            ['name' => 'office_name', 'value' => 'Asia Box Office Pte Ltd'],
            ['name' => 'office_address', 'value' => '<p>390 Orchard Road,</p><p>Palais Renaissance #15-01,</p><p>Singapore 238871</p>'],
            ['name' => 'gmap_link', 'value' => 'https://www.google.co.id/maps/place/390+Orchard+Rd,+Palais+Renaissance,+Singapore+238871/@1.306704,103.8273549,17z/data=!3m1!4b1!4m5!3m4!1s0x31da198ce81738ff:0xf2a8feccd1e3d70b!8m2!3d1.306704!4d103.8295436'],
            ['name' => 'office_operating_hours', 'value' => 'Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm'],
            ['name' => 'hotline', 'value' => '+65 6733 0360'],
            ['name' => 'hotline_operating_hours', 'value' => 'Mon to Sat: 10am - 8pm, Sun and PH: 12pm - 8pm'],
            ['name' => 'limit_record', 'value' => '1000'],
            ['name' => 'mail_driver', 'value' => 'smtp'],
            ['name' => 'mail_host', 'value' => 'smtp.gmail.com'],
            ['name' => 'mail_port', 'value' => '587'],
            ['name' => 'mail_username', 'value' => 'emaild67@gmail.com'],
            ['name' => 'mail_password', 'value' => 'emaildummy67'],
            ['name' => 'mail_name', 'value' => 'Asia Box Ofiice'],
       	];
    }
}
