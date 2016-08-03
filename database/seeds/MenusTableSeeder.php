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
            ['is_parent' => false, 'name' => str_slug('Events'), 'display_name' => 'Events', 'icon' => 'calender', 'href' => '#', 'pattern' => 'admin/event/index'],
            ['is_parent' => false, 'name' => str_slug('Price Plan'), 'display_name' => 'Price Plan', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/price-plan/index'],
            ['is_parent' => false, 'name' => str_slug('Venue'), 'display_name' => 'Venue', 'icon' => 'archive', 'href' => 'admin/venue/index', 'pattern' => 'admin/venue/index'],
            ['is_parent' => false, 'name' => str_slug('Settings'), 'display_name' => 'Settings', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/setting/index'],
            ['is_parent' => false, 'name' => str_slug('Trail'), 'display_name' => 'Trail', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/trail/index'],
            ['is_parent' => false, 'name' => str_slug('System Log'), 'display_name' => 'System Log', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/system-log/index'],
            ['is_parent' => false, 'name' => str_slug('Customer Report'), 'display_name' => 'Customer Report', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/customer-report/index'],
            ['is_parent' => false, 'name' => str_slug('Logout'), 'display_name' => 'Logout', 'icon' => 'sign-out', 'href' => 'admin/logout', 'pattern' => 'admin/logout/index'],
        ];
    }
}
