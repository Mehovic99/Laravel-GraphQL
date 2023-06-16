<p align="center">
  <img src="https://user-images.githubusercontent.com/76923830/232968928-37ab729c-145a-428c-a190-75ffe2b67368.png"/>
</p>

------------------------------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------------

# GraphQL API in Laravel || HulkApps Onboarding Document

## Introduction
If you are reading this, greetings and welcome to the HulkApps team. We are happy to have you with us. In this document you will have access to a short tutorial on creating a simple GraphQL API for your Laravel project. Without further delays, lets begin by explaining what you will need to do and what tools have been used for creating this project so that you may follow along.

First off, here is what you need to setup in order for this API to work:
- Database factory
- Database seeding
- Database migrations
- GraphQL queries
- GraphQL schema
- GrahpQL mutations
- Laravel Dev Environment
- Laravel GraphQL library

## TOOLS USED:
|Visual Studio Code|Composer|Postman|
|:-:|:-:|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232976599-f3664623-da87-4699-998e-428358c41f5c.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/232976813-8265b645-f407-4517-9169-b149d281c8b5.png" width="100">|<img src="https://user-images.githubusercontent.com/76923830/233024463-94e361e3-552c-4cf9-ae83-e15cbbde7af1.png" width="100">|


## PROGRAMMING LANGUAGE:
|PHP|
|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232976123-0b69e481-50bb-4407-94e2-9148ecbe3b2a.png" width="200">|

## FRAMEWORK:
|Laravel|
|:-:|
|<img src="https://user-images.githubusercontent.com/76923830/232974917-d376cc16-da7c-42d8-99df-acd777680b55.png" width="200">|


## Helpful documents
There are a handful documents that can be used in case you get stuck on an error or need further explenation how something needs to be done. Here is a list of the few documents that have aided in the creation of this program:
- Laravel documentation -> This documentation contains everything Laravel. You need a rundown on how to create a factory? You can find the tutorial here. You need an explenation on how seeders work? Laravel docs has you covered --> https://laravel.com/docs/10.x/readme
- GraphQL learn -> This is the official website of GraphQL. It contains the information on different libraries that you can use for GraphQL in different languages, ranging from JavaScript to Ballerina --> https://graphql.org/learn/


## Getting started

### Setting up Laravel
First of all, once you open your IDE of choice, you need to open a terminal inside of the project directory in order to create a laravel project. You can use the built in terminal that gets packaged with Visual Studio Code, however you can also use windows powershell, mac terminal or linux terminal. In the end the preference is yours. There are two ways with which you can initialize the laravel project.

### Method 1: Globally installing Laravel
In this method you call for composer to install laravel globally. Once Laravel is installed you can call Laravel in order to start a project. First off, install laravel globally and start a new project with the following commands:

```
composer global require laravel/installer
laravel new NAME-OF-APP
```

### Method 2: Initializing laravel with composer
In the case that the first command throws an error or that you do not want to have laravel globally installed on your machine, the second option is to create the project through composer immediately with the following code:

```
composer create-project laravel/laravel NAME-OF-APP
```

Either way that you choose, you test whether the application works by running a php commands inside the new folder that you have created. Here is how you do it:

```
cd NAME-OF-APP
php artisan serve
```

If the program is working you should be able to see something that looks like this:

```
INFO Server running on [http://127.0.0.1:8000].

Press Ctrl+C to stop the server
```

In the case that this does not occur, here are some of the most common errors that could pervent the server from running:
- Outdated composer --> Run composer update in order to update json dependencies in your project
- Outdated PHP --> Make sure to update PHP through command line or EXE file

## NOTE: From this moment onward in the tutorial, assume that every terminal command is being run inside of the project folder that you have created. In this example, that folder would be the "main" folder

## Installing GraphQL library

Since GraphQL is flexible and can be used by multiple programming languages, there are quite a few options when it comes to choosing a PHP library. Here is a short list of GraphQL libraries that you can find on the GraphQL website that are most commonly used:
- webonyx/graphql-php
- wp-graphql/wp-graphql
- nuwave/lighthouse
- rebing/graphql-laravel

For this example I will be using the ***rebing/graphql-laravel*** library from github since its a direct clone of the GraphQL from Facebook and since its been adapted specifically to Laravel. In addition, it is constantly being updated.

The way in which you initialize the library is as follows:

```
composer require rebing/graphql-laravel
```

After running that code and having fetched the library you have to then copy the configuration of the rebing/graphql-library to the vendor configuration inside of your project by running the command:

```
php artisan vendor:publish --provider="Rebing\GraphQL\GraphQLServiceProvider"
```

If the publish is successful, you are going to get the following response:

```
Copied File [/vendor/rebing/graphql-laravel/config/config.php] To [/config/graphql.php]
Publishing complete.
```

## Creating a Model

A model in laravel is a way for the application to question the data from a table inside of a database. In other words, a model is used in order to handle the data that is being used by the application. In this example, I have created a Blog model, however you can replace the Blog with any other model type you want, for example a book, movie or comment model. It is up to you. In order to create a Blog model with its migrations, you need to initialize the following piece of code :

```
php artisan make:model Blog -m
```

Next, what you need to do is find the migration file of the model and edit it. The migrations are located inside of the ***database/migrations*** inside of your project folder. You need to edit the migration files as follows:

```PHP
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        ## Here we have defined the schema of our data. We define the name of the data that is going to be inside the table as well as defining
        ## the data type of each entry
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        # This checks whether a table of the same name already exists. If it does, then the existing table is delted and replaced by the new schema defined in the migrations
        Schema::dropIfExists('blogs');
    }
};

```

Here you define the data located in the table and the data type, for example string for the blog title.

Once you have defined the data for the table in the migrations, there are two ways in which you can edit the Blog.php model file.

### Method 1: Having dummy data from the very beginning

If you want to have the same type of data each time you load the project, then you define the model as follows:

```PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ["title", "content"];
}

```

### Method 2: Having randomly generated data each time

However if you want data to be randomly generated each time that you freshly install the project, then you fill the method as follows:

```PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    #Command to connect the eloquent model to a factory for generating test data
    use HasFactory;
}
```

## Creating a seeder

Once you have the model of your choice, you need to create a seeder. In order to do that, you need to run a command in the terminal. The command is:

```
php artisan make:seeder BlogSeeder
```

This will create the corresponding seeder php file inside of ***database/seeders*** inside of your laravel app. Since there are two methods with which to define fillable arguments inside of the model,
there are two methods for filling in the requirements for the seeder.

### Method 1: Manual input

Inisde of the seeder you define what data you are going to have inside the database once you run that command. So if you rely on manual input inside the model, your seeder should look like this:

```PHP
<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::insert([
            [
                "title" => "This is title 1",
                "content" => "Something something description 1",
            ],
            [
                "title" => "This is title 2",
                "content" => "Something something description 2",
            ],
            [
                "title" => "This is title 3",
                "content" => "Something something description 3",
            ],
            [
                "title" => "This is title 4",
                "content" => "Something something description 4",
            ],
            [
                "title" => "This is title 5",
                "content" => "Something something description 5",
            ],
            [
                "title" => "This is title 6",
                "content" => "Something something description 6",
            ],
        ]);
    }
}
```

### Method 2: Relying on model factory

If you instead want randomly generated data based on the input from the factory, then you write your seeder in the following way:

```PHP
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Blog::factory()
                ->count(5)
                ->create();
    }
}

```

## Building factory (FOLLOW ONLY IF YOU USED METHOD 2 SO FAR ON MODEL AND SEEDER)

In order to create a factory inside of your laravel app you need to run the command:

```
php artisan make:factory BlogFactory --model=Blog
```

The ```--model``` command at the end defines what model the factory should be attached to. Once the factory is made, it will be located inside of ***database/factories*** folder. Once you open your factory folder, you should edit it to look like this:

```PHP
<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * The name of the model the corresponding factory follows.
     * 
     *  @var string
     */
    protected $model = \App\Models\Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'content' => $this->faker->paragraph,
        ];
    }
}

```

### BONUS TIP

If you want to make sure that the factory is made correctly and prevent any mishaps when running the seeder later, then you can enter the following command in the terminal:

```
php artisan tinker
```

What this will do is open a unique Laravel CLI (Command Line Interface) that will allow you to directly edit the application how you see fit or to test. In this case what you can do is enter the following code:

```
>>> \App\Models\Blog::factory()->create();
```

This command basically tells the laravel to run the factory code in order to create one table value. If you have followed the procedure so far and there have not been any errors so far, you will get something that looks like this:

```
=> App\Models\Blog {#8845
  title: "Klik.",
  content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ",
  created_at: "2023-06-16 14:39:05",
  updated_at: "2023-06-16 14:39:05",
  id: 3,
}
```

## Seeding the database

Now before you run the command to seed the database, you first need to instance your custom seeder inside the class called **DatabaseSeeder.php** which is located inside of ***database/seeders*** inside of your main laravel app.
What you need to do is as follows:

```PHP
<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(BlogSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

```

What this will do is it will call the seeder once you start the seeding process from the terminal

Now you need to edit your environment information. This information is located inside of the file called **.env**. If this file does not exist, you can simply create a blank filed called .env and copy information from **.env.example** file into your
newly created .env file. Inside of the .env file you should edit the database section to look as follows:

```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
```

If you notice, I have deleted the following sections from this code: DB_DATABASE=YOUR_DB_NAME, DB_USERNAME=YOUR_DB_USER and DB_PASSWORD=YOUR_DB_PASSWORD. The reason for which I have done this is because I watned for the code to run locally for testing purposes
so that for future use I don't have to rely on apache servers or docker servers.

In addition, you should create a file called ***database.sqlite*** inside of the database folder in your Laravel application

In order to run the seeder, you need to input the following command inside of the terminal:

```
php artisan migrate --seed
```

This will fill out the sqlite file and now you have a working database.

## Constructing GraphQL operations

Now that you have the base of the application setup, you need to setup your GraphQL operations as well. These operations include:

- Queries -> To get data from the database, GraphQL queries will be utilized, and the classes for that functionality will be written here.
- Mutations -> Same as queries that fetch data, only these will allow for modification of present data
- Types -> This will create objects that represent the types of data that can be accessed from the database

## Types

First we start with defining the type for a Blog model. This will be done inside a file that you create in the folder ***App/GraphQL/Types***. In the case that this folder does not exist, create it and once you do crate a file called ***BlogType.php***.
Once you have the BlogType.php file you are going to edit it so that it looks like this:

```PHP
<?php

namespace App\GraphQL\Types;
use App\Models\Blog;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class BlogType extends GraphQLType
{
    protected $attributes = [
        "name" => "Blog",
        "description" => "Collection of blog posts and their content",
        "model" => Blog::class,
    ];

    public function fields(): array
    {
        return [
            "id" => [
                "type" => Type::nonNull(Type::int()),
                "description" => "Id of a specific blog post",
            ],
            "title" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "Title of a specific blog post",
            ],
            "content" => [
                "type" => Type::nonNull(Type::string()),
                "description" => "Content of a specific blog post",
            ],
        ];
    }
}
```

Here you will instance the data you have and its type. You will also describe which model the type is based on and what the model does.

## Queries

Inside of the GraphQL folder, next to the Types folder, you are going to create another folder called ***Queries***. Inside the newly created Queries folder, you are going to create two files. One is going to be called
***BlogQuery.php*** and the second one is going to be called ***BlogsQuery.php***.

### BlogQuery.php

Inside of the BlogQuery you are going to define a function that will fetch
