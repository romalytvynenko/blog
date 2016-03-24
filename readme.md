# Blog 

This is basic blog package. It provides low-end features (DB architecture, editor, basic models) and not high-end logic(!).

## Installation

First of all, run migrations
```php artisan migrate --path=vendor/romalytvynenko/blog/database/migrations```

Or, if you want to add special columns create migration and extend it from ```Romalytvynenko\Blog\database\migrations\CreatePostsTable```, then implement ```up()``` method, and add columns via ```Schema::table``` method. 
For, example we need add ```conference_id``` columns to post's table.
```php
<?php
    
use Illuminate\Database\Schema\Blueprint;
    
class CreatePostsTable extends Romalytvynenko\Blog\database\migrations\CreatePostsTable
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        parent::up();
   
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('conference_id')->after('user_id');
        });
    }
  
    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {
        parent::down();
    }
}
```

After this you can run migration as always you do it: ```php artisan migrate```
 
## Classes description

This package provides you base 2 classes:
- ```Writer``` (trait)
- ```Post```

```Writer``` trait is basically for extending ```User```, it provides features for users as authors.

## Using scripts

By default package goes with Sir Trevor JS ( https://github.com/caouecs/Laravel-SirTrevorJS ). You can add it to the project by adding sir trevor's JS. Use bower to install dependencies and add it to the project.

Example of gulp.js (with elixir and installed bower components):
```js
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');

    mix.scripts([
        "es5-shim/es5-shim.js",
        "es6-shim/es6-shim.js",
        "Eventable/eventable.js",
        "sir-trevor-js/sir-trevor.js",
    ], 'public/app.min.js', 'bower_components');
});

```