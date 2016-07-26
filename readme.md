## Synopsis

At the top of the file there should be a short introduction and/ or overview that explains **what** the project is. This description should match descriptions added for package managers (Gemspec, package.json, etc.)

## Code Example

Show what the library does as concisely as possible, developers should be able to figure out **how** your project solves their problem by looking at the code example. Make sure the API you are showing off is obvious, and that your code is short and concise.

## Motivation

A short description of the motivation behind the creation and maintenance of the project. This should explain **why** the project exists.

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



## Contributors

Let people know how they can dive into the project, include important links to things like issue trackers, irc, twitter accounts if applicable.

## License

A short snippet describing the license (MIT, Apache, etc.)
