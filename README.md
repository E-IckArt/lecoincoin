# Le coincoin Symfony6

This is a e-commerce project that I use to test new features of Symfony 6.

## Installation

Make sure to have PHP 8.1 >= and Composer and Symfony CLI installed.

    composer install

## Run the app

    symfony server:start
    npm run watch

## Configure the .env file

    cp .env .env.local

Then modifiy the `.env.local` file to match your configuration.(database, mailer, etc.)

## Create the database

(I have used MySQL SGBD)

    php bin/console doctrine:database:create

## Create migration

    php bin/console make:migration

## Run the migration

    php bin/console doctrine:migrations:migrate


## Other commands (to be tested)

#### Run the tests

    composer test

#### Run the linter

    composer lint

#### Run the static analysis

    composer static-analysis

#### Run the code coverage

    composer coverage


####  Run the code coverage report

    composer coverage-report

#### Run the code coverage report in HTML

    composer coverage-report-html

#### Run the code coverage report in HTML and open it

    composer coverage-report-html-open

#### Run the code coverage report in HTML and open it in your browser

    composer coverage-report-html-open-browser

#### Run the code coverage report in HTML and open it in your browser and watch the code coverage change  (you need 
to have the [inotify-tools]( [inotify-tools/inotify-tools](github.com/inotify-tools/inotif...)) installed)

    composer coverage-report-html-open-browser-watch

## Assets

### DB schema

![image](https://user-images.githubusercontent.com/90518233/230645486-dea44463-5a9f-49e5-a1e0-07098e77bc0d.png)

