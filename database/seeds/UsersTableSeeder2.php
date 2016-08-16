<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder2 extends Seeder
{
    /**
     * Slug list of roles (without super-admin).
     *
     * @var array
     */
    protected $roleSlugsArray = [
        'sales-admin', 'sales-representative', 'finance-admin', 'shop-admin', 'editor-admin',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        array_map('unlink', glob(avatar_path('*')));
        $faker = \Faker\Factory::create();

        $avatar = $faker->image(avatar_path(), 128, 128);
        $avatar = explode(DIRECTORY_SEPARATOR, $avatar);
        $avatar = last($avatar);

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'jun.ledesma@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(6));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'dimas.taufiq@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(7));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'agus.ramadhoni@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(8));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'klaudia.ginting@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(9));

        
    }
}
