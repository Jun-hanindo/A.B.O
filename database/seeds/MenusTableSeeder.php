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
            ['is_parent' => true, 'name' => str_slug('User Management'), 'display_name' => 'User Trustee Management', 'icon' => 'users', 'href' => '#', 'pattern' => 'admin/user-trustees', 'child' => [
                ['name' => str_slug('Menu Management'), 'display_name' => 'Menu Management', 'icon' => 'bars', 'href' => 'admin/user-trustees/menus', 'pattern' => 'admin/user-trustees'],
                ['name' => str_slug('Role Management'), 'display_name' => 'Role Management', 'icon' => 'user-secret', 'href' => 'admin/user-trustees/roles', 'pattern' => 'admin/user-trustees'],
                ['name' => str_slug('User Management'), 'display_name' => 'User Management', 'icon' => 'users', 'href' => 'admin/user-trustees/users', 'pattern' => 'admin/user-trustees'],
            ]],
            ['is_parent' => false, 'name' => str_slug('Application Management'), 'display_name' => 'Manajemen Pengajuan', 'icon' => 'folder', 'href' => 'admin/application/management', 'pattern' => 'admin/application/management'],
            ['is_parent' => false, 'name' => str_slug('Branch Management'), 'display_name' => 'Manajemen Cabang', 'icon' => 'archive', 'href' => 'admin/management/branch', 'pattern' => 'admin/management/branch'],

            ['is_parent' => true, 'name' => str_slug('Master Region'), 'display_name' => 'Master Wilayah', 'icon' => 'archive', 'href' => '#', 'pattern' => 'admin/master', 'child' => [
                ['name' => str_slug('Master Province'), 'display_name' => 'Provinsi', 'icon' => 'map', 'href' => 'admin/master/province', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master City'), 'display_name' => 'Kota', 'icon' => 'map', 'href' => 'admin/master/city', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master District'), 'display_name' => 'Kecamatan', 'icon' => 'map', 'href' => 'admin/master/district', 'pattern' => 'admin/master'],
                ['name' => str_slug('Master Village'), 'display_name' => 'Kelurahan', 'icon' => 'map', 'href' => 'admin/master/village', 'pattern' => 'admin/master'],
            ]],
        ];
    }
}
