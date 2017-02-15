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
            ['name' => 'purpleclick_head', 'value' => "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer','GTM-NQKFR7');</script>"],
            ['name' => 'purpleclick_body', 'value' => '<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NQKFR7"
                height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>'],
            ['name' => 'google_analytics', 'value' => "<script>
                  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                  ga('create', 'UA-85168114-1', 'auto');
                  ga('send', 'pageview');

                </script>"],
            ['name' => 'limit_record', 'value' => '1000'],
            ['name' => 'mail_driver', 'value' => 'smtp'],
            ['name' => 'mail_host', 'value' => 'smtp.gmail.com'],
            ['name' => 'mail_port', 'value' => '587'],
            ['name' => 'mail_username', 'value' => 'hello@asiaboxoffice.com'],
            ['name' => 'mail_password', 'value' => 'abo121216'],
            ['name' => 'mail_name', 'value' => 'AsiaBoxOffice'],
            ['name' => 'mail_encryption', 'value' => 'tls'],
            ['name' => 'mail_domain', 'value' => ''],
            ['name' => 'mail_secret', 'value' => ''],
            ['name' => 'mail_key', 'value' => ''],
            ['name' => 'mail_region', 'value' => ''],
       	];
    }
}
