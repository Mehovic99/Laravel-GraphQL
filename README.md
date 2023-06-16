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

### Method 1: Globally initializing Laravel installer
In this method you call for composer to install laravel globally. Once Laravel is installed you can call Laravel in order to start a project. First off, install laravel globally and start a new project with the following commands:

```
composer global require laravel/installer
laravel new NAME-OF-APP
```
