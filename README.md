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
