## Synopsis

AsiaBoxOffice is a ticketing service. In AsiaBoxOffice, customer can choose which event that they like and buy ticket automatically. You also can choose which seat area that you want to pick. Fnally, your
ticket will be emailed to your email account.

## Code Example
```php
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user' => user_info(),
            'formProfile' => [
                'method' => 'PUT',
                'url' => URL::route('admin-profile-update', 'profile'),
                'files' => true,
            ],
            'formPassword' => [
                'method' => 'PUT',
                'url' => URL::route('admin-profile-update', 'password'),
            ],
            'skins' => config('general.skins'),
        ];

        return view('backend.profile', $data);
    }
```
## Motivation

You Are The Semicolon to My Statement;

## Installation

**AsiaBoxOffice Web Admin** utilizes [Composer](https://getcomposer.org/) and [Bower](http://bower.io/) to manage its dependencies. So, before using **AsiaBoxOffice Web Admin**, make sure you have Composer and Bower installed on your machine.

1. Clone this repo
2. Move to the cloned folder
3. `git checkout dev`
4. `composer install`
5. Move to `public` folder
6. `bower install`
7. Back to parent folder
8. Create a new database in mysql
9. Create a new file (`.env`) based on `.env.example`
10. Set database settings in `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
11. `php artisan key:generate`
12. `php artisan migrate --seed`
13. `php artisan serve`
14. Access `http://localhost:8000` in your browser
15. Type `admin@smooets.com` in `Email` field and type `12345678` in `Password` field
16. Click Sign In
17. You are ready to build amazing **AsiaBoxOffice** apps



## API Reference
[Guzzle HTTP](https://github.com/guzzle/guzzle "Guzzle HTTP")


## Contributors
| Contributors     | Are                |
| ---------------- |:------------------:|
| Irvan Resna      | Web Developer      |
| Arief Gusti      | Project Coordinator|
| M Raufan         | Web Designer       |

## License

A short snippet describing the license (MIT, Apache, etc.)
