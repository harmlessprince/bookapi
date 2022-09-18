# Book API

## Introduction

This is a mini rest api that provides endpoints to perform CRUD on books and also integrates an [Ice and fire API](https://anapioficeandfire.com/Documentation#books) to access books listings.


## Table of Contents
1. <a href="#how-it-works">How it works</a>
2. <a href="#technology-stack">Technology Stack</a>
3. <a href="#application-features">Application Features</a>
4. <a href="#api-endpoints">API Endpoints</a>
5. <a href="#setup">Setup</a>
6. <a href="#author">Author</a>
7. <a href="#license">License</a>

## Technology Stack
  - [PHP](https://www.php.net)
  - [Laravel](https://laravel.com)
  - [MySQL](https://www.mysql.com)
  ### Testing tools
  - [PHPUnit](https://phpunit.de) 

## Application Features
* Ability to view list of books from the external API
* Ability to view list of books in the local database
* Ability to store books in the local database.
* Ability to update books in the local database
* Ability to view books in the local database
* Ability to delete books from the local database

## API Endpoints
### Base URL = http://localhost:6060/

#### NOTE 1: When creating/storing a book resource all payloads are required
#### NOTE 2: When updating a book resource, all payloads are optional
#### NOTE 3: When viewing or updating a resource, the id in the url represents the id of the book resource 

Method | Route | Description | Payload
--- | --- | ---|---
`POST` | `/api/v1/books` | store a book in the local database | name, isbn, authors, country, number_of_pages, publisher, release_date | 
`GET` | `/api/v1/books` | View all books in the local database | |
`GET` | `/api/v1/books/:id` | Fetch a single book from the local database by supplying book id | |
`PATCH` | `/api/v1/books/:id` | Update a book in the local database by supplying book id | |
`DELETE` | `/api/v1/books/:id` | Delete a book from the local database by supplying book id  | |
`GET` | `/api/external-books` | View all books from the external api | |

For examples of payloads, response and available query for external endpoint. Visit [The Book API Postman Collection](https://documenter.getpostman.com/view/11352884/2s7Yn1e2LV)

## Setup
This instruction will get the project working on your local machine for development and testing purposes.

  #### Dependencies
  - [Docker](https://docs.docker.com/desktop/)
 
  #### Getting Started
  - Install and setup docker
  - Open terminal and run the following commands
    ```
    $ git clone https://github.com/harmlessprince/bookapi.git
    $ cd bookapi
    $ cp .env.example .env
    $ docker-compose build app
    $ docker-compose up
    $ docker-compose exec app composer install
    $ docker-compose exec app php artisan key:generate
    $ docker-compose exec app php artisan migrate --seed
    ```
    
    If you are on a windows machine
    ```
    Step 1: clone the repository
    Step 2: Open cloned application with any code editor of your choice
    Step 3: Create a .env file at the root of your application
    Setp 4: Copy the content of the .env.example file into the .env file
    Step 5: Open your windows terminal and cd into the the directory of the cloned app
    Step 6: run "docker-compose build app" to build application docker dependencies
    Step 7: run "docker-compose up" to start app docker container
    Step 8: run "docker-compose exec app composer install" to install docker depencencies
    Step 9: run "docker-compose exec app php artisan key:generate" to generate app key
    Step 10: run "docker-compose exec app php artisan migrate" to run migrations
    ```
    If all goes well 
  - Visit http://localhost:6060/ on your browser to view laravel home
  - Visit http://localhost:8200/ on your browser to view database using phpmyadmin
  

  ### Testing
  ```
  $ docker-compose exec app php artisan test
  ```
  If correctly setup, all tests should pass
  
  #### Stop Application
  
  ```$ docker-compose down```
  
## Author
 Name: Adewuyi Taofeeq <br>
 Email: realolamilekan@gmail.com <br>
 LinkenIn:  <a href="#license">Adewuyi Taofeeq Olamikean</a> <br>

## License
ISC
