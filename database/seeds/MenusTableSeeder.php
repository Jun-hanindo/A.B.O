<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();

        foreach ($this->getMenus() as $menu) {
            if ($menu['is_parent']) {
                $m = array_except($menu, 'child');

                $m = Menu::create($m);

                foreach ($menu['child'] as $child) {
                    $child = array_add($child, 'parent', $m->id);

                    Menu::create($child);
                }
            } else {
                Menu::create($menu);
            }
        }
    }

    /**
     * Get menus array.
     *
     * @return array
     */
    private function getMenus()
    {
        return [
            ['is_parent' => false, 'name' => str_slug('Dashboard'), 'display_name' => 'Dashboard', 'icon' => 'tachometer', 'href' => 'admin/dashboard', 'pattern' => 'dashboard'],
            ['is_parent' => true, 'name' => str_slug('User Management'), 'display_name' => 'Accounts Management', 'icon' => 'users', 'href' => '#', 'pattern' => 'admin/user-trustees', 'child' => [
                ['name' => str_slug('Menu Management'), 'display_name' => 'Menu Management', 'icon' => 'bars', 'href' => 'admin/user-trustees/menus', 'pattern' => 'admin/user-trustees'],
                ['name' => str_slug('Role Management'), 'display_name' => 'Role Management', 'icon' => 'user-secret', 'href' => 'admin/user-trustees/roles', 'pattern' => 'admin/user-trustees'],
                ['name' => str_slug('User Management'), 'display_name' => 'User Management', 'icon' => 'users', 'href' => 'admin/user-trustees/users', 'pattern' => 'admin/user-trustees'],
                ['name' => str_slug('Promoter'), 'display_name' => 'Promoter', 'icon' => 'users', 'href' => 'admin/user-trustees/promoter', 'pattern' => 'admin/user-trustees'],
            ]],
            ['is_parent' => true, 'name' => str_slug('Manage Pages'), 'display_name' => 'Manage Pages', 'icon' => 'files-o', 'href' => '#', 'pattern' => 'admin/manage-pages', 'child' => [
                ['name' => str_slug('Contact Us'), 'display_name' => 'Contact Us', 'icon' => 'phone-square', 'href' => 'admin/manage-pages/contact-us', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Terms and Conditions'), 'display_name' => 'Terms and Conditions', 'icon' => 'file-text', 'href' => 'admin/manage-pages/terms-and-conditions', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('FAQ'), 'display_name' => 'FAQ', 'icon' => 'question-circle', 'href' => 'admin/manage-pages/faq', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Career'), 'display_name' => 'Career', 'icon' => 'briefcase', 'href' => 'admin/manage-pages/careers', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Privacy Policy'), 'display_name' => 'Privacy Policy', 'icon' => 'lock', 'href' => 'admin/manage-pages/privacy-policy', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('About Us'), 'display_name' => 'About Us', 'icon' => 'info-circle', 'href' => 'admin/manage-pages/about-us', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Ways to Buy Tickets'), 'display_name' => 'Ways to Buy Tickets', 'icon' => 'ticket', 'href' => 'admin/manage-pages/ways-to-buy-tickets', 'pattern' => 'admin/manage-pages'],
            ]],
            ['is_parent' => true, 'name' => str_slug('Careers'), 'display_name' => 'Careers', 'icon' => 'briefcase', 'href' => '#', 'pattern' => 'admin/career', 'child' => [
                ['name' => str_slug('Add Career'), 'display_name' => 'Add Career', 'icon' => 'plus-circle', 'href' => 'admin/career/create', 'pattern' => 'admin/career'],
                ['name' => str_slug('List Career'), 'display_name' => 'List Career', 'icon' => 'bars', 'href' => 'admin/career', 'pattern' => 'admin/career'],
                ['name' => str_slug('Department'), 'display_name' => 'Departments', 'icon' => 'building-o', 'href' => 'admin/career/department', 'pattern' => 'admin/career'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Homepage'), 'display_name' => 'Homepage', 'icon' => 'home', 'href' => 'admin/homepage', 'pattern' => 'admin/homepage'],
            ['is_parent' => true, 'name' => str_slug('Events'), 'display_name' => 'Events', 'icon' => 'calendar', 'href' => '#', 'pattern' => 'admin/event', 'child' => [
                ['name' => str_slug('Register Event'), 'display_name' => 'Register Event', 'icon' => 'plus-circle', 'href' => 'admin/event/create', 'pattern' => 'admin/event'],
                ['name' => str_slug('List Event'), 'display_name' => 'List Event', 'icon' => 'bars', 'href' => 'admin/event', 'pattern' => 'admin/event'],
                ['name' => str_slug('Category'), 'display_name' => 'Categories', 'icon' => 'bars', 'href' => 'admin/event/category', 'pattern' => 'admin/event'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Promotions'), 'display_name' => 'Promotions', 'icon' => 'tags', 'href' => 'admin/promotion', 'pattern' => 'admin/promotion'],
            // ['is_parent' => true, 'name' => str_slug('Promotions'), 'display_name' => 'Promotions', 'icon' => 'tags', 'href' => '#', 'pattern' => 'admin/promotion', 'child' => [
            //     ['name' => str_slug('Add Promotion'), 'display_name' => 'Add Promotion', 'icon' => 'plus-circle', 'href' => 'admin/promotion/create', 'pattern' => 'admin/promotion'],
            //     ['name' => str_slug('List Promotion'), 'display_name' => 'List Promotion', 'icon' => 'bars', 'href' => 'admin/promotion', 'pattern' => 'admin/promotion'],
            // ]],
            ['is_parent' => true, 'name' => str_slug('Venue'), 'display_name' => 'Venue', 'icon' => 'map', 'href' => '#', 'pattern' => 'admin/venue', 'child' => [
                ['name' => str_slug('Add Venue'), 'display_name' => 'Add Venue', 'icon' => 'plus-circle', 'href' => 'admin/venue/create', 'pattern' => 'admin/venue'],
                ['name' => str_slug('List Venue'), 'display_name' => 'List Venue', 'icon' => 'bars', 'href' => 'admin/venue', 'pattern' => 'admin/venue'],
            ]],

            ['is_parent' => false, 'name' => str_slug('Subscription'), 'display_name' => 'Subscription', 'icon' => 'envelope-o', 'href' => 'admin/subscription', 'pattern' => 'admin/subscription'],
            ['is_parent' => true, 'name' => str_slug('Settings'), 'display_name' => 'Settings', 'icon' => 'cogs', 'href' => '#', 'pattern' => 'admin/setting', 'child' => [
                ['name' => str_slug('General'), 'display_name' => 'General', 'icon' => 'circle-o', 'href' => 'admin/setting/general', 'pattern' => 'admin/setting'],
                ['name' => str_slug('Currency'), 'display_name' => 'Currency', 'icon' => 'money', 'href' => 'admin/setting/currency', 'pattern' => 'admin/setting'],
                ['name' => str_slug('Mail'), 'display_name' => 'Mail', 'icon' => 'envelope-o', 'href' => 'admin/setting/mail', 'pattern' => 'admin/setting'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Trail'), 'display_name' => 'Trail', 'icon' => 'road', 'href' => 'admin/trail', 'pattern' => 'admin/trail'],
            ['is_parent' => false, 'name' => str_slug('System Log'), 'display_name' => 'System Log', 'icon' => 'archive', 'href' => 'admin/system-log', 'pattern' => 'admin/system-log'],
            ['is_parent' => false, 'name' => str_slug('Inbox'), 'display_name' => 'Inbox', 'icon' => 'inbox', 'href' => 'admin/inbox', 'pattern' => 'admin/inbox'],
            //['is_parent' => false, 'name' => str_slug('Customer Report'), 'display_name' => 'Customer Report', 'icon' => 'archive', 'href' => 'admin/tixtrack/login', 'pattern' => 'admin/tixtrack/login'],
            ['is_parent' => true, 'name' => str_slug('TixTrack'), 'display_name' => 'TixTrack', 'icon' => 'map', 'href' => '#', 'pattern' => 'admin/tixtrack', 'child' => [
                ['name' => str_slug('Update Data'), 'display_name' => 'Update Data', 'icon' => 'plus-circle', 'href' => 'admin/tixtrack/login', 'pattern' => 'admin/tixtrack'],
                ['name' => str_slug('List Data'), 'display_name' => 'List Data', 'icon' => 'plus-circle', 'href' => 'admin/tixtrack/list', 'pattern' => 'admin/tixtrack'],
                ['name' => str_slug('Report'), 'display_name' => 'Report', 'icon' => 'bars', 'href' => 'admin/tixtrack/report', 'pattern' => 'admin/tixtrack'],
                ['name' => str_slug('Account'), 'display_name' => 'Account', 'icon' => 'bars', 'href' => 'admin/tixtrack/account', 'pattern' => 'admin/tixtrack'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Logout'), 'display_name' => 'Logout', 'icon' => 'sign-out', 'href' => 'admin/logout', 'pattern' => 'admin/logout'],

            /*['is_parent' => false, 'name' => str_slug('Application Management'), 'display_name' => 'Manajemen Pengajuan', 'icon' => 'folder', 'href' => 'admin/application/management', 'pattern' => 'admin/application/management'],
            ['is_parent' => false, 'name' => str_slug('Branch Management'), 'display_name' => 'Manajemen Cabang', 'icon' => 'archive', 'href' => 'admin/management/branch', 'pattern' => 'admin/management/branch'],

            ['is_parent' => true, 'name' => str_slug('Master Region'), 'display_name' => 'Master Wilayah', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/master', 'child' => [
                ['name' => str_slug('Master Province'), 'display_name' => 'Provinsi', 'icon' => 'map', 'href' => 'admin/master/province', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master City'), 'display_name' => 'Kota', 'icon' => 'map', 'href' => 'admin/master/city', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master District'), 'display_name' => 'Kecamatan', 'icon' => 'map', 'href' => 'admin/master/district', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master Village'), 'display_name' => 'Kelurahan', 'icon' => 'map', 'href' => 'admin/master/village', 'pattern' => 'admin/master'],
            ]],*/

        ];
    }
}
