<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Slug list of roles (without super-admin).
     *
     * @var array
     */
    protected $roleSlugsArray = [
        'promotor', 'admin', /*'finance-admin', 'shop-admin', 'editor-admin',*/
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('activations')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::table('role_users')->truncate();
        DB::table('throttle')->truncate();

        array_map('unlink', glob(avatar_path('*')));
        $faker = \Faker\Factory::create();

        $avatar = $faker->image(avatar_path(), 128, 128);
        $avatar = explode(DIRECTORY_SEPARATOR, $avatar);
        $avatar = last($avatar);

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'superadmin@asiaboxoffice.com',
            'password' => User::DEFAULT_PASSWORD,
            'first_name' => 'Super',
            'last_name' => 'Administrator',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(1));

        // for ($i = 2; $i <= 5; $i++) {
        //     $avatar = $faker->image(avatar_path(), 128, 128);
        //     $avatar = explode(DIRECTORY_SEPARATOR, $avatar);
        //     $avatar = last($avatar);

        //     Sentinel::registerAndActivate([
        //         'avatar' => $avatar,
        //         'email' => $faker->freeEmail,
        //         'password' => User::DEFAULT_PASSWORD,
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'is_admin' => true,
        //     ]);

        //     $rand = array_rand($this->roleSlugsArray);

        //     Sentinel::findRoleBySlug($this->roleSlugsArray[$rand])->users()->attach(Sentinel::findById($i));
        // }

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'jun.ledesma@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Jun',
            'last_name' => 'Ledesma',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(6));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'dimas.taufiq@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Dimas',
            'last_name' => 'Taufiq',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(7));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'agus.ramadhoni@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Agus',
            'last_name' => 'Ramadhoni',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(8));

        Sentinel::registerAndActivate([
            'avatar' => $avatar,
            'email' => 'klaudia.ginting@hanindogroup.com',
            'password' => 'HAS#55',
            'first_name' => 'Klaudia',
            'last_name' => 'Ginting',
            'is_admin' => true,
        ]);

        Sentinel::findRoleBySlug('super-admin')->users()->attach(Sentinel::findById(9));
    }
}
