> This is the startup repo

### Tools Used / Prerequisites

1. PHP **7.3.0** - backend
2. Mysql - server.. 
3. Laravel - PHP Framework visit [Laravel Framework Website](https://laravel.com/).
4. Laragon / Xampp / 
5. Also make sure you have bash like terminal install git bash / cmder for this.
5. Create an algolia account and put all the necessary credentials in the .env file..
6. Setup also a mailtrap account. 
7. NPM / Yarn 

## Installation

1. clone the project by typing this commands in the terminal..

```
$ git clone https://github.com/abrhambas01/papeer-repo.git 
$ cd papeer-repo && composer install && npm install
$ php artisan key:generate
``` 

2. Rename the .env.example to .env file with necessary credentials such as .. 


## BUILT WITH 


 - This project was built with Laravel visit their website @ laravel.com or visit laracasts.com for video tutorials about Laravel


## Installation of this project can be done through following this :


 Please download these packages first

1. npm/nodejs
2. composer
3. laravel-valet(mac/win) / laragon(win) ( optional since you can use the built in php server)


## These errors are commonly encountered while installing laravel apps. 


> 1. 2 Whoops Errors visible after doing the above steps


### Fix to issue #1

change the .env.example file to .env only from the directory root and change it to your db credentials.. 

RUN
 

```
$ php artisan key:generate && composer dump-autoload 

```

Run the project with php artisan serve from the terminal... or the pretty urls can also be used. like poppl.test or poppl.dev depending on your configuration.



