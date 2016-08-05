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
            ]],
            ['is_parent' => true, 'name' => str_slug('Manage Pages'), 'display_name' => 'Manage Pages', 'icon' => 'files-o', 'href' => '#', 'pattern' => 'admin/manage-pages', 'child' => [
                ['name' => str_slug('Contact Us'), 'display_name' => 'Contact Us', 'icon' => 'phone-square', 'href' => 'admin/manage-pages/contact-us', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Terms and Conditions'), 'display_name' => 'Terms and Conditions', 'icon' => 'file-text', 'href' => 'admin/manage-pages/terms-and-conditions', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('FAQ'), 'display_name' => 'FAQ', 'icon' => 'question-circle', 'href' => 'admin/manage-pages/faq', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Career'), 'display_name' => 'Career', 'icon' => 'briefcase', 'href' => 'admin/manage-pages/career', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('Privacy Policy'), 'display_name' => 'Privacy Policy', 'icon' => 'lock', 'href' => 'admin/manage-pages/privacy-policy', 'pattern' => 'admin/manage-pages'],
                ['name' => str_slug('About Us'), 'display_name' => 'About Us', 'icon' => 'info-circle', 'href' => 'admin/manage-pages/about-us', 'pattern' => 'admin/manage-pages'],
            ]],
            ['is_parent' => true, 'name' => str_slug('Events'), 'display_name' => 'Events', 'icon' => 'calendar', 'href' => '#', 'pattern' => 'admin/event', 'child' => [
                ['name' => str_slug('Regiter Event'), 'display_name' => 'Register Event', 'icon' => 'plus-circle', 'href' => 'admin/event/create', 'pattern' => 'admin/event'],
                ['name' => str_slug('List Event'), 'display_name' => 'List Event', 'icon' => 'bars', 'href' => 'admin/event/index', 'pattern' => 'admin/event'],
            ]],
            ['is_parent' => true, 'name' => str_slug('Promotions'), 'display_name' => 'Promotions', 'icon' => 'tags', 'href' => '#', 'pattern' => 'admin/promotion', 'child' => [
                ['name' => str_slug('Add Promotion'), 'display_name' => 'Add Promotion', 'icon' => 'plus-circle', 'href' => '#', 'pattern' => 'admin/promotion'],
                ['name' => str_slug('List Promotion'), 'display_name' => 'List Promotion', 'icon' => 'bars', 'href' => '#', 'pattern' => 'admin/promotion'],
            ]],
            ['is_parent' => true, 'name' => str_slug('Venue'), 'display_name' => 'Venue', 'icon' => 'map', 'href' => '#', 'pattern' => 'admin/venue', 'child' => [
                ['name' => str_slug('Add Venue'), 'display_name' => 'Add Venue', 'icon' => 'plus-circle', 'href' => 'admin/venue/create', 'pattern' => 'admin/venue'],
                ['name' => str_slug('List Venue'), 'display_name' => 'List Venue', 'icon' => 'bars', 'href' => 'admin/venue/index', 'pattern' => 'admin/venue'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Settings'), 'display_name' => 'Settings', 'icon' => 'cogs', 'href' => '#', 'pattern' => 'admin/setting'],
            ['is_parent' => false, 'name' => str_slug('Trail'), 'display_name' => 'Trail', 'icon' => 'road', 'href' => '#', 'pattern' => 'admin/trail'],
            ['is_parent' => false, 'name' => str_slug('System Log'), 'display_name' => 'System Log', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/system-log'],
            ['is_parent' => false, 'name' => str_slug('Customer Report'), 'display_name' => 'Customer Report', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/customer-report'],
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
