<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_users')->truncate();
        DB::table('roles')->truncate();

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'super-admin',
            'name' => 'Super Administrator',
            'permissions' => [
                'backend' => true,
                'dashboard' => true,
                'role-management' => true,
                'user-trustee-management' => true,
                'user-ahloo-management' => true,
                'chat-management' => true,
                'hashtag-management' => true,
                'directory-management' => true,
                'sales-report' => true,
                'shop-report' => true,
                'news-feed-management' => true,
                'category-management' => true,
                'finance-report' => true,
                'menu-management' => true,
                'user-management' => true,
            ],
            'is_super_admin' => true,
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'sales-admin',
            'name' => 'Sales Administrator',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'sales-representative',
            'name' => 'Sales Representative',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'finance-admin',
            'name' => 'Finance Administrator',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'shop-admin',
            'name' => 'Shop Administrator',
            'permissions' => [],
        ]);

        Sentinel::getRoleRepository()->createModel()->create([
            'slug' => 'editor-admin',
            'name' => 'Editor Administrator',
            'permissions' => [],
        ]);
    }
}
